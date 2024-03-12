<?php
	include "connection.php";
	$email = $_POST['email'];
	$nohp = $_POST['nohp'];
	$alamat = $_POST['alamat'];
	$namabank = $_POST['namabank'];
	$rekening = $_POST['rekening'];

	$quser = "SELECT * FROM user_data";
	$stmt = mysqli_query($con, $quser);

	$rows = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

	foreach($rows as $row) {
		if ($email == $row['email']){
			$id = $row['id'];
			break;
		}
	}

	$sql = "UPDATE designer SET phoneNumber='$nohp', designerAddress='$alamat', bankName='$namabank', bankAccount='$rekening' WHERE idUser=$id;";

	if (mysqli_query($con, $sql) == TRUE) {
		echo 1;
	} 
	else {
		echo("Error description: " . $con -> error);
		echo 2;
	}
?>