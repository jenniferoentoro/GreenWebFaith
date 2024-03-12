<?php
	include "../connection.php";
	

	$id = $_POST['id'];
	$sign="";
	
	if($id!=""){
		
		$sql_text_1 = "UPDATE `orders` SET `status`= -2 WHERE id='$id'";
						$inserted_1 = mysqli_query($con, $sql_text_1);
						if ($inserted_1){
							$sign .= "success";
						} else {
							$sign .= "failed";
						}
	}else{
		$sign .= "failed";
	}

	echo $sign;
?>