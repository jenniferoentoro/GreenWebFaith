<?php
	include "../connection.php";
	
	$lama = $_POST['lama'];
	$biaya = $_POST['biaya'];
	$id = $_POST['id'];
	$sign="";
	
	if($lama!=""||$biaya!=""||$id!=""){
		$sql_text_1 = "INSERT INTO `order_details`(`id`, `longHours`, `cost`, `idOrder`) VALUES (null, '$lama','$biaya','$id')";
						$inserted_1 = mysqli_query($con, $sql_text_1);

		$sql_text_2 = "UPDATE `orders` SET `status`=1 WHERE id='$id'";
						$inserted_2 = mysqli_query($con, $sql_text_2);
						if ($inserted_1 && $inserted_2){
							$sign .= "success";
						} else {
							$sign .= "failed";
						}
	}else{
		$sign .= "failed";
	}

	echo $sign;
?>