<?php 

include 'connection.php';

error_reporting(0);

session_start();

$profile = $_SESSION['profile'];


if ($profile == $_SESSION['email']){
    header('Location: myprofile.php');
}

$email = $_SESSION['email'];
if (isset($_SESSION['email'])) {


    $sql = "SELECT * FROM user_data WHERE username='$profile'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['name'];
        $id = $row['id'];
        $profileImg = $row['profileImg'];
        $bio = $row['bio'];
        $roleOther = $row['role'];
    } else{
        /*header('Location: home.php');*/
        
    }
}
if (!isset($_SESSION['email'])) {
    //redirect to login
    header('location: ./home.php');
}


$sql2 = "SELECT username FROM user_data";
$result2 = mysqli_query($con, $sql2);

$arr = [];
while ($res= mysqli_fetch_assoc($result2)){
    $temp2 = $res['username'];
    array_push($arr,$temp2);
}


$sql3 = "SELECT id FROM orders WHERE idDesigner= '$id' AND (status=9 OR status=7)";
$result3 = mysqli_query($con, $sql3);

$countpost = 0;
while ($res= mysqli_fetch_assoc($result3)){
    $countpost++;
}




$sql4 = "SELECT * FROM `user_follow` WHERE id_user_follower = '$id'";
$result4 = mysqli_query($con, $sql4);

$following = 0;
while ($res= mysqli_fetch_assoc($result4)){
    $following++;
}


$sql5 = "SELECT * FROM `user_follow` WHERE id_user_following = '$id'";
$result5 = mysqli_query($con, $sql5);

$followers = 0;
while ($res= mysqli_fetch_assoc($result5)){
    $followers++;
}






$sql1 = "SELECT * FROM user_data WHERE email='$email'";
$result1 = mysqli_query($con, $sql1);

$row1 = mysqli_fetch_assoc($result1);
$iduser = $row1['id'];
$role = $row1['role'];

$sql2 = "SELECT * FROM `user_follow` WHERE id_user_follower = '$iduser' && id_user_following = '$id'";

$result2 = mysqli_query($con, $sql2);
$follow = 0;
if ($result2->num_rows > 0) {
    $follow = 1;
}






