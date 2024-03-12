<?php 

include 'connection.php';

error_reporting(0);

session_start();

$email = $_SESSION['email'];

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM user_data WHERE email='$email'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['username'];
        $id = $row['id'];
        $profileImg = $row['profileImg'];
        $bio = $row['bio'];
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
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
    $temp = $res['username'];
    array_push($arr,$temp);
}

$sql3 = "SELECT id FROM text_post WHERE id_user='$id'";
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










?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="icon" href="assets\logo.png" sizes="20">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        /* overflow-x: auto; */
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

    img.notifFollow {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.432);
    }

    img.post_imagemodal {
        width: 30px;
        height: 30px;
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



    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }

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

    .category {
        overflow: hidden;
        white-space: nowrap;
    }

    body {
        background-color: #fff8f1;
        opacity: 1;
        background-image: radial-gradient(#094b65 0.75px, #fff8f1 0.75px);
        background-size: 15px 15px;
    }


    @media screen and (max-width: 580px) {}
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


    <div class="container">
        <div class="row" style="">

            <div class="col-12" align="center">
                <br> <br>
                <div class="tab">
                    <button class="tablinks" onclick="openCategory(event, 'Requested Orders')"
                        id="defaultOpen">Requested
                        Orders</button>
                    <button class="tablinks" onclick="openCategory(event, 'Accept Orders')">Accept Orders</button>
                    <button class="tablinks" onclick="openCategory(event, 'Ongoing Orders')">Ongoing Orders</button>
                    <button class="tablinks" onclick="openCategory(event, 'Completed Orders')">Completed Orders</button>
                    <button class="tablinks" onclick="openCategory(event, 'Cancel Orders')">Cancel Orders</button>
                    <button class="tablinks" onclick="openCategory(event, 'Rejected Orders')">Rejected Orders</button>
                </div>

                <div id="Requested Orders" class="tabcontent">

                    <div class="container text-center mb-5">
                        <br>
                        <h3>Requested Orders</h3>
                        <div class="table_wrapper mt-5" style="overflow-x:auto;">
                            <table class="text-center" id="tableReq">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Order</th>
                                        <th>username</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                        <th>Jenis Baju</th>
                                        <th>Before Clothes</th>
                                        <th>After Clothes</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="daftarReq">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="Accept Orders" class="tabcontent">
                    <div class="container text-center mb-5">
                        <br>
                        <h3>Accepted Orders</h3>
                        <div class="table_wrapper mt-5" style="overflow-x: auto;">
                            <table class="text-center" id="tableAcc">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Order</th>
                                        <th>username</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                        <th>Jenis Baju</th>
                                        <th>Work Day</th>
                                        <th>Cost</th>
                                        <th>Before Clothes</th>
                                        <th>After Clothes</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="daftarAcc">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="Ongoing Orders" class="tabcontent">
                    <div class="container text-center mb-5">
                        <br>
                        <h3>Ongoing Orders</h3>
                        <div class="table_wrapper mt-5" style="overflow-x: auto;">
                            <table class="text-center" id="tableOngo">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Order</th>
                                        <th>username</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                        <th>Jenis Baju</th>
                                        <th>Work Day</th>
                                        <th>Cost</th>
                                        <th>Before Clothes</th>
                                        <th>After Clothes</th>
                                        <th>No resi Customer</th>
                                        <th>No resi Designer</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody id="daftarOngo">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="Completed Orders" class="tabcontent">
                    <div class="container text-center mb-5">
                        <br>
                        <h3>Completed Orders</h3>
                        <div class="table_wrapper mt-5" style="overflow-x: auto;">
                            <table class="text-center" id="tableComp">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Order</th>
                                        <th>username</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                        <th>Jenis Baju</th>
                                        <th>Work Day</th>
                                        <th>Cost</th>
                                        <th>Before Clothes</th>
                                        <th>After Clothes</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody id="daftarCom">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="Cancel Orders" class="tabcontent">
                    <div class="container text-center mb-5">
                        <br>
                        <h3>Completed Orders</h3>
                        <div class="table_wrapper mt-5" style="overflow-x: auto;">
                            <table class="text-center" id="tableCan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Order</th>
                                        <th>username</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                        <th>Jenis Baju</th>
                                        <th>Before Clothes</th>
                                        <th>After Clothes</th>

                                    </tr>
                                </thead>
                                <tbody id="daftarCan">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="Rejected Orders" class="tabcontent">
                    <div class="container text-center mb-5">
                        <br>
                        <h3>Rejected Orders</h3>
                        <div class="table_wrapper mt-5" style="overflow-x: auto;">
                            <table class="text-center" id="tableReject">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Order</th>
                                        <th>username</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                        <th>Jenis Baju</th>
                                        <th>Work Day</th>
                                        <th>Cost</th>
                                        <th>Before Clothes</th>
                                        <th>After Clothes</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody id="daftarRejected">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>







    <div class="modal fade" id="modalAfter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" style="float:right" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <img style="width: 100%; height:auto;" id="imgAf" src="" alt="">
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="modalBefore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" style="float:right" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <img style="width: 100%; height:auto;" id="imgBef" src="" alt="">
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="modalAccept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style=" background: rgba(0,0,0,.7); backdrop-filter: blur(20px); 
          box-shadow: 0 15px 25px rgba(0,0,0,.6);
          border-radius: 10px; padding: 10px; ">

                <div class="modal-body">
                    <div class="container login-box">

                        <button type="button" style="float:right;" id="closeAcc" class="btn-close btn-close-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        <h2 style="color:white; text-align:center;">Accept Order</h2>
                        <div class="txt_field">
                            <input id="lama" type="text" required>
                            <span></span>
                            <label>Long (days)</label>
                        </div>
                        <div class="txt_field">
                            <input id="biaya" type="text" required>
                            <span></span>
                            <label>Cost</label>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <button id="acc" style="width: 100%; height:100%; overflow-y: hidden;"
                                    class="button-82-pushable" role="button">
                                    <span class="button-82-shadow"></span>
                                    <span class="button-82-edge"></span>
                                    <span class="button-82-front text">
                                        Accept
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

    <div class="modal fade" id="modalResi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style=" background: rgba(0,0,0,.7); backdrop-filter: blur(20px); 
          box-shadow: 0 15px 25px rgba(0,0,0,.6);
          border-radius: 10px; padding: 10px; ">

                <div class="modal-body">
                    <div class="container login-box">

                        <button type="button" style="float:right;" id="closeResi" class="btn-close btn-close-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        <h2 style="color:white; text-align:center;">Send Package</h2>
                        <div class="txt_field">
                            <input id="resi" type="text" required>
                            <span></span>
                            <label>Input Resi</label>
                        </div>


                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <button id="send" style="width: 100%; height:100%; overflow-y: hidden;"
                                    class="button-82-pushable" role="button">
                                    <span class="button-82-shadow"></span>
                                    <span class="button-82-edge"></span>
                                    <span class="button-82-front text">
                                        Send
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


</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>

<!-- AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Data Table -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


<script>
var position;

function openCategory(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();



$(document).ready(function() {
    reset();








    reqTable();
    comTable();
    rejTable();
    accTable();
    ongoTable();
    canTable();


});


function ongoTable() {
    $.ajax({
        url: "ajax/getTableOnGoDesigner.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#daftarOngo").html(dataResult);
            $('#tableOngo').DataTable({
                "ordering": false
            });
        },
    });
}

