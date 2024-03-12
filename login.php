<?php
include "connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if (empty($_POST['email'])) {
		echo "1";
	}
	else if (empty($_POST['password'])) {
		echo "2";
	}
	else{
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$email = $con->real_escape_string(test_input($_POST['email']));

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			echo "6";}
  		else{
		$password = $con->real_escape_string(test_input($_POST['password']));
		$check = "SELECT * FROM `user_data` WHERE email='".$email."'";
		$result = $con->query($check);
		$count = $result->num_rows;
				if($count > 0){
					while($row = $result->fetch_assoc()){
						if(password_verify($password, $row['password'])){
							$role = mysqli_fetch_assoc(mysqli_query($con, "SELECT role,name FROM user_data WHERE email = '$email'"));
							$_SESSION['email'] = $email;
							$_SESSION['role'] = $role['role'];
							$_SESSION['namaUser'] = $role['name'];
							$_SESSION['id_user'] = $row['id'];

							// $_SESSION['email'] = "jenniferoentoro@gmail.com";
							// $_SESSION['role'] = 2;
							// $_SESSION['namaUser'] = "k";
							// $_SESSION['id_user'] = 12;
							
							if($_SESSION['role'] == 0 || $_SESSION['role'] == 2){
								echo "0";
							}  elseif ($_SESSION['role'] == 1){
								echo "7";
							}
							
						} else{
							echo "3";
						}
					}
				}
				else{
					echo "4";
				}	
		}
	}
}
else{
	echo "5";
}
?>