?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> -->
    <link rel="icon" href="assets\logo.png" sizes="20">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>


    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    nav {
        overflow: hidden;
    }

    h2 {
        overflow: hidden;
    }

    div.row.main {
        margin-top: 5%;
    }

    div.col-12 {
        margin-bottom: 2%;
    }

    div.heading {
        margin-top: 1%;
    }

    p.main_heading {
        margin-bottom: 0;

    }

    p.sub_heading {
        margin-bottom: 0;
        font-size: smaller;
    }

    p.subrightheading {
        font-size: smaller;
        margin: auto;
    }


    div.card {
        background: white;
        padding: 1em;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.089);
    }

    img.profileimg {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.432);
    }

    img.post_img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.432);
    }

    img.post_imagemodal {
        width: 10%;
        height: auto;
        border-radius: 50px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.432);
        margin-right: 4%;
    }

    div.post_content {
        margin-top: 3%;
        margin-left: 3%;
    }


    div.card.post {
        background: white;
        padding: 1em;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.089);
        width: 39%;
    }

    @media screen and (max-width: 960px) {
        div.card.post {
            width: 50%;
        }
    }


    @media screen and (max-width: 670px) {
        div.card.post {
            width: 70%;
        }
    }

    @media screen and (max-width: 767px) {
        .special_justify {
            display: flex;
            justify-content: center;
        }
    }

    @media screen and (max-width: 550px) {
        div.card.post {
            width: 100%;
        }

        div.card.post .special_padding {
            padding-left: 0;
        }

    }

    div.modal-content {
        border-radius: 20px;
    }

    textarea.inputarea,
    textarea.inputareaupdate {
        border: none;
        width: 95%;
    }

    .post_header {
        display: flex;
        align-items: center;
        margin-bottom: 0.4em;
        position: relative;
    }

    div.modal-footer.insert {
        display: block;
    }

    img.outputimg,
    img.postimage {
        width: 90%;
        padding-top: 2%;
        padding-bottom: 2%;
        margin: auto;
        border-radius: 20px;
    }


    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }



    ::selection {
        color: #fff;
        background: #664AFF;
    }

    .wrapper {
        max-width: 450px;
        margin: 150px auto;
    }

    .wrapper .search-input {
        background: #fff;
        width: 100%;
        border-radius: 5px;
        position: relative;
        box-shadow: 0px 1px 5px 3px rgba(0, 0, 0, 0.12);
    }

    .search-input input {
        height: 55px;
        width: 100%;
        outline: none;
        border: none;
        border-radius: 5px;
        padding: 0 60px 0 20px;
        font-size: 18px;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    }

    .search-input.active input {
        border-radius: 5px 5px 0 0;
    }

    .search-input .autocom-box {
        padding: 0;
        opacity: 0;
        pointer-events: none;
        max-height: 280px;
        overflow-y: auto;
    }

    .autocom-box2 {
        padding: 0;
        opacity: 0;
        pointer-events: none;
        max-height: 280px;
        overflow-y: auto;
    }

    .search-input.active .autocom-box {
        padding: 10px 8px;
        opacity: 1;
        pointer-events: auto;
    }

    .active.autocom-box2 {
        padding: 10px 8px;
        opacity: 1;
        pointer-events: auto;
    }

    .autocom-box li {
        list-style: none;
        padding: 8px 12px;
        display: none;
        width: 100%;
        cursor: default;
        border-radius: 3px;
    }

    .autocom-box2 li {
        list-style: none;
        padding: 8px 12px;
        display: none;
        width: 100%;
        cursor: default;
        border-radius: 3px;
    }

    .search-input.active .autocom-box li {
        display: block;
    }

    .active.autocom-box2 li {
        display: block;
    }

    .autocom-box li:hover {
        background: #efefef;
    }

    .autocom-box2 li:hover {
        background: #efefef;
    }

    /* .search-input .icon {
        position: absolute;
        right: 520px;
        top: 20px;
        height: 55px;
        width: 55px;
        text-align: center;
        line-height: 55px;
        font-size: 20px;
        color: #644bff;
        cursor: pointer;
    } */

    /*Login*/
    .login-box {}

    .login-box h2 {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
    }

    .login-box .user-box {
        position: relative;
    }

    .login-box .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }

    .login-box .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
        top: -20px;
        left: 0;
        color: #03e9f4;
        font-size: 12px;
    }

    .login-box a {
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        color: #03e9f4;
        font-size: 16px;
        text-decoration: none;
        text-transform: uppercase;
        overflow: hidden;
        transition: .5s;
        margin-top: 40px;
        letter-spacing: 4px;

    }

    .login-box a:hover {
        background: #03e9f4;
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 5px #03e9f4,
            0 0 25px #03e9f4,
            0 0 50px #03e9f4,
            0 0 100px #03e9f4;
    }

    .login-box a span {
        position: absolute;
        display: block;
    }

    .login-box a span:nth-child(1) {
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #03e9f4);
        animation: btn-anim1 1s linear infinite;
    }

    @keyframes btn-anim1 {
        0% {
            left: -100%;
        }

        50%,
        100% {
            left: 100%;
        }
    }

    .login-box a span:nth-child(2) {
        top: -100%;
        right: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, transparent, #03e9f4);
        animation: btn-anim2 1s linear infinite;
        animation-delay: .25s
    }

    @keyframes btn-anim2 {
        0% {
            top: -100%;
        }

        50%,
        100% {
            top: 100%;
        }
    }

    .login-box a span:nth-child(3) {
        bottom: 0;
        right: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(270deg, transparent, #03e9f4);
        animation: btn-anim3 1s linear infinite;
        animation-delay: .5s
    }

    @keyframes btn-anim3 {
        0% {
            right: -100%;
        }

        50%,
        100% {
            right: 100%;
        }
    }

    .login-box a span:nth-child(4) {
        bottom: -100%;
        left: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(360deg, transparent, #03e9f4);
        animation: btn-anim4 1s linear infinite;
        animation-delay: .75s
    }

    @keyframes btn-anim4 {
        0% {
            bottom: -100%;
        }

        50%,
        100% {
            bottom: 100%;
        }
    }


    /*button*/
    .button-82-pushable {
        position: relative;
        border: none;
        background: transparent;
        padding: 0;
        cursor: pointer;
        outline-offset: 4px;
        transition: filter 250ms;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-82-shadow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 12px;
        background: hsl(0deg 0% 0% / 0.25);
        will-change: transform;
        transform: translateY(2px);
        transition:
            transform 600ms cubic-bezier(.3, .7, .4, 1);
    }

    .button-82-edge {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 12px;
        background: linear-gradient(to left,
                hsl(340deg 100% 16%) 0%,
                hsl(340deg 100% 32%) 8%,
                hsl(340deg 100% 32%) 92%,
                hsl(340deg 100% 16%) 100%);
    }

    .button-82-front {
        display: block;
        position: relative;
        padding: 12px 12px;
        border-radius: 12px;

        color: white;
        background: hsl(345deg 100% 47%);
        will-change: transform;
        transform: translateY(-4px);
        transition:
            transform 600ms cubic-bezier(.3, .7, .4, 1);
    }

    @media (min-width: 768px) {
        .button-82-front {

            padding: 12px 12px;
        }
    }

    .button-82-pushable:hover {
        filter: brightness(110%);
        -webkit-filter: brightness(110%);
    }

    .button-82-pushable:hover .button-82-front {
        transform: translateY(-6px);
        transition:
            transform 250ms cubic-bezier(.3, .7, .4, 1.5);
    }

    .button-82-pushable:active .button-82-front {
        transform: translateY(-2px);
        transition: transform 34ms;
    }

    .button-82-pushable:hover .button-82-shadow {
        transform: translateY(4px);
        transition:
            transform 250ms cubic-bezier(.3, .7, .4, 1.5);
    }

    .button-82-pushable:active .button-82-shadow {
        transform: translateY(1px);
        transition: transform 34ms;
    }

    .button-82-pushable:focus:not(:focus-visible) {
        outline: none;
    }



    .txt_field {
        overflow-x: visible;
        position: relative;
        border-bottom: 2px solid #adadad;
        margin: 30px 0;
    }

    .txt_field input {
        width: 100%;
        padding: 0 5px;
        height: 40px;
        font-size: 16px;
        border: none;
        background: none;
        outline: none;
        color: white;
    }

    .txt_field label {
        position: absolute;
        top: 50%;
        left: 5px;
        color: #adadad;
        transform: translateY(-50%);
        font-size: 16px;
        pointer-events: none;
        transition: .5s;
    }

    .txt_field span::before {
        content: '';
        position: absolute;
        top: 40px;
        left: 0;
        width: 0%;
        height: 2px;
        background: #2691d9;
        transition: .5s;
    }

    .txt_field input:focus~label,
    .txt_field input:valid~label {
        top: -5px;
        color: #2691d9;
    }

    .txt_field input:focus~span::before,
    .txt_field input:valid~span::before {
        width: 100%;
    }

    .pass {
        margin: -5px 0 20px 5px;
        color: #a6a6a6;
        cursor: pointer;
    }

    .pass:hover {
        text-decoration: underline;
    }

    input[type="submit"] {
        width: 100%;
        height: 50px;
        border: 1px solid;
        background: #2691d9;
        border-radius: 25px;
        font-size: 18px;
        color: #e9f4fb;
        font-weight: 700;
        cursor: pointer;
        outline: none;
    }

    input[type="submit"]:hover {
        border-color: #2691d9;
        transition: .5s;

    }

    .signup_link {
        margin: 30px 0;
        text-align: center;
        font-size: 16px;
        color: #666666;
    }

    .signup_link a {
        color: #2691d9;
        text-decoration: none;
    }

    .signup_link a:hover {
        text-decoration: underline;
    }

    .lal {
        background-color: indigo;
        color: white;
        padding: 0.5rem;
        font-family: sans-serif;
        border-radius: 0.3rem;
        cursor: pointer;
        margin-top: 1rem;
    }

    .swal2-icon.swal2-success.swal2-icon-show {
        overflow-y: hidden !important;
    }
    </style>
</head>

<body>
    <div class="special-autocom">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="Home.php"><img src="assets\logo2.png" alt="" width="30" height="24"
                        class="d-inline-block align-text-top">EcoFit</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                        <div class="search-input">
                            <a href="" target="_blank" hidden></a>


                            <div class="row">
                                <div class="col-lg-10 col-11 p-0">
                                    <input id="searchID" type="text" placeholder="Search.." autocomplete="off">

                                </div>
                                <div id="cariID" class="col-lg-2 col-1">
                                    <div class="icon d-flex"
                                        style="align-items: center; justify-content: center; height: 55px;">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="autocom-box d-block d-lg-none">

                            </div>

                        </div>

                    </ul>
                    <ul class="navbar-nav d-flex">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="explore.php"><i class="fas fa-home"></i></a>
                        </li>
                        <?php if (!$_SESSION['role'] == '1') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="myprofile.php"><i class="fas fa-user-circle"></i></a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="chat.php"><i class="fas fa-comment"></i></a>
                        </li>

                        <?php if ($_SESSION['role'] == '2') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php"><i class="far fa-clipboard"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="myprofile.php"><i class="fas fa-user-circle"></i></a>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == '0') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="customerOrders.php"><i class="far fa-clipboard"></i></a>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == '1') { ?>
                        <li class="nav-item">
                            <a style="color: #4A4A4B; text-decoration: none;"
                                class="btn btn-primary text-white mx-lg-1 mt-1 mt-lg-0" href="admin.php">Admin</a>
                        </li>
                        <?php } ?>

                        <li class="nav-item">
                            <button id="logout" class="btn bg-danger text-white mx-lg-1 mt-1 mt-lg-0">Logout</button>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
        <div class="autocom-box2 d-lg-block d-none text-center">

        </div>
    </div>




    <div class="row main" align="center">
        <div class="col-12">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-md-3 col-12">
                    <img class="profileimg" src="<?php echo $profileImg?>" alt="">
                </div>
                <div class="col-md-5 col-12  text-md-start text-center">
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <b>
                                <p class="main_heading"><?php echo $nama?></p>
                            </b>
                            <p class="main_heading"><?php echo $profile?></p>
                            <p class="main_heading"><i><?php echo $bio?></i></p>
                        </div>
                        <?php
                    if ($role == 0){
                        // echo 
                        // '<div class="col-3">
                        // <button id="follow" type="button" class="btn btn-dark">Follow</button>
                        // </div>';
                    }
                    ?>

                    </div>
                    <div class="col-2"></div>
                    <div class="row">
                        <?php 
                            if ($roleOther == 2) {
                        
                            echo "<div class='col-12 col-md-12 '>
                            <br>
                            <p class='main_heading'>Completed Order : " .$countpost."</p>
                        <br>
                    </div>";
                    }
                    ?>

                        <?php 
                            if ($roleOther == 2) {
                                echo "<br><p id='req' data-bs-toggle='modal' data-bs-target='#modalReq' 
                                style='cursor:pointer; text-decoration:underline;' class=''>Request Order</p>";
                            }
                            ?>


                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php
                             $sql = "SELECT * FROM user_data WHERE email='$profile'";
                             $result = mysqli_query($con, $sql);
                             if ($result->num_rows > 0) {
                                 $row = mysqli_fetch_assoc($result);
                                 $nama = $row['name'];
                                 $id = $row['id'];
                                 $profileImg = $row['profileImg'];
                                 $bio = $row['bio'];
                             } else{
                                 /*header('Location: home.php');*/
                                 
                             }
                             echo "<div onclick='createRoom(".$id.")' style='cursor: pointer;' class='border text-center'>

                             <i class='fas fa-comment-dots'></i>
                             chat
                         </div>"
                             ?>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-12">
            <div class="row" style="justify-content: center;" id="tampilan">
                <?php

                    $email = $_SESSION['email'];
                    $post = "SELECT text_post.id as idPost, total_like,text_content, image, date(date_uploaded) as date_only, name FROM text_post JOIN user_data  ON user_data.id = text_post.id_user WHERE username= '$profile' ORDER BY date_uploaded DESC ";

                    $code = '';
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


                        } else if ($result['image'] == '' && $result['text_content'] != '') {
                            $code .="
                            <div class='col-12'>
                            <div class='post_content'>
                            <p class='content' id='content-".$result['idPost']."' align='left'>".$result['text_content']."</p>
                            </div>
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


                        }



                        $idPost = $result['idPost'];

                        $sqludahlike = "SELECT * FROM `like_post` WHERE id_user = '$iduser' && id_post = '$idPost'";

                        $resultudahlike = mysqli_query($con, $sqludahlike);






                        $continue .= "
                        <div style='width: 400px; height:auto; cursor: pointer; margin-top:10px; margin-right:5px; ' id='card-".$result['idPost']."' class='card'>
                        <div class='row' align='center'>

                        <div style=''>
                        <img style='width: 35px;float:left' class='post_img' src='".$row['profileImg']."' alt=''>
                        <p class='main_heading' align='left'>&nbsp&nbsp&nbsp&nbsp".$result['name']."</p>

                        </div>
                        </div>


                        <div class='row' align='center'>

                        ".$code;


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




            </div>
        </div>


    </div>



    <div class="modal fade" id="modalReq" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style=" background: rgba(0,0,0,.7); backdrop-filter: blur(20px); 
          box-shadow: 0 15px 25px rgba(0,0,0,.6);
          border-radius: 10px; padding: 10px; ">

                <div class="modal-body" style="">


                    <div class="container login-box">

                        <button type="button" style="float:right;" id="closeRe" class="btn-close btn-close-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        <h2>Request Order</h2>



                        <div class="txt_field">
                            <input id="namaIn" type="text" required>
                            <span></span>
                            <label>Nama</label>
                        </div>
                        <div class="txt_field">
                            <input id="alamat" type="text" required>
                            <span></span>
                            <label>Alamat</label>
                        </div>
                        <div class="txt_field">
                            <input id="jenis" type="text" required>
                            <span></span>
                            <label>Jenis Pakaian</label>
                        </div>
                        <div class="image input" id="imageinput">
                            <img class="outputimg" align="center" id="outputImage">
                        </div>
                        <div>
                            <input type="file" onchange="previewImg(this);" id="uploadimg" name="uploadimg"
                                style="display:none;">
                            <span></span>
                            <label for="uploadimg" class="lal">Input Before Picture</label>
                        </div>

                        <div class="image input" id="imageinput">
                            <img class="outputimg" align="center" id="outputImage2">
                        </div>
                        <div>






                            <div>
                                <input type="file" onchange="previewImg2(this);" id="uploadimg2" name="uploadimg2"
                                    style="display:none;">
                                <span></span>
                                <label for="uploadimg2" class="lal">Input After Picture</label>
                            </div>



                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <button id="request" style="width: 100%; height:100%; overflow-y: hidden;"
                                        class="button-82-pushable" role="button">
                                        <span class="button-82-shadow"></span>
                                        <span class="button-82-edge"></span>
                                        <span class="button-82-front text">
                                            Order
                                        </span>
                                    </button>
                                </div>
                                <div class="col-4"></div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdrop3Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="notifbody" class="modal-body">



                    </div>


                </div>
            </div>
        </div>




        <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdrop4Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Following</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="bodyfollowing" class="modal-body">

                    </div>


                </div>
            </div>
        </div>


        <!-- <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop4Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
         
    <div class="modal-content">
         <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Following</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="bodyfollower" class="modal-body">
      
    </div>

 
