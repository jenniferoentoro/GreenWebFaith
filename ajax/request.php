<?php
	include "../connection.php";
	$email = $_SESSION['email'];
	$profile = $_SESSION['profile'];

	$sign = '';
	$name = $_POST['name'];
	$alamat = $_POST['alamat'];
	$jenis = $_POST['jenis'];
	
	

/*	echo "<pre>";
	print_r($_FILES);*/

	# Find user ID
	$getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
    $find = mysqli_fetch_assoc($getID);
    $id_user = $find["id"];
	$username = $find["name"];


	# Find designer ID
	$getID2 = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE username='$profile'");
    $find2 = mysqli_fetch_assoc($getID2);
    $id_designer = $find2["id"];
	

	if (!empty($_FILES)){
		#image 1
		$image = $_FILES['file'];
		$imageName = $image['name'];
		$extension = pathinfo($imageName, PATHINFO_EXTENSION);	

		# Rename File
		$date = date('y-m-d');
		$newName = $id_user."_".$username."_".$date."_".uniqid().".".$extension;

		#image 2
		$image2 = $_FILES['file2'];
		$imageName2 = $image2['name'];
		$extension2 = pathinfo($imageName2, PATHINFO_EXTENSION);	

		# Rename File
		$date2 = date('y-m-d');
		$newName2 = $id_user."-".$username."-".$date."-".uniqid().".".$extension2;
	}

	

	# List of extension
	$valid_extensions = array('jpg', 'jpeg', 'png'); 

	
	if(mysqli_num_rows($getID) == 1){
		 if($alamat != '' &&$name != '' &&$jenis != '' && !empty($image)&& !empty($image2) ){
				# Text input
				# Check extension
				if (in_array(strtolower($extension), $valid_extensions) && in_array(strtolower($extension2), $valid_extensions)){
					# Moving the File 1
						$file_address = $_SERVER["DOCUMENT_ROOT"].'/GreenWebFaith/order/'.$newName;
						$file_foto = 'order/'.$newName;
						$moved = move_uploaded_file($_FILES["file"]["tmp_name"], $file_address );

					# Moving the File 2
						$file_address2 = $_SERVER["DOCUMENT_ROOT"].'/GreenWebFaith/order/'.$newName2;
						$file_foto2 = 'order/'.$newName2;
						$moved2 = move_uploaded_file($_FILES["file2"]["tmp_name"], $file_address2 );
		
					#Check if moved
					if ($moved && $moved2){
						$sql_text_1 = "INSERT INTO `orders`(`id`, `alamat`, `nama`, `jenis`,`imgBefore`, `imgAfter`, `status`, `idUser`, `idDesigner`) VALUES (null,'$alamat','$name','$jenis','$file_foto','$file_foto2',0,'$id_user','$id_designer' )";
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

		} else{
			$sign .= "failed";
		}
	} else {
		$sign .= "failed";
	}

	echo $sign;
?>