function canTable() {
    $.ajax({
        url: "ajax/getTableCanDesigner.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#daftarCan").html(dataResult);
            $('#tableCan').DataTable({
                "ordering": false
            });
        },
    });
}

function reqTable() {
    $.ajax({
        url: "ajax/getTable.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#daftarReq").html(dataResult);
            $('#tableReq').DataTable({
                "ordering": false,

            });
        },
    });
}

function accTable() {
    $.ajax({
        url: "ajax/getTableAcc.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#daftarAcc").html(dataResult);
            $('#tableAcc').DataTable({
                "ordering": false
            });
        },
    });
}

function comTable() {
    $.ajax({
        url: "ajax/getTableCompleted.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#daftarCom").html(dataResult);
            $('#tableComp').DataTable({
                "ordering": false
            });
        },
    });
}

function rejTable() {
    $.ajax({
        url: "ajax/getTableRejected.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#daftarRejected").html(dataResult);
            $('#tableReject').DataTable({
                "ordering": false
            });
        },
    });
}

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

$(document).on("click", ".befores", function() {

    id = $(this).attr('id');
    $("#imgBef").attr("src", id);
    $("#modalBefore").modal("show");
});

$(document).on("click", ".after", function() {

    id = $(this).attr('id');
    $("#imgAf").attr("src", id);
    $("#modalAfter").modal("show");
});
var id;
$(document).on("click", ".accdong", function() {
    id = $(this).parent().parent().attr('id');

});

