<?php
	include "../connection.php";
	$email = $_SESSION['email'];

	$sign = '';
    $id = $_POST['id'];
	
	

/*	echo "<pre>";
	print_r($_FILES);*/

	# Find user ID
	$getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
    $find = mysqli_fetch_assoc($getID);
    $id_user = $find["id"];
	$username = $find["name"];

	if (!empty($_FILES)){
		#image 1
		$image = $_FILES['file'];
		$imageName = $image['name'];
		$extension = pathinfo($imageName, PATHINFO_EXTENSION);	

		# Rename File
		$date = date('y-m-d');
		$newName = $id_user."_".$username."_".$date."_".uniqid().".".$extension;
	}

	

	# List of extension
	$valid_extensions = array('jpg', 'jpeg', 'png'); 

	
	if(mysqli_num_rows($getID) == 1){
		 if($id != ''  && !empty($image)){
				# Text input
				# Check extension
				if (in_array(strtolower($extension), $valid_extensions)){
					# Moving the File 1
						$file_address = $_SERVER["DOCUMENT_ROOT"].'/GreenWebFaith/transferDesignproof/'.$newName;
						$file_foto = 'transferDesignproof/'.$newName;
						$moved = move_uploaded_file($_FILES["file"]["tmp_name"], $file_address );

				
		
					#Check if moved
					if ($moved){
                        
                        
						$sql_text_1 = "INSERT INTO `paydesigner`(`id`, `buktiTf`, `idOrder`) VALUES (null,'$file_foto','$id')";
						$inserted_1 = mysqli_query($con, $sql_text_1);
                        $sql_text_2 = "UPDATE `orders` SET `status`=9 WHERE id='$id'";
						$inserted_2 = mysqli_query($con, $sql_text_2);
						if ($inserted_1 && $inserted_2){
							$sign .= "success";
						} else {
							$sign .= "failed";
						}
					} else {
						$sign .= "failed";
					}
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