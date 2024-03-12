<?php
include "../connection.php";
                    $email = $_SESSION['email'];
                    $getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
                    $find = mysqli_fetch_assoc($getID);
                    $id_user = $find["id"];
                    $output = "";
                    $list = "SELECT orders.id,orders.alamat,orders.nama,orders.jenis,orders.imgBefore,orders.imgAfter,orders.status, user_data.username, orders.tglOrder FROM `orders` JOIN user_data ON user_data.id = orders.idDesigner WHERE idUser = '$id_user' AND status = 0";
                    $action = mysqli_query($con, $list);
                    $i = 1;
                    while ($result = mysqli_fetch_assoc($action)){
                        $output .= 
                        '
                        <tr id="'.$result['id'].'">
                        <td class="text-center">'.$i.'</td>
                        <td class="text-center">'.$result['tglOrder'].'</td>
                        <td class="text-center">'.$result['username'].'</td>
                        <td class="text-center">'.$result['nama'].'</td>
                        <td class="text-center">'.$result['alamat'].'</td>
                        <td class="text-center">'.$result['jenis'].'</td>
                        <td class="text-center"><button id="'.$result['imgBefore'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalBefore" class="btn btn-success befores">See Picture</button></td>
                        <td class="text-center"><button id="'.$result['imgAfter'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalAfter" class="btn btn-success after">See Picture</button></td>
                        <td class="text-center">Waiting for desinger response</td>
                        
     

                       
                        
                        </tr> 
                        ';
                        $i++;    
                    }

                    echo $output;?>