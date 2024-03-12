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


$sql2 = "SELECT username,email FROM user_data";
$result2 = mysqli_query($con, $sql2);

$arr = [];
while ($res= mysqli_fetch_assoc($result2)){
    $temp = $res['username'];
    // $temp2 = $res['email'];
    array_push($arr,$temp);
    // array_push($arr,$temp2);
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


    .topDes:hover {
        transform: scale(1.05);
        cursor: pointer;
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

    <div class="row">
        <div class="col-12">
            <br> <br><br>
            <h3 style="text-align:center">Top Designer</h3>
        </div>


    </div>

    <div class="col-12">

        <div class="row justify-content-md-center" align="center" id="topdesign">
            <p>Masih Tidak ada</p>

            <!-- <div class="col-md-3 col-4">
                    <img class="profileimg" src="<?php echo $profileImg?>" alt="">
                    <p>Yuhuu</p>
                </div>
                <div class="col-md-3 col-4">
                    <img class="profileimg" src="<?php echo $profileImg?>" alt="">
                    <p>Yuhuu</p>
                </div>
                <div class="col-md-3 col-4">
                    <img class="profileimg" src="<?php echo $profileImg?>" alt="">
                    <p>Yuhuu</p>
                </div> -->

        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <h3 style="text-align:center">Explore</h3>
        </div>


    </div>

    <div class="row">
        <div class="col-12">
            <div class="row" style="justify-content: center;" id="tampilan">

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

<script>
var position;



$(document).ready(function() {
    showExplore();
    topdesigner();


});

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

$(document).on("click", "#seeContent", function() {
    $("#staticBackdrop").modal("show");
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
                showExplore();
                previewImgDelete();
            }
        }
    });



    /*    location.reload();*/


});


function showExplore() {

    $.ajax({
        url: "ajax/showpost.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#tampilan").html(dataResult);
        },
    });

}

function viewProfile(email) {
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


function topdesigner() {

    $.ajax({
        url: "ajax/topdesigner.php",
        type: "POST",
        cache: false,
        data: {

        },
        success: function(dataResult) {
            $("#topdesign").html(dataResult);
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