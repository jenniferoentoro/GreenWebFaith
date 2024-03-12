<?php
include '../connection.php';
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $other_user = $_POST['id_user2'];
    //get all rooms in database where user1 and user2 are in the same room
    $cur_user = $_SESSION['id_user'];
    $sql = "SELECT * FROM chat_room WHERE (id_user1 = $cur_user AND id_user2 = $other_user) OR (id_user1 = $other_user AND id_user2 = $cur_user)";
    $result = mysqli_query($con, $sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    //get length
    $length = count($result);
    if ($length > 0) {
        //get room id
        $room_id = $result[0]['id_room'];
        //redirect to chat
        // header('location: chat.php?id_room='.$room_id);
        //return room id
        echo $room_id;
    } else {
        //create new room
        $sql = "INSERT INTO chat_room (id_user1, id_user2) VALUES ($cur_user, $other_user)";
        $result = mysqli_query($con, $sql);
        //get room id
        $room_id = mysqli_insert_id($con);
        //redirect to chat
        // header('location: chat.php?id_room='.$room_id);
        echo $room_id;

    }

}

?>