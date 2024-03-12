<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- <script src="tutorial.js"></script> -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <!-- Custom CSS -->
    <link href="tutorialDIY.css" rel="stylesheet">
    <title>Tutorial DIY</title>
</head>
<style>
.effect {
    text-shadow: 0px 0px 15px #70a99d, 0px 0px 17px #70a99d;
    font-family: 'Rancho', cursive;
    text-align: center;
    color: white;
    font-size: 100px;
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
</style>

<body>
    <?php include('navbar.php'); ?>

    <!-- <img class="bg" src="assets/forest.jpg" alt=""> -->
    <section>
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-12">
                    <h1 class="effect">Tutorial</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 style="display: flex; justify-content: center; padding-top: 8%; color: #094b65 !important;"><b>Here Is A
                    Few DIY Tutorial To Follow!</b></h2>

        </div>
        <ul class="navigation">
            <li id="show" onclick="go('https://www.youtube.com/embed/dS3tvvx4LIg?autoplay=1&enablejsapi=1')"><a
                    href="#slider"><img class="img-fluid" src="http://img.youtube.com/vi/dS3tvvx4LIg/0.jpg" alt=""></a>
            </li>
            <li id="show" onclick="go('https://www.youtube.com/embed/qST-tWStGnk?autoplay=1&enablejsapi=1')"><a
                    href="#slider"><img class="img-fluid" src="http://img.youtube.com/vi/qST-tWStGnk/0.jpg" alt=""></a>
            </li>
            <li id="show" onclick="go('https://www.youtube.com/embed/D-MbEbhT3fM?autoplay=1&enablejsapi=1')"><a
                    href="#slider"><img class="img-fluid" src="http://img.youtube.com/vi/D-MbEbhT3fM/0.jpg" alt=""></a>
            </li>
        </ul>

        <div id="hide" style="display:none;">
            <div class="video-container d-flex justify-content-center align-items-center">
                <iframe id="slider" width="560" height="315"
                    src="https://www.youtube.com/embed/dS3tvvx4LIg?autoplay=1&enablejsapi=1"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>

    </section>




    <script>
    function go(loc) {
        document.getElementById('slider').src = loc;
        var x = document.getElementById("hide");
        if (x.style.display === "none") {
            x.style.display = "block";
        }
    }
    </script>

</body>

</html>