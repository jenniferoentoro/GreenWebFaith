<?php
include 'connection.php';
if (!isset($_SESSION['id_user'])) {
    //redirect to login
    header('location: home.php');
}
//echo date time now
$datetime1 = strtotime('May 3, 2012 10:38:22 GMT');
$datetime2 = strtotime('06 Apr 2012 07:22:21 GMT');
$secs = $datetime2 - $datetime1;// == <seconds between the two times>
$days = $secs / 86400;
echo $days;
// echo date("Y-m-d H:i:s");
// echo($_SESSION['id_user']);
?>