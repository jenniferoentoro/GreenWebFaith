<?php
    include "../connection.php";
	// $_SESSION['email'] = 'cath@gmail.com';
	$email = $_SESSION['email'];
	$sign = '';
	$id = $_POST['id'];
	// $image_address = $_POST['content_image'];

 //    echo $post_address;
 //    echo $image_address;
 //    console.log($image_address);
	
    # Find user ID
	$getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
    $find = mysqli_fetch_assoc($getID);
    $id_user = $find["id"];

    $sql_text_1 = "DELETE FROM `text_post` WHERE id ='$id'";
    $deleted_1 = mysqli_query($con, $sql_text_1);


            if ($deleted_1){
            $sign .= "success";
        } else {
            $sign .= "1";
      
        }

    // if($post_address != '' && $image_address != ''){
    //     # Text & Image input
    //     $sql_text_1 = "DELETE FROM `text_post` WHERE id_user='$id_user' && text_content='$post_address'";
    //     $deleted_1 = mysqli_query($con, $sql_text_1);

    //     $sql_img_1 =  "DELETE FROM `image_post` WHERE id_user='$id_user' && img_content='$image_address')";
    //     $deleted_2 = mysqli_query($con, $sql_img_1);
        
                
    //     if ($deleted_1 && $deleted_2){
    //         $sign .= "success";
    //     } else {
    //         $sign .= "1";
    //         echo"1";
    //     }
           

    // } else if ($image_address != '' && $post_address == ''){
    //     $sql_img_2 =  "DELETE FROM `image_post` WHERE id_user='$id_user' && img_content='$image_address'";
    //     $deleted_3 = mysqli_query($con, $sql_img_2);
    //         if ($deleted_3){
    //             $sign .= "success";
    //         } else {
    //             $sign .= "2";
    //             echo"2";
    //         }
        
    // } else if ($image_address == '' && $post_address != '') {
    //     $sql_text_2 =  "DELETE FROM `text_post` WHERE id_user='$id_user' && text_content='$post_address'";
    //     $deleted_4 = mysqli_query($con, $sql_text_2);
    //         if ($deleted_4){
    //             $sign .= "success";
    //         } else {
    //             $sign .= "3";
    //             echo"3";
    //         }
    // }

echo $sign;






?>