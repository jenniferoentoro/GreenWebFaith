<?php
            include '../connection.php';
            
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];

                $sql = "SELECT * FROM user_data WHERE email='$email'";
                $result = mysqli_query($con, $sql);
                if ($result->num_rows > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $nama = $row['name'];
                    $id = $row['id'];
                    $profileImg = $row['profileImg'];
                } else {
                    echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
                }
            }
            $continue = '';
            $tes = "SELECT idDesigner, COUNT(status) FROM `orders` WHERE status = 7 OR status = 9 GROUP BY idDesigner ORDER BY COUNT(status) DESC LIMIT 3";
            $action2 = mysqli_query($con, $tes);
            if (mysqli_num_rows($action2) == 0){
                $continue.='
                <div class="col-md-3 col-4 topDes">

                    <h5>None</h5>
                </div>
                
                ';
            }else{

            
            while ($result= mysqli_fetch_assoc($action2)){
                $idCari = $result['idDesigner'];
                $post = "SELECT username,profileImg FROM `user_data` WHERE id = '$idCari';";
                $action = mysqli_query($con, $post);
                $result= mysqli_fetch_assoc($action);
                $continue.='
                <div class="col-md-3 col-4 topDes">
                    <img onclick="viewProfile(\'' . $result["username"] . '\')" class="profileimg" src="'.$result['profileImg'].'" alt="">
                    <p>'.$result['username'].'</p>
                </div>
                
                ';

            }
        }



            

           
            echo $continue;
        ?>