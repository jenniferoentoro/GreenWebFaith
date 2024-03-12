<?php include "connection.php";
if (isset($_SESSION['id_user'])) {
    header('location: myprofile.php');
} 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faith - Home</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
        integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->



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
    overflow-x: hidden;
    /* background: #fff; */
    min-height: 100vh;
    background-color: #fff8f1 !important;
}

nav {
    z-index: 550;
}


.navbar-brand {
    color: #094b65 !important;
    font-weight: 700;
    font-size: 2em;
    text-decoration: none;
}

nav ul li a {
    text-decoration: none !important;
    padding: 6px 15px;
    color: #094b65 !important;
    border-radius: 20px;
    cursor: pointer;
}

nav ul li a:hover {
    background: #094b65;
    color: white !important;
}

#header ul {
    display: flex;
    justify-content: center;
    align-items: center;
}


section {
    position: relative;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

section img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    pointer-events: none;
}

section #text {
    position: absolute;
    color: #094b65;
    font-size: 10vw;
    text-align: center;
    line-height: 0.55em;
    font-family: 'Rancho', cursive;
    transform: translateY(-50%);
    z-index: 20;
}

section #text span {
    font-size: 0.20em;
    letter-spacing: 2px;
    font-weight: 400;
    font-family: 'Poppins', sans-serif;
}

#btn {
    text-decoration: none;
    display: inline-block;
    padding: 8px 30px;
    background: #094b65;
    color: white;
    font-size: 1.2em;
    font-weight: 500;
    letter-spacing: 2px;
    border-radius: 40px;
    transform: translateY(100px);
}

.sec {
    position: relative;
    padding: 20px;
    background-color: #094b65;
    background-image: url("assets/brick-wall.png");
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

.effect {
    text-shadow: 0px 0px 15px #70a99d, 0px 0px 17px #70a99d;
    font-family: 'Rancho', cursive;
    text-align: center;
    color: white;

}
</style>

<body>
    <?php include('navbar.php'); ?>
    <section>
        <h2 id="text"><span>Recycle Your<br></span>Old Clothes</h2>
        <img src="assets/bird1.png" id=bird1>
        <img src="assets/bird2.png" id=bird2>
        <img style="z-index: -40;" src="assets/forest.png" id=forest>
        <a href="#about" id="btn">About</a>
        <img style="z-index: 500;" src="assets/sew.png" id=rocks>
        <img src="assets/water.png" id=water>
    </section>
    <div class="sec" id="about">

        <h1 style="text-align: center; color: white;" class="effect">Why we have to renew our clothes?</h1>
        <div class="container mt-3">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <br>
                    <div>
                        <canvas id="myChart"
                            style="max-width:100%; height: 300px;background-color: #fff; padding: 10px;"></canvas>
                    </div>

                </div>
                <div class="col-12 col-lg-5">
                    <p style="color:white;" class="text-center"></p>
                    <p class="text-center align-middle" style="color:white;">The fashion industry, which is the second
                        most polluting industry in the world, is responsible for 10% of all greenhouse gas emissions,
                        with textile production alone is estimated to release 1.2 billion tonnes of greenhouse gases
                        into the atmosphere every year. </p>
                    <p class="text-center align-middle" style="color:white;">One of our solution's main objectives is to
                        reduce these emissions through reusing unwanted clothes by reforming them. Once this model gets
                        more attention, we are confident that people will keep on using it. Why? Firstly, they can save
                        money by reusing their unwanted clothes. Secondly, they are able to customize their clothes
                        based on their preferences. Lastly, they gain the satisfaction from knowing that they are doing
                        something good for the environment and supporting the fashion designers community.</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-8">
                    <p style="color:white;" class="text-center">
                    <p class="text-center align-middle" style="color:white;">
                        In the long run, people would be able to develop sustainable fashion habits, hence causing the
                        demand for new clothes to decrease. Eventually, clothing companies will decrease their
                        production as there is less demand for new clothes. With less clothes produced, there will be
                        less greenhouse gas emissions.
                    </p>
                    <p class="text-center align-middle" style="color:white;">
                        The possibility to realize our proposed idea is quite high as there is an increasing trend of
                        socially conscious consumers. In a survey of more than 10,000 consumers conducted by Shopkick,
                        more than two-thirds of shoppers said that the pandemic has made them more socially conscious
                        consumers. Hence, with the increase in the number of socially conscious people, we believe that
                        our solution which is aligned with their values, would be popular among them.
                    </p>
                    </p>
                </div>
                <div class="col-12 col-lg-4">
                    <img src="assets/recycle.png" alt="" style="max-width:100%; max-height:100%;">
                </div>
            </div>

        </div>
    </div>
    <?php include "footer.php"; 
    ?>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
    let text = document.getElementById('text');
    let bird1 = document.getElementById('bird1');
    let bird2 = document.getElementById('bird2');
    let btn = document.getElementById('btn');
    let rocks = document.getElementById('rocks');
    let forest = document.getElementById('forest');
    let water = document.getElementById('water');
    let header = document.getElementById('header');
    /*	text.style.top = 35+val*-0.5+'%';
			bird1.style.top = val*-1.5+'px';
			bird1.style.left = val*2+'px';
			bird2.style.top = val*-1.5+'px';
			bird2.style.left = val*-5+'px';
			btn.style.marginTop = val*1.5+'px';
			rocks.style.top = val*-0.06+'px';
			forest.style.top = val*0.25+'px';
			header.style.top = val*0.5+'px';*/
    window.addEventListener('scroll', function() {
        let val = window.scrollY;
        text.style.top = 35 + val * -0.3 + '%';
        /*	bird1.style.top = val*-1.5+'px';
        	bird1.style.left = val*1+'px';
        	bird2.style.top = val*-1.5+'px';
        	bird2.style.left = val*-1+'px';*/
        btn.style.marginTop = val * 1.5 + 'px';
        rocks.style.top = val * -0.06 + 'px';
        forest.style.top = val * 0.25 + 'px';
        header.style.top = val * 0.5 + 'px';
    });

    // 		google.charts.load('current', {'packages':['corechart']});
    // google.charts.setOnLoadCallback(drawChart);

    // function drawChart() {
    // var data = google.visualization.arrayToDataTable([
    //   ['Waste', 'Tons (%)'],
    //   ['Overall Waste',10],
    //   ['Food & Yard',20],
    //   ['Textiles',43],
    //   ['Rubber & Leather',15],
    //   ['Plastics',24],
    //   ['Metals',27]
    // ]);

    // var options = {
    //   title:'Change in Tons of Waste',
    //   backgroundColor: '#ffffff8a'

    // };

    // var chart = new google.visualization.BarChart(document.getElementById('myChart2'));
    //   chart.draw(data, options);
    // }

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                ['Overall Waste'],
                ['Food & Yard'],
                ['Textiles'],
                ['Rubber & Leather'],
                ['Plastics'],
                ['Metals']
            ],
            datasets: [{
                label: 'Tons (%)',
                data: [10, 20, 43, 15, 24, 27],
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        fill: "rgba(0,255,255,1)"
                    }
                },
                title: {
                    display: true,
                    text: 'Change in Tons of Waste'
                }
            },
            indexAxis: 'x',
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }

    });
    </script>
</body>

</html>