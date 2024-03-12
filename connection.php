<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
//$con = mysqli_connect($servername, $username, $password,"projecttekweb");

$con = mysqli_connect($servername, $username, $password,"ecofaith");

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

session_start();
?>