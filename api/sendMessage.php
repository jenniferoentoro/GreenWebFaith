<?php
include '../connection.php';
if($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_user = $_SESSION['id_user'];
    $id_room = $_POST['id_room'];
    $message = $_POST['message'];
    $sql = "INSERT INTO chat (id_sender, id_room, message) VALUES ($id_user, $id_room, '$message')";
    $result = mysqli_query($con, $sql);
    echo "success";
}

?>