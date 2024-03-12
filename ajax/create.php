<?php
	include "../connection.php";
	$email = $_SESSION['email'];
	$sign = '';
	$text = $_POST['text'];
	
	
/*
	echo "<pre>";
	print_r($_FILES);*/

	# Find user ID
	$getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
    $find = mysqli_fetch_assoc($getID);
    $id_user = $find["id"];
	$username = $find["name"];

	if (!empty($_FILES)){
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
		 if($text != '' && !empty($image) ){
				# Text input
				# Check extension
				if (in_array(strtolower($extension), $valid_extensions)){
					# Moving the File
						$file_address = $_SERVER["DOCUMENT_ROOT"].'/GreenWebFaith/portofolio/'.$newName;
						$file_foto = 'portofolio/'.$newName;
						$moved = move_uploaded_file($_FILES["file"]["tmp_name"], $file_address );
		
					#Check if moved
					if ($moved){
						
						$sql_text_1 = "INSERT INTO text_post(id_user, text_content, image, total_like) VALUES('$id_user', '$text','$file_foto',0)";
						$inserted_1 = mysqli_query($con, $sql_text_1);
						if ($inserted_1){
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

		} else if (!empty($image) && $text == ''){

			# Check extension
			if (in_array(strtolower($extension), $valid_extensions)){
				# Moving the File
					$file_address = $_SERVER["DOCUMENT_ROOT"].'/GreenWebFaith/portofolio/'.$newName;
					$file_foto = 'portofolio/'.$newName;
					$moved = move_uploaded_file($_FILES["file"]["tmp_name"], $file_address );
					// echo "<pre>";
					// print_r($_FILES);

				#Check if moved
				if ($moved){
					# Check file input
					$sql_img_2 =  "INSERT INTO text_post(id_user, text_content, image) VALUES('$id_user', '','$file_foto')";
					$inserted_3 = mysqli_query($con, $sql_img_2);
						if ($inserted_3){
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

			

		} else if (empty($image) && $text != '') {
			$sql_text_2 =  "INSERT INTO text_post(id_user, text_content, image) VALUES('$id_user', '$text','')";
			$inserted_4 = mysqli_query($con, $sql_text_2);
				if ($inserted_4){
					$sign .= "success";
				} else {
					$sign .= "failed";
				}
		}
	} else {
		$sign .= "failed";
	}

	echo $sign;
?>