<?php
include '../connection.php';
$sql = "SELECT * FROM user_data";
$result = mysqli_query($con, $sql);
$result = $result->fetch_all(MYSQLI_ASSOC);
//get row length
// $row_length = $result->num_rows;
// if ($row_length > 0) {
//     foreach ()
// } else {
//     echo "0 results";
// }
// print_r($result);
//get length
$length = count($result);
foreach ($result as $row) {
    //echo as clickable buttons
    echo "<button class='btn btn-primary' onclick='createRoom(".$row['id'].")'>".$row['name']."</button>";
}

?>