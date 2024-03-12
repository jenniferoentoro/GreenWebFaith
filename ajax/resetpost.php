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




            $post = "SELECT text_post.id as idPost, total_like,text_content, image, date(date_uploaded) as date_only, username, name FROM text_post JOIN user_data  ON user_data.id = text_post.id_user WHERE email= '$email' ORDER BY date_uploaded DESC";

            $code = '';
            $continue = '';
            $option = '';
            $action = mysqli_query($con, $post);
            $i = 1;
            while ($result= mysqli_fetch_assoc($action)){



                if ($result['image'] != '' && $result['text_content'] == ''){
                    $code .="
                    <div class='col-12'>
                    <div class='image_content'>
                    <img class='postimage' align='center' id='post_image-".$result['idPost']."'  src='".$result['image']."'>
                    </div>
                    </div>";   

                    $option .="
                    <div class='col-12' align='right'>
                    <i class='fas fa-trash-alt fa-lg trash' id='delete-".$result['idPost']."' style='cursor:pointer; margin-right:2%;'></i>
                    </div>
                    ";
                } else if ($result['image'] == '' && $result['text_content'] != '') {
                    $code .="
                    <div class='col-12'>
                    <div class='post_content'>
                    <p class='content' id='content-".$result['idPost']."' align='left'>".$result['text_content']."</p>
                    </div>
                    </div>
                    ";

                    $option .="
                    <div class='col-12' align='right'>
                    <i class='fas fa-pencil-alt fa-lg editan' id='seeUpdate-".$result['idPost']."' data-bs-toggle='modal' data-bs-target='#staticBackdrop-2' style='cursor:pointer; margin-right:2%;'></i>
                    <i class='fas fa-trash-alt fa-lg trash' id='delete-".$result['idPost']."' style='cursor:pointer; margin-right:2%;'></i>
                    </div>
                    ";

                } else if ($result['image'] != '' && $result['text_content'] != ''){
                    $code .= " 
                    <div class='col-12'>
                    <div class='post_content'>
                    <p class='content' id='content-".$result['idPost']."' align='left'>".$result['text_content']."</p>
                    </div>
                    </div>
                    <div class='col-12'>
                    <div class='image_content'>
                    <img class='postimage' align='center' id='post_image-".$result['idPost']."'  src='".$result['image']."'>
                    </div>
                    </div>";

                    $option .="
                    <div class='col-12' align='right'>
                    <i class='fas fa-pencil-alt fa-lg editan' id='seeUpdate-".$result['idPost']."' data-bs-toggle='modal' data-bs-target='#staticBackdrop-2' style='cursor:pointer; margin-right:2%;'></i>
                    <i class='fas fa-trash-alt fa-lg trash' id='delete-".$result['idPost']."' style='cursor:pointer; margin-right:2%;'></i>
                    </div>
                    ";
                }

                      $idPost = $result['idPost'];

        $sqludahlike = "SELECT * FROM `like_post` WHERE id_user = '$id' && id_post = '$idPost'";

        $resultudahlike = mysqli_query($con, $sqludahlike);




                $continue .= "
                <div style='width: 400px; height:auto; cursor: pointer; margin-top:10px; margin-right:5px; ' id='card-".$result['idPost']."' class='card'>
                <div class='row' align='center'>

                <div style=''>
                <img style='width: 40px;float:left' class='post_img' src='".$row['profileImg']."' alt=''>
                <p class='main_heading' align='left'>&nbsp&nbsp&nbsp&nbsp".$result['username']."</p>
                
                </div>
                </div>


                <div class='row' align='center'>

                ".$code."

                ".$option;

                if ($resultudahlike->num_rows > 0) {

                    $continue .= "

                    <div  align='right' class='col-12'>
                    <i style='cursor:pointer;' id='like-".$result['idPost']."' class='fa-solid fa-bookmark maulike'></i><p id='likenih-".$result['idPost']."' style='display:inline'> ".$result['total_like']." Saved</p>

                    </div>";

                }else{

                    $continue .= "

                    <div  align='right' class='col-12'>
                    <i style='cursor:pointer;' id='like-".$result['idPost']."' class='fa-regular fa-bookmark maulike'></i><p id='likenih-".$result['idPost']."' style='display:inline'> ".$result['total_like']." Saved</p>

                    </div>";

                }

         $continue .= "

                
                </div>

                </div>



                
                ";

                $code = '';
                $option = '';



            }
            echo $continue;
        ?>