$(document).on("click", ".noresiInput", function() {
    id = $(this).parent().parent().attr('id');

});

$("#send").on("click", function() {
    var formData = new FormData();
    var resi = $('#resi').val();
    formData.append("resi", resi);
    formData.append("id", id);


    $.ajax({
        url: "ajax/resiInputDes.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {

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

                $('#resi').val('');

                $("#closeResi").click();
                ongoTable();



            }
        }
    });
});

$(document).on("click", "#acc", function() {

    var lama = $('#lama').val();
    var biaya = $('#biaya').val();


    $.ajax({
        url: "ajax/accOrder.php",
        type: "POST",
        cache: false,
        data: {
            lama: lama,
            biaya: biaya,
            id: id
        },
        success: function(dataResult) {
            if (dataResult == "failed") {
                swal.fire({
                    title: "Error",
                    text: "Error",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            } else if (dataResult == "success") {
                swal.fire({
                    title: "Success",
                    text: "Success",
                    icon: "success",
                    confirmButtonText: "OK"
                })
                $('#lama').val('');
                $('#biaya').val('');
                $("#closeAcc").click();
                $("#action" + id).html('Accepted');
                reqTable();
                accTable();
            }
        },
    });
});

$(document).on("click", ".reject", function() {
    id = $(this).parent().parent().attr('id');
    Swal.fire({
        title: 'Are you sure want to reject it?',
        showCancelButton: true,
        confirmButtonText: 'Save'
    }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/rejectOrder.php",
                type: "POST",
                cache: false,
                data: {
                    id: id
                },
                success: function(dataResult) {
                    if (dataResult == "failed") {
                        swal.fire({
                            title: "Error",
                            text: "Error",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    } else if (dataResult == "success") {
                        swal.fire({
                            title: "Success",
                            text: "Success",
                            icon: "success",
                            confirmButtonText: "OK"
                        })
                        // $('#lama').val('');
                        // $('#biaya').val('');
                        // $("#closeAcc").click();
                        // $("#action" + id).html('Accepted');
                        reqTable();
                        rejTable();
                        canTable();
                    }
                },
            });



        }
    })
});

$(document).on("click", ".here", function() {

    id = $(this).parent().parent().attr('id');
    Swal.fire({
        title: 'Are you sure?',
        showCancelButton: true,
        confirmButtonText: 'Save'
    }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/doIt.php",
                type: "POST",
                cache: false,
                data: {
                    id: id
                },
                success: function(dataResult) {
                    if (dataResult == "failed") {
                        swal.fire({
                            title: "Error",
                            text: "Error",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    } else if (dataResult == "success") {
                        swal.fire({
                            title: "Success",
                            text: "Success",
                            icon: "success",
                            confirmButtonText: "OK"
                        })

                        ongoTable();
                    }
                },
            });



        }
    })
});

