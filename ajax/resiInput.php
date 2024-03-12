<?php
	include "../connection.php";
	$email = $_SESSION['email'];

	$sign = '';
	$resi = $_POST['resi'];
    $id = $_POST['id'];
	
	

/*	echo "<pre>";
	print_r($_FILES);*/

	# Find user ID
	$getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
    $find = mysqli_fetch_assoc($getID);
    $id_user = $find["id"];
	$username = $find["name"];
	
	if(mysqli_num_rows($getID) == 1){
		 if($resi != '' &&$id != ''){

            
						$sql_text_1 = "INSERT INTO `noresicus`(`id`, `noresi`, `idOrder`) VALUES (null,'$resi','$id')";
						$inserted_1 = mysqli_query($con, $sql_text_1);
                        $sql_text_2 = "UPDATE `orders` SET `status`=4 WHERE id='$id'";
						$inserted_2 = mysqli_query($con, $sql_text_2);
						if ($inserted_1 && $inserted_2){
							$sign .= "success";
						} else {
							$sign .= "failed";
						}
					
				

		} else{
			$sign .= "failed";
		}
	} else {
		$sign .= "failed";
	}

	echo $sign;
?>