<?php
include "../connection.php";
                    $email = $_SESSION['email'];
                    $getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
                    $find = mysqli_fetch_assoc($getID);
                    $id_user = $find["id"];
                    $output = "";
                    $list = "SELECT customer_data.username customer_data_username, orders.id,orders.alamat,orders.nama,orders.jenis,orders.status, user_data.username, orders.tglOrder, order_details.longHours,order_details.cost, orderacc.transfer_proof FROM `orders` JOIN user_data ON user_data.id = orders.idDesigner JOIN user_data customer_data on customer_data.id = orders.idUser JOIN order_details ON orders.id = order_details.idOrder JOIN orderacc ON orderacc.idOrder = orders.id WHERE status = -3";
                    $action = mysqli_query($con, $list);
                    $i = 1;
                    while ($result = mysqli_fetch_assoc($action)){
                        $output .= 
                        '
                        <tr id="'.$result['id'].'">
                        <td class="text-center">'.$i.'</td>
                        <td class="text-center">'.$result['tglOrder'].'</td>
                        <td class="text-center">'.$result['customer_data_username'].'</td>

                        <td class="text-center">'.$result['username'].'</td>
                 
                        <td class="text-center">'.$result['cost'].'</td>
                        <td class="text-center"><button id="'.$result['transfer_proof'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalBefore" class="btn btn-success befores">See Picture</button></td>
                        
               
                             
                        </tr> 
     

                       
                        
                        </tr> 
                        ';
                        $i++;    
                    }

                    echo $output;?>