</div>
</div>
</div> -->


</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
var position;


$("#logout").click(function() {
    //swal logout
    swal.fire({
        title: 'Are you sure?',
        text: "You want to logout?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, logout!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "logout.php",
                type: "POST",
                data: {
                    logout: 1
                },
                success: function(data) {
                    window.location.href = "home.php";
                }
            });
        }
    })


});

function previewImgDelete(input) {

    $("#outputImage").hide();

}

function previewImg(input) {
    $("#outputImage").show();
    var file = $("#uploadimg").get(0).files[0];
    if (file) {
        var reader = new FileReader();

        reader.onload = function() {
            $("#outputImage").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}



function previewImgDelete2(input) {

    $("#outputImage2").hide();

}

function previewImg2(input) {
    $("#outputImage2").show();
    var file = $("#uploadimg2").get(0).files[0];
    if (file) {
        var reader = new FileReader();

        reader.onload = function() {
            $("#outputImage2").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}

$(document).ready(function() {
    var follow = <?php echo $follow ?>;

    if (follow == 1) {
        $('#follow').css('background-color', 'pink');
        $('#follow').html('Follow <i class="fas fa-check"></i>');

    }


});


$(document).on("click", "#follow", function() {

    var id = <?php echo $id ?>;

    $.ajax({
        url: "../api/follow.php",
        type: "POST",
        cache: false,
        data: {
            id,
            id
        },
        success: function(dataResult) {
            dataResult = dataResult.split("-");
            if (dataResult[0] == "1") {
                $('#bykfollower').html(dataResult[1] + " followers");
                $('#bykfollowing').html(dataResult[2] + " following");
                $('#follow').css('background-color', 'black');
                $('#follow').html('Follow');

            } else if (dataResult[0] == "2") {
                $('#bykfollower').html(dataResult[1] + " followers");
                $('#bykfollowing').html(dataResult[2] + " following");
                $('#follow').css('background-color', 'pink');
                $('#follow').html('Follow <i class="fas fa-check"></i>');
            }
        },
    });

});


$(document).on("click", "#notifliat", function() {

    var id = <?php echo $iduser ?>;
    var code = 0;

    $.ajax({
        url: "ajax/lihatnotif.php",
        type: "POST",
        cache: false,
        data: {
            id,
            id
        },
        success: function(dataResult) {
            $('#notifbody').html(dataResult);
            $('#staticBackdrop3').modal('show');

        },
    });

});


$(document).on("click", "#bykfollowing", function() {

    var id = <?php echo $id ?>;
    var code = 0;

    $.ajax({
        url: "../api/cekfollow.php",
        type: "POST",
        cache: false,
        data: {
            id,
            id,
            code: code
        },
        success: function(dataResult) {
            $('#bodyfollowing').html(dataResult);
            $('#staticBackdrop4').modal('show');

        },
    });

});



$(document).on("click", "#bykfollower", function() {

    var id = <?php echo $id ?>;
    var code = 1;

    $.ajax({
        url: "../api/cekfollow.php",
        type: "POST",
        cache: false,
        data: {
            id,
            id,
            code: code
        },
        success: function(dataResult) {
            $('#bodyfollowing').html(dataResult);
            $('#staticBackdrop4').modal('show');

        },
    });

});

$("#request").on("click", function() {
    var formData = new FormData();
    var name = $('#namaIn').val();
    var alamat = $('#alamat').val();
    var jenis = $('#jenis').val();
    var image = $('#uploadimg').prop('files')[0];
    var image2 = $('#uploadimg2').prop('files')[0];
    var ok = "";
    formData.append("file", image);
    formData.append("file2", image2);
    formData.append("name", name);
    formData.append("alamat", alamat);
    formData.append("jenis", jenis);

    $.ajax({
        url: "ajax/request.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            // alert('success')

            if (data == "failed") {
                swal.fire({
                    title: "Error",
                    text: "Error",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            } else if (data == "success") {
                swal.fire({
                    title: "Success",
                    text: "Success",
                    icon: "success",
                    confirmButtonText: "OK"
                })
                $('#namaIn').val('');
                $('#alamat').val('');
                $('#jenis').val('');
                $("#closeRe").click();

                previewImgDelete();
                previewImgDelete2();
            }
        }
    });




    /*    location.reload();*/



});





const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const suggBox2 = document.querySelector(".autocom-box2");
const icon = searchWrapper.querySelector(".icon");
let linkTag = searchWrapper.querySelector("a");
let webLink;













let suggestions = <?php echo json_encode($arr); ?>;





inputBox.onkeyup = (e) => {
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if (userData) {
        icon.onclick = () => {

            var email = $('#searchID').val();

            $.ajax({
                url: "ajax/findprofile.php",
                type: "POST",
                cache: false,
                data: {
                    email: email
                },
                success: function(dataResult) {

                },
            });
            location.replace("profile.php");
        }
        emptyArray = suggestions.filter((data) => {
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });
        emptyArray = emptyArray.map((data) => {
            // passing return data inside li tag
            return data = `<li>${data}</li>`;
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        suggBox2.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
        }
        let allList2 = suggBox2.querySelectorAll("li");
        for (let i = 0; i < allList2.length; i++) {
            //adding onclick attribute in all li tag
            allList2[i].setAttribute("onclick", "select(this)");
        }
    } else {
        searchWrapper.classList.remove("active"); //hide autocomplete box
        suggBox2.classList.remove("active"); //hide autocomplete box
    }
}

function select(element) {
    let selectData = element.textContent;
    inputBox.value = selectData;
    icon.onclick = () => {

        var email = $('#searchID').val();

        $.ajax({
            url: "ajax/findprofile.php",
            type: "POST",
            cache: false,
            data: {
                email: email
            },
            success: function(dataResult) {


            },
        });
        location.replace("profile.php");
    }
    searchWrapper.classList.remove("active");
    suggBox2.classList.remove("active");

}

function createRoom(id_user) {
    $.ajax({
        url: 'api/createRoom.php',
        type: 'POST',
        data: {
            id_user2: id_user
        },
        success: function(data) {
            window.location.href = "chat.php?id_room=" + data;
        }
    });
}

function showSuggestions(list) {
    let listData;
    if (!list.length) {
        userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;
    } else {
        listData = list.join('');
    }
    suggBox.innerHTML = listData;
    suggBox2.innerHTML = listData;
}



$(document).on("click", "#cariID", function() {

    var email = $('#searchID').val();

    $.ajax({
        url: "ajax/findprofile.php",
        type: "POST",
        cache: false,
        data: {
            email: email
        },
        success: function(dataResult) {

        },
    });
    location.replace("profile.php");
});

$(document).on("click", ".maulike", function() {
    idnya = $(this).attr('id');
    num = idnya.split("-");
    id = num[1];


    $.ajax({
        url: "ajax/like.php",
        type: "POST",
        cache: false,
        data: {
            id,
            id
        },
        success: function(dataResult) {
            dataResult = dataResult.split("-");

            if (dataResult[0] == "1") {
                $('#' + idnya).removeClass('fa-solid fa-bookmark').addClass(
                    'fa-regular fa-bookmark');
                $('#likenih-' + id).html(' ' + dataResult[1] + ' Saved');

            } else if (dataResult[0] == "2") {
                $('#' + idnya).removeClass('fa-regular fa-bookmark').addClass(
                    'fa-solid fa-bookmark');
                $('#likenih-' + id).html(' ' + dataResult[1] + ' Saved');
            }
        },
    });
});
</script>