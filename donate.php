<?php include "connection.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faith - Home</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

    <!-- Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Rancho&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    /* background-color: #094b65; */
    background-image: url("assets/bg.png");
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    /*display: flex;*/
}

.containers {
    width: 1150px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}

.containers .cards {
    position: relative;
    padding: 10px;
    width: 300px;

    margin: 20px;

    overflow: hidden;
    transition: 0.5s;
    text-align: center;

    background: rgba(255, 255, 255, 0);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);

}

.containers .cards img {
    transition: 0.5s;
}

.containers .cards h1 {
    font-size: 2rem;
    color: #094b65;
}

.containers .cards .content {
    padding: 20px;
    text-align: center;
}

.containers .cards .content p {
    color: #094b65;
    transition: 0.5s;
}

.containers .cards .content button {
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    background-color: #000;
    color: #fff;
    border-radius: 40px;
    text-decoration: none;
    transition: 0.5s;
    outline: none;
    margin-top: 20px;
}

.containers .cards:hover {
    background-color: #094b65;
    color: white;
    margin-top: -30px;
    box-shadow: 2px 20px 25px #094b65;
    border-color: #094b65;
}

.containers .cards:hover img {
    filter: invert(1);
}

.containers .cards:hover .content p {
    color: white;
}

.containers .cards:hover h1 {
    color: white;
}

.containers .cards:hover .content button {
    color: black;
    background-color: white;
}


nav {
    z-index: 550;
}

.effect {
    text-shadow: 0px 0px 15px #70a99d, 0px 0px 17px #70a99d;
    font-family: 'Rancho', cursive;
    text-align: center;
    color: white;
    font-size: 100px;
}



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

/*Scroll*/
section::-webkit-scrollbar {
    width: 10px;
}

section::-webkit-scrollbar-track {
    background-color: #eee;
}

section::-webkit-scrollbar-thumb {
    background-color: brown;
    border-radius: 0;
}

section::-webkit-scrollbar-thumb:hover {
    background-color: black;
}

section::-webkit-scrollbar-corner {
    background-color: palevioletred;
}

::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background-color: #f6f6f6;
    box-shadow: 0 0 10px #ddd inset;
}

::-webkit-scrollbar-thumb {
    background-color: #094b65;
    border-radius: 20px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #578495;
}

#flexi {
    display: flex;
    justify-content: center;
    justify-items: center;
}
</style>

<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="effect">Donation</h1>
            </div>
        </div>



    </div>

    <div id="flexi">



        <div class="containers">
            <div class="cards">
                <div class="img">
                    <img class="rounded-circle" src="assets/donation/rb.jpg" width="150" height="150">
                </div>
                <br>
                <h1>Rumah Bersinar</h1>
                <div class="content">
                    <p id="pRM">
                        Ruko RMI L-6, Jl. Bratang Binangun. RT 02/RW 08, kelurahan Baratajaya, Kecamatan Gubeng.
                        Surabaya
                    </p>
                    <button onclick="copyClipboard('pRM')">Copy Address</button>
                </div>
            </div>
            <div class="cards">
                <div class="img">
                    <img class="rounded-circle" src="assets/donation/rb.jpg" width="150" height="150">
                </div>
                <h1>Rumah Bersinar</h1>
                <div class="content">
                    <p id="pRM2">
                        Ruko RMI L-6, Jl. Bratang Binangun. RT 02/RW 08, kelurahan Baratajaya, Kecamatan Gubeng.
                        Surabaya
                    </p>
                    <button onclick="copyClipboard('pRM2')">Copy Address</button>
                </div>
            </div>
            <div class="cards">
                <div class="img">
                    <img class="rounded-circle" src="assets/donation/rb.jpg" width="150" height="150">
                </div>
                <h1>Rumah Bersinar</h1>
                <div class="content">
                    <p id="pRM3">
                        Ruko RMI L-6, Jl. Bratang Binangun. RT 02/RW 08, kelurahan Baratajaya, Kecamatan Gubeng.
                        Surabaya
                    </p>
                    <button onclick="copyClipboard('pRM3')">Copy Address</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; 
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
    /*		function copyClipboard(add){


      var copyText = add;
alert(add);
  
  copyText.select();
  copyText.setSelectionRange(0, 99999); 


  navigator.clipboard.writeText(copyText.value);

 
  alert("Copied the text: " + copyText.value);
    }*/

    function copyClipboard(element) {
        element = document.getElementById(element);
        var range, selection, worked;

        if (document.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } else if (window.getSelection) {
            selection = window.getSelection();
            range = document.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
        }

        try {
            document.execCommand('copy');
            swal.fire({
                title: "Success",
                text: "Text copied",
                icon: "success",
                confirmButtonText: "OK"
            });
        } catch (err) {
            swal.fire({
                title: "Error",
                text: "unable to copy text",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    }
    </script>
</body>

</html>