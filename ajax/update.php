<?php

    include "../connection.php";
	// $_SESSION['email'] = 'cath@gmail.com';
	$email = $_SESSION['email'];
	$sign = '';
	$post_address = $_POST['updated_post'];
    $id = $_POST['id'];

    # Find user ID
	$getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
    $find = mysqli_fetch_assoc($getID);
    $id_user = $find["id"];

    # Find text content && date
    $getText = mysqli_query($con, "SELECT `date_uploaded`, `text_content` FROM text_post WHERE id_user ='$id_user'");
    $search = mysqli_fetch_assoc($getText);
    $saved_post = $search["text_content"];
    $date = $search["date_uploaded"];



    if(mysqli_num_rows($getID) == 1){
        if ($post_address != ''){
                $sql_text_1 = "UPDATE `text_post` SET `text_content`='$post_address' WHERE id=$id";
                $updated_1 = mysqli_query($con, $sql_text_1);
                    if ($updated_1){
                        $sign .= "success";
                    } else {
                        $sign .= "1";
                        echo "1";
                    }
        } else {
            $sign .= "2";
            echo "3";
        }
    } else {
        $sign .= "4";
        echo "4";
    }

echo $sign;





?>