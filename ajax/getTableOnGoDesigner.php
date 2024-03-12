<?php
include "../connection.php";
                    $email = $_SESSION['email'];
                    $getID = mysqli_query($con, "SELECT `id`, `name` FROM user_data WHERE email='$email'");
                    $find = mysqli_fetch_assoc($getID);
                    $id_user = $find["id"];
                    $output = "";
                    $list = "SELECT orders.id,orders.alamat,orders.nama,orders.jenis,orders.imgBefore,orders.imgAfter,orders.status, user_data.username, orders.tglOrder, order_details.longHours,order_details.cost, noresides.noresi AS noresides ,noresicus.noresi AS noresicus FROM `orders` JOIN user_data ON user_data.id = orders.idDesigner JOIN order_details ON orders.id = order_details.idOrder LEFT JOIN noresicus ON noresicus.idOrder = orders.id LEFT JOIN noresides ON noresides.idOrder = orders.id WHERE idDesigner = '$id_user' AND (status = 2 OR status = 3 OR status = 4 OR status = 5 OR status = 6 OR status = 8)";
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
                        if($result['noresicus'] == ""){
                            $output.=

                            '
                            
                            <td class="text-center"><i class="fa-solid fa-xmark"></i></td>
                                                 
                                 
                            
                            
                            ';
                        }else{
                            $output.=

                            '
                            
                            <td class="text-center">'.$result['noresicus'].'</td>
                                                 
                                 
                            
                            
                            ';
                        }

                        if($result['noresides'] == ""){
                            $output.=

                            '
                            
                            <td class="text-center"><i class="fa-solid fa-xmark"></i></td>
                                                 
                                 
                            
                            
                            ';
                        }else{
                            $output.=

                            '
                            
                            <td class="text-center">'.$result['noresides'].'</td>
                                                 
                                 
                            
                            
                            ';
                        }


                        if($result['status'] == 2){
                            $output.=

                            '
                            <td class="text-center">Bukti tf sedang dipriksa.</td>
                            <td class="text-center"><i class="fa-solid fa-xmark"></i></td>
                                                    </tr> 
                                 
                            
                            
                            ';

                        } else if($result['status'] == 3){
                            $output.=

                            '
                            <td class="text-center">Bukti tf sudah di setujui. Menunggu Pakaian dikirim oleh customer.</td>
                            <td class="text-center"><i class="fa-solid fa-xmark"></i></td>
                                                    </tr> 
                                 
                            
                            
                            ';

                        }else if($result['status'] == 4){
                            $output.=

                            '
                            <td class="text-center">Paket telah dikirim oleh customer.</td>
                            <td class="text-center" id="formhere'.$result['id'].'">
                            <button id="here-'.$result['id'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalDone" class="btn btn-warning here">Konfirmasi Sampai dan kerjakan</button></td>
                          
                                                    </tr> 
                                 
                            
                            
                            ';
                        }else if($result['status'] == 5){
                            $output.=

                            '
                            <td class="text-center">Paket di proses designer.</td>
                            <td class="text-center" id="formdone'.$result['id'].'">
                            <button id="doneProcess-'.$result['id'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalDone" class="btn btn-warning doneProcess">Konfirmasi selesai kerja</button></td>
                          
                                                    </tr> 
                                 
                            
                            
                            ';
                        }else if($result['status'] == 6){
                            $output.=

                            '
                            <td class="text-center">Paket selesai di proses</td>
                            <td class="text-center" id="forminputResi'.$result['id'].'">
                            <button id="accept-'.$result['id'].'" type="button" data-bs-toggle="modal" data-bs-target="#modalResi" class="btn btn-warning noresiInput">Input Resi</button></td>
                          
                                                    </tr> 
                                 
                            
                            
                            ';
                        }else if($result['status'] == 8){
                            $output.=

                            '
                            <td class="text-center">Paket telah dikirim kepada customer.</td>
                            <td class="text-center"><i class="fa-solid fa-xmark"></i></td>
                          
                                                    </tr> 
                                 
                            
                            
                            ';
                        }
                        $i++;    
                    }

                    echo $output;?>