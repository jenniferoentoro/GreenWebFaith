<?php 
include "../connection.php";
$id = $_POST['id'];
$sqlnotif = "SELECT name,profileImg FROM user_data JOIN `user_follow` ON user_data.id = user_follow.id_user_follower WHERE id_user_following = '$id' ORDER BY user_follow.id DESC";
$resultnotif = mysqli_query($con, $sqlnotif);
$output = "";
$kosong1 = 0;

$kosong2 = 0;

$sqlnotif2 = "SELECT like_post.id_user as idbener FROM text_post JOIN like_post ON text_post.id = like_post.id_post JOIN user_data ON text_post.id_user = user_data.id WHERE text_post.id_user ='$id'";
$resultnotif2 = mysqli_query($con, $sqlnotif2);
if ($resultnotif2->num_rows > 0) {
    while($res2= mysqli_fetch_assoc($resultnotif2)){
        $temp = $res2['idbener'];
        $resultnotif3 =  mysqli_fetch_assoc(mysqli_query($con, "SELECT name,profileImg FROM user_data WHERE id = '$temp'"));

        $output.=" <div style='text-align:center' class='row'>
        <p><img class='post_img'src='".$resultnotif3['profileImg']."' alt=''>".$resultnotif3['name']." like your post</p>
        </div>";
    }
}else{
    $kosong2 = 1;
}


if ($resultnotif->num_rows > 0) {
    while($res= mysqli_fetch_assoc($resultnotif)){
        $output.=" <div style='text-align:center' class='row'>
        <p><img class='post_img'src='".$res['profileImg']."' alt=''>".$res['name']." started following you</p>
        </div>";
    }
    

}else{
    $kosong1 = 1;
}



if($kosong1 == 1 && $kosong2 == 1){
    echo "<p>No Notification yet</p>";
}



   echo $output;

?>