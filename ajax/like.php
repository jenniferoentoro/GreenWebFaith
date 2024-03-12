<?php 

include '../connection.php';
$email = $_SESSION['email'];

$sql = "SELECT * FROM user_data WHERE email='$email'";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);
$iduser = $row['id'];

$id = $_POST['id'];


$sql2 = "SELECT * FROM `like_post` WHERE id_user = '$iduser' && id_post = '$id'";

$result2 = mysqli_query($con, $sql2);


if ($result2->num_rows > 0) {
    $rows = mysqli_fetch_assoc($result2);
    $idrows = $rows['id'];
    $sql_img_2 =  "DELETE FROM `like_post` WHERE id = '$idrows'";
    $inserted_3 = mysqli_query($con, $sql_img_2);
    $sqlupdate = "SELECT total_like FROM `text_post` WHERE id = '$id'";
    $updated1 = mysqli_query($con, $sqlupdate);
    $byk = mysqli_fetch_assoc($updated1);
    $tolLike = $byk['total_like'];
    $tolLike--;
    $sqlupdate2 = "UPDATE `text_post` SET `total_like`= '$tolLike' WHERE id = '$id'";
    $updated2 = mysqli_query($con, $sqlupdate2);
    if($inserted_3 && $updated2){
        echo "1-".$tolLike;
    }else{
        echo '3-';
    }

}
else{
   
    $sql_img_2 =  "INSERT INTO `like_post`(`id`, `id_user`, `id_post`) VALUES (null,'$iduser','$id')";
    $inserted_3 = mysqli_query($con, $sql_img_2);
    $sqlupdate = "SELECT total_like FROM `text_post` WHERE id = '$id'";
    $updated1 = mysqli_query($con, $sqlupdate);
    $byk = mysqli_fetch_assoc($updated1);
    $tolLike = $byk['total_like'];
    $tolLike++;
    $sqlupdate2 = "UPDATE `text_post` SET `total_like`= '$tolLike' WHERE id = '$id'";
    $updated2 = mysqli_query($con, $sqlupdate2);
    if($inserted_3 && $updated2){
        echo "2-".$tolLike;
    }else{
        echo '4-';
    }

}







?>