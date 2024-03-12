<?php
  $msg = "";
  $msg_class = "";
  include 'connection.php';

    error_reporting(0);

    // session_start();

    // $_SESSION['email'] = 'cath@gmail.com';
    // $_SESSION['password'] = '12345678';

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $sql = "SELECT * FROM user_data WHERE email='$email'";
        $result = mysqli_query($con, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $nama = $row['name'];
            $id = $row['id'];
        } else {
            echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
        }
    }
    
  if (isset($_POST['save_profile'])) {
    // for the database
    $bio = stripslashes($_POST['bio']);
    $profileImageName = "images/".time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes

    $sql2 = "UPDATE user_data SET bio='$bio' WHERE id='$id'";
    if(mysqli_query($con, $sql2)){
      $msg = "Bio uploaded and saved in the Database";
      $msg_class = "alert-success";
    } else {
      $msg = "There was an error in the database";
      $msg_class = "alert-danger";
    }

    if($_FILES['profileImage']['size'] > 10000000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
        
        $sql = "UPDATE user_data SET profileImg='$profileImageName', bio='$bio' WHERE id='$id'";
        
        if(mysqli_query($con, $sql)){
          $msg = "Image uploaded and saved in the Database";
          $msg_class = "alert-success";
        } else {
          $msg = "There was an error in the database";
          $msg_class = "alert-danger";
        }
      } else {
        $msg = "There was an error uploading the file";
        $msg_class = "alert-danger";
      }
    }
  }
?>