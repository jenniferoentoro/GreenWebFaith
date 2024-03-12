<?php
include 'connection.php';
require 'library/PHPMailer.php';
require 'library/SMTP.php';
require 'library/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generateRandomNumber($length = 8) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// POST METHOD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['name']) || $_POST['email'] == '' || $_POST['password'] == '' || $_POST['name'] == '') {
        echo json_encode(array('status' => 400, 'message' => 'Please Fill All Fields'));
    } else {
        $email = $_POST['email'];
        $select_query = "SELECT * FROM user_data WHERE email='$email';";
        $result = mysqli_query($con, $select_query);
        $count = mysqli_num_rows($result);
        if ($count <= 0) {
            $select_query = "SELECT special_code, date_valid_until FROM activation_status WHERE email='$email';";
            $result = mysqli_query($con, $select_query)->fetch_all();
            $result_length = count($result);
            if ($result_length != 0) {
                $last_request = $result[$result_length-1][1];
            } else {
                $last_request = '0000-00-00 00:00:00';
            }
            if ($last_request > date('Y-m-d H:i:s')) {
                echo json_encode(array('status' => 469, 'message' => 'You have already requested, please wait 5 minutes to request again!'));
            } else {
                $random_number = generateRandomNumber();
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "tls";
                $mail->Port = 587;
                $mail->Username = "ecofit.web@gmail.com";
                $mail->Password = "mbxnnucuwgiysfog";
                $mail->Subject = "Email Activation";
                $mail->setFrom("ecofit.web@gmail.com");
                $mail->isHTML(true);
                $mail->Body = "<div><h2>This will be valid for 5 minutes</h2><h1>Your special code is: <span style='color: #fc9803'>$random_number</span></h1></div>";
                $mail->addAddress($email);
                if ($mail->Send()) {
                    $data_valid_until = date('Y-m-d H:i:s', strtotime('+5 minutes'));
                    $insert_query = "INSERT INTO activation_status (email, special_code, date_valid_until) VALUES ('$email', '$random_number', '$data_valid_until');";
                    $result = mysqli_query($con, $insert_query);
                    echo json_encode(array('status' => 200, 'message' => 'Please check your email for Special Code!'));
                } else {
                    echo json_encode(array('status' => 500, 'message' => 'Mail Server Error!'));
                }
                $mail->smtpClose();
            }
            
        } else {
            echo json_encode(array('status' => 400, 'message' => 'Email is already Registered!'));
        }
    }
}



?>