$(document).on("click", ".doneProcess", function() {
    id = $(this).parent().parent().attr('id');
    Swal.fire({
        title: 'Are you sure?',
        showCancelButton: true,
        confirmButtonText: 'Save'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "ajax/doneprocess.php",
                type: "POST",
                cache: false,
                data: {
                    id: id
                },
                success: function(dataResult) {
                    if (dataResult == "failed") {
                        swal.fire({
                            title: "Error",
                            text: "Error",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    } else if (dataResult == "success") {
                        swal.fire({
                            title: "Success",
                            text: "Success",
                            icon: "success",
                            confirmButtonText: "OK"
                        })
                        ongoTable();
                    }
                },
            });



        }
    })
});

$("#savetext").on("click", function() {
    var formData = new FormData();
    var posting = $('#inputPost').val();
    var image = $('#uploadimg').prop('files')[0];
    var ok = "";
    formData.append("file", image);
    formData.append("text", posting);

    $.ajax({
        url: "ajax/create.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {

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
                $('#inputPost').val('');
                $('#uploadimg').val('');
                $("#closee").click();
                reset();
                previewImgDelete();
            }
        }
    });



    /*    location.reload();*/


});


function reset() {

    $.ajax({
        url: "ajax/resetpost.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#tampilan").html(dataResult);
        },
    });

}


function previewImgDelete(input) {

    $("#outputImage").hide();

}

function previewImg(input) {
    $("#outputImage").show();
    var file = $("input[type=file]").get(0).files[0];
    if (file) {
        var reader = new FileReader();

        reader.onload = function() {
            $("#outputImage").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}

$("#closee").click(function() {
    $("#outputImage").remove();
    $("#imageinput").after("<img class='outputimg' align='center' id='outputImage'>");
    $("#outputImage").val("");
    $('#exampleFormControlInput2').val('');
});

/*$(".image_content").click(function(){
  alert("The paragraph was clicked.");
});*/





$(document).on("click", ".trash", function() {
    idnya = $(this).attr('id');
    num = idnya.split("-");
    id = num[1];
    Swal.fire({
        title: 'Are you sure want to delete this portofolio?',
        showCancelButton: true,
        confirmButtonText: 'Yes'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/delete.php",
                type: "POST",
                cache: false,
                data: {
                    id: id
                },
                success: function(dataResult) {

                    if (dataResult == 1) {
                        swal.fire({
                            title: "Error",
                            text: "Error",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    } else if (dataResult == "success") {
                        swal.fire({
                            title: "Success",
                            text: "Success",
                            icon: "success",
                            confirmButtonText: "OK"
                        })

                        reset();
                    }
                },
            });

        }
    })


});

temp = 0;

$(document).on("click", ".editan", function() {
    idnya = $(this).attr('id');
    num = idnya.split("-");
    id = num[1];

    lala = $("#content-" + num[1]).html();

    $('#inputPostUpdate').html($("#content-" + num[1]).html());
    temp = id;

});



$(document).on("click", "#saveUpdate", function() {
    id = temp;
    var post_update = $('#inputPostUpdate').val();

    $.ajax({
        url: "ajax/update.php",
        type: "POST",
        cache: false,
        data: {
            updated_post: post_update,
            id: id
        },
        success: function(dataResult) {
            if (dataResult == "success") {
                reset();
                $("#closeedit").click();
            } else {}
        },
    });
});



$(document).on("click", "#notifliat", function() {

    var id = <?php echo $id ?>;
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
        url: "ajax/cekfollow.php",
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
        url: "ajax/cekfollow.php",
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
                $('#' + idnya).css('color', 'black');
                $('#likenih-' + id).html(' ' + dataResult[1] + ' Likes');

            } else if (dataResult[0] == "2") {
                $('#' + idnya).css('color', 'red');
                $('#likenih-' + id).html(' ' + dataResult[1] + ' Likes');
            }
        },
    });
});
</script>