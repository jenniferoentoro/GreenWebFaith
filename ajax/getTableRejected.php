<?php
include "../connection.php";
                    $email = $_SESSION['email'];
                    $getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
                    $find = mysqli_fetch_assoc($getID);
                    $id_user = $find["id"];
                    $output = "";
                    $list = "SELECT orders.id,orders.alamat,orders.nama,orders.jenis,orders.imgBefore,orders.imgAfter,orders.status, user_data.username, orders.tglOrder, order_details.longHours,order_details.cost FROM `orders` JOIN user_data ON user_data.id = orders.idDesigner JOIN order_details ON orders.id = order_details.idOrder WHERE idDesigner = '$id_user' AND (status = -2 OR status=-3)";
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
                        <td class="text-center">'.$result['longHours'].'</td>
                        <td class="text-center">'.$result['cost'].'</td>
                        <td class="text-center"><button id="'.$result['imgBefore'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalBefore" class="btn btn-success befores">See Picture</button></td>
                        <td class="text-center"><button id="'.$result['imgAfter'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalAfter" class="btn btn-success after">See Picture</button></td>
     

                       
                        ';
                        if($result['status'] == -2){
                            $output .= 
                        '
                        
                        <td class="text-center">Customer Reject</td>
                        
     

                       
                        </tr> 
                        ';
                        }else if($result['status'] == -3){
                            $output .= 
                        '
                        
                        <td class="text-center">Bukti tf ditolak</td>
                        
     

                       
                        </tr> 
                        ';
                        }
                        $i++;   
                         
                    }

                    echo $output;?>