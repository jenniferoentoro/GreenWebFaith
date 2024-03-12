<?php
require_once("connection.php");


	$username = $_POST["username"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	


	$sql = "SELECT * FROM user_data WHERE email='$email'";
	$result = mysqli_query($con, $sql);
	if ($result->num_rows > 0) {
		echo "4";
		return;
	} else {



		$sql7 = "SELECT * FROM user_data WHERE username='$username'";
		$result7 = mysqli_query($con, $sql7);
		if ($result7->num_rows > 0) {
			echo "14";
			return;
		}else{
		



			$select_query = "SELECT special_code, date_valid_until FROM activation_status WHERE email='$email';";
			$result = mysqli_query($con, $select_query)->fetch_all();
			$result_length = count($result);
			if ($result_length != 0) {
				$last_request = $result[$result_length-1][1];
				if ($last_request < date('Y-m-d H:i:s')) {
				echo "9"; //your special code has expired. please request a new one
				return;
			} else {
				if ($result[$result_length-1][0] == $_POST['special_code']) {
					$password = $_POST['password'];
					//bcrypt password
					$password = password_hash($password, PASSWORD_DEFAULT);
					// $insert_query = "INSERT INTO user_data (name, email, password) VALUES ('$name', '$email', '$password');";
					// $result = mysqli_query($con, $insert_query);
					$q = mysqli_query($con, "INSERT INTO `user_data`(`id`, `name`, `username`, `role`, `email`, `password`, `profileImg`, `bio`) VALUES (null, '$name',	'$username', 0, '$email', '$password','images/profiledefault.png',' ')"); 
					echo "200"; //registered successfully
					return;
				} else {
					echo "8"; //your special code is incorrect
					return;
				}
			}
		} else {
			echo "6"; //please request special code
			return;
		}

	}




		// //bcrypt password
		// $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		// 	echo "2";}
  		// else{


		// 	$q = mysqli_query($con, "INSERT INTO `user_data`(`id`, `name`, `role`, `email`, `password`, `profileImg`, `bio`) VALUES (null, '$name', 0, '$email', '$password','../assets/profiledefault.png',' ')"); 
		// 	if($q){ 
		// 		echo "1";
		// 	}else{
		// 		echo "0";
		// 	}
		// }

}


?>