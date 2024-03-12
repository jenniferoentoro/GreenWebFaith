<?php 

include '../connection.php';


$id = $_POST['id'];
$code = $_POST['code'];

if ($code == 0){
    $sqlnotif = "SELECT name, profileImg FROM user_data JOIN `user_follow` ON user_data.id = user_follow.id_user_following WHERE id_user_follower = '$id' ORDER BY user_follow.id DESC";
        $resultnotif = mysqli_query($con, $sqlnotif);
        $output = "";
        if ($resultnotif->num_rows > 0) {
            while($res= mysqli_fetch_assoc($resultnotif)){
                $output.=" <div style='text-align:center' class='row'>
                <p><img class='post_img'src='".$res['profileImg']."' alt=''>".$res['name']."</p>
                </div>";
            }
            echo $output;

        }else{
            echo "<p style='text-align:center'>No following</p>";
        }

}else if ($code == 1){
    $sqlnotif = "SELECT name, profileImg FROM user_data JOIN `user_follow` ON user_data.id = user_follow.id_user_follower WHERE id_user_following = '$id' ORDER BY user_follow.id DESC";
        $resultnotif = mysqli_query($con, $sqlnotif);
        $output = "";
        if ($resultnotif->num_rows > 0) {
            while($res= mysqli_fetch_assoc($resultnotif)){
                $output.=" <div style='text-align:center' class='row'>
                
                <p><img class='post_img'src='".$res['profileImg']."' alt=''>".$res['name']."</p>
                </div>";
            }
            echo $output;

        }else{
            echo "<p style='text-align:center'>No follower</p>";
        }

}




?>