<?php
include '../connection.php';
//select all rooms where user is in the room
$sql = "SELECT * FROM chat_room WHERE id_user1 = ".$_SESSION['id_user']." OR id_user2 = ".$_SESSION['id_user'];
$result = mysqli_query($con, $sql);
$result = $result->fetch_all(MYSQLI_ASSOC);
//get length
$length = count($result);
foreach ($result as $row) {
    //get id of other user
    $user1 = $row['id_user1'];
    $user2 = $row['id_user2'];
    if ($user1 == $_SESSION['id_user']) {
        $other_user = $user2;
    } else {
        $other_user = $user1;
    }
    //get other user's username
    $sql = "SELECT * FROM user_data WHERE id = $other_user";
    $result2 = mysqli_query($con, $sql);
    $result2 = $result2->fetch_all(MYSQLI_ASSOC);
    $other_user_name = $result2[0]['name'];
    $other_user_username = $result2[0]['username'];
    $other_user_img = $result2[0]['profileImg'];
    $message="hello";
    //echo as clickable buttons
    echo "<li style='cursor: pointer' onclick='getChat(".$row['id_room'].")' class='' id=room-".$row['id_room'].">
    <div class='d-flex bd-highlight'>
        <div class='img_cont'>
            <img src='$other_user_img'
                class='rounded-circle user_img'>
            
        </div>
        <div class='user_info'>
            <span>".$other_user_name."</span>
            <p>".$other_user_username."</p>
        </div>
    </div>
</li>";
    // echo "<button class='btn btn-primary' onclick='getChat(".$row['id_room'].")'>".$row['id_room'].$other_user_username."</button>";
}
?>