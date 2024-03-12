<?php
include '../connection.php';
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "SELECT * FROM chat_room WHERE id_room = ".$_POST['id_room'];
    $result = mysqli_query($con, $sql);
    //fetch 1st row
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $row = $result[0];
    $id_user1 = $row['id_user1'];
    $id_user2 = $row['id_user2'];
    //get other user
    if ($id_user1 == $_SESSION['id_user']) {
        $other_user = $id_user2;
    } else {
        $other_user = $id_user1;
    }
    //get other user's username
    $sql = "SELECT name, username, profileImg, email FROM user_data WHERE id = $other_user";
    $result = mysqli_query($con, $sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $other_user_name = $result[0]['name'];
    $other_user_img = $result[0]['profileImg'];
    $other_user_username = $result[0]['username'];
    $other_user_email = $result[0]['email'];

    //get all chat where room is post id room
    $room_id = $_POST['id_room'];
    $sql = "SELECT * FROM chat WHERE id_room = $room_id";
    $result = mysqli_query($con, $sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    //get length
    $length = count($result);
    $chat_html = "";
    //client date
    $client_date = $_POST['client_date'];
    //format date to dd-mm-yyyy hh:mm:ss
    $client_date = date("d-m-Y H:i:s", $client_date);
    // $server_date = date('d-m-Y H:i', strtotime("+60 min"));
    $server_date = date('d-m-Y H:i:s');

    $diff = strtotime($client_date) - strtotime($server_date);

    
    

    foreach ($result as $row) {
        //get date
        $date = $row['date'];
        //add diff minutes to date
        $date = date('d-m-Y H:i:s', strtotime($date . " +$diff seconds"));
        //format to dd-mm-yyyy hh:mm
        $date = date("d-m-Y H:i", strtotime($date));
        //replace space in date with &nbsp;
        $date = str_replace(" ", "<br>", $date);
        //replace all \n with <br>
        $message = str_replace("\n", "<br>", $row['message']);
        //echo chat
        if ($row['id_sender'] == $_SESSION['id_user']) {
            // $chat_html = $chat_html . "<div class='d-flex justify-content-end'><div class='msg_cotainer_send mr-0'>".$message."</div></div><div class='d-flex justify-content-end mb-4 msg_time_special'>".$date."</div>";
            // $chat_html = $chat_html . "<div class='d-flex justify-content-end mb-4'><span class='msg_time_special align-self-end text-right pr-1'>".$date."</span><div class='msg_cotainer_send'>".$message."</div></div>";
            $chat_html = $chat_html . "<div class='d-flex justify-content-end mb-4'><div class='msg_cotainer_send'>".$message."</div><span class='msg_time_special align-self-end'>".$date."</span></div>";

        } else {
            $chat_html = $chat_html . "<div class='d-flex justify-content-start mb-4'><span class='msg_time_special align-self-end text-right'>".$date."</span><div class='msg_cotainer'>".$message."</div></div>";
        }
    }
    //json encode other user's username and chat html
    $json_data = json_encode(array("other_user_username" => $other_user_username, "other_user_name" => $other_user_name, "other_user_img" => $other_user_img, "chat_html" => $chat_html, "client_date" => $diff, "other_user_email" => $other_user_email));
    echo $json_data;
}


?>