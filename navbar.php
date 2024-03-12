	<style>
input:-webkit-autofill,
input:-webkit-autofill:focus {
    transition: background-color 0s 2147483647s, color 0s 2147483647s;
}

input[data-autocompleted] {
    background-color: transparent !important;
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
	</style>

	<nav class="navbar navbar-expand-lg navbar-light">
	    <div class="container-fluid">

	        <a class="navbar-brand" href="#"><img src="assets/logo2.png" style="width:64px; height: 64px;">EcoFit</a>

	        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
	            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarSupportedContent">
	            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
	                <li class="nav-item">
	                    <a class="nav-link" href="home.php">Home</a>
	                </li>
	                <li class="nav-item">
	                    <a class="nav-link" href="tutorialDIY.php">Tutorial</a>
	                </li>
	                <li class="nav-item">
	                    <a class="nav-link" href="donate.php">Donate</a>
	                </li>
	                <?php
          if (isset($_SESSION['id_user'])) {
            echo "<li class='nav-item'>
            <a id='logout' class='nav-link bg-danger text-white'>Logout</a>
            </li>";
          } else {
            echo "<li class='nav-item'>
            <a class='nav-link' data-bs-toggle='modal' data-bs-target='#logInModal'>Login | Register</a>
          </li>";
          }
          
          ?>



	            </ul>

	        </div>
	    </div>
	</nav>
	<!-- login modal -->
	<div class="modal fade" id="logInModal" tabindex="-1" aria-labelledby="logInModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content" style=" background: rgba(0,0,0,.7); backdrop-filter: blur(20px); 
      box-shadow: 0 15px 25px rgba(0,0,0,.6);
      border-radius: 10px; padding: 10px; ">

	            <div class="modal-body" style="">


	                <div class="container login-box">

	                    <button type="button" style="float:right;" class="btn-close btn-close-white"
	                        data-bs-dismiss="modal" aria-label="Close"></button>
	                    <h2>Login</h2>



	                    <div class="user-box">
	                        <input required="" type="text" id="email">
	                        <label>Email</label>
	                    </div>
	                    <div class="user-box">
	                        <input required="" type="password" id="password">
	                        <label>Password</label>
	                    </div>

	                    <div class="row">
	                        <p id="turnSignUp" style="color: white; text-decoration: underline; cursor: pointer;">Dont have
	                            an account?</p>
	                    </div>
	                    <div class="row">
	                        <div class="col-4"></div>
	                        <div class="col-4">
	                            <button id="login" style="width: 100%;" class="button-82-pushable" role="button">
	                                <span class="button-82-shadow"></span>
	                                <span class="button-82-edge"></span>
	                                <span class="button-82-front text">
	                                    Login
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


	<!-- create account modal -->
	<div class="modal fade" id="createAccModal" tabindex="-1" aria-labelledby="logInModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content" style=" background: rgba(0,0,0,.7); backdrop-filter: blur(20px); 
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px; padding: 10px; ">

	            <div class="modal-body" style="">


	                <div class="container login-box">

	                    <button type="button" style="float:right;" class="btn-close btn-close-white"
	                        data-bs-dismiss="modal" aria-label="Close"></button>
	                    <h2>Create Account</h2>

	                    <div class="user-box">
	                        <input type="text" id="name" required="">
	                        <label>Name</label>
	                    </div>
	                    <div class="user-box">
	                        <input type="text" id="username" required="">
	                        <label>Username</label>
	                    </div>
	                    <div class="user-box">
	                        <input type="text" id="emailC" required="">
	                        <label>Email</label>
	                    </div>
	                    <div class="user-box">
	                        <input type="password" id="passwordC" required="">
	                        <label>Password</label>
	                    </div>
	                    <div class="user-box">
	                        <input type="password" id="conPass" required="">
	                        <label>Confirm Password</label>
	                    </div>
	                    <div class="user-box" style="width:70%;">
	                        <input type="text" id="ver" required="">
	                        <label>Verification Code</label>
	                    </div>
	                    <button style=" float:  right ;" class="btn btn-primary" id="req">Request</button>
	                    <div class="row">
	                        <p id="turnLogin" style="color: white; text-decoration: underline; cursor: pointer;">Have an
	                            account?</p>
	                    </div>
	                    <div class="row">
	                        <div class="col-4"></div>
	                        <div class="col-4">
	                            <button style="width: 100%;" class="button-82-pushable" role="button" id="create">
	                                <span class="button-82-shadow"></span>
	                                <span class="button-82-edge"></span>
	                                <span class="button-82-front text">
	                                    Create
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

	<script type="text/javascript">
$("#turnSignUp").click(function() {
    $("#logInModal").modal('hide');
    $("#createAccModal").modal('show');
});

$(".btn-close").click(function() {
    $(".modal-backdrop.show").removeClass("show");

});
$("#turnLogin").click(function() {
    $("#createAccModal").modal('hide');
    $("#logInModal").modal('show');

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

$("#login").click(function() {
    var email = $("#email").val();
    var password = $("#password").val();
    if (email == "" || password == "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Silahkan lengkapi data terlebih dahulu!'
        });

    } else {
        $.ajax({
            url: "login.php",
            method: "POST",
            data: {
                email: email,
                password: password
            },
            success: function(result) {

                if (result == 7) {
                    window.location.href = "admin.php";
                }
                if (result == 0) {
                    window.location.href = "myprofile.php";
                } else if (result == 3) {
                    Swal.fire({
                        title: 'Login Failed !',
                        text: 'Password salah!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 4) {
                    Swal.fire({
                        title: 'Login Failed !',
                        text: 'Account tidak ditemukan!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 5) {
                    Swal.fire({
                        title: 'Login Failed !',
                        text: 'Session anda expired',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else {}
            },
        });

    }
});

$("#req").click(function() {
    $("#req").attr("disabled", true);
    var email = $("#emailC").val();
    var name = $("#name").val();
    var password = $("#passwordC").val();
    var username = $("#username").val();
    $.ajax({
        url: "activation.php",
        method: "POST",
        data: {
            email: email,
            name: name,
            password: password,
            username: username
        },
        success: function(data) {
            $("#req").attr("disabled", false);
            let parsed = JSON.parse(data);
            if (parsed.status == 400 || parsed.status == 500 || parsed.status == 469) {
                swal.fire({
                    title: "Error",
                    text: parsed.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            } else if (parsed.status == 200) {
                swal.fire({
                    title: "Success",
                    text: parsed.message,
                    icon: "success",
                    confirmButtonText: "OK"
                })
            } else {}
        }
    });
});



$('#create').on('click', function() {
    var name = $('#name').val();
    var username = $('#username').val();
    var conPass = $('#conPass').val();
    var email = $('#emailC').val();
    var password = $('#passwordC').val();
    var special_code = $('#ver').val();
    if (conPass != password) {
        Swal.fire({
            title: 'Register Failed !',
            text: 'Password tidak match!',
            icon: 'error',
            confirmButtonText: 'Ok'
        })

    } else if (typeof(email) != "undefined" && email != null && email != "" && typeof(password) !=
        "undefined" && password != null && password != "" && typeof(name) != "undefined" &&
        name != null && name != "") {
        $.ajax({
            url: "add_user.php",
            method: "POST",
            data: {
                name: name,
                email: email,
                password: password,
                username: username,
                special_code: special_code
            },
            success: function(result) {
                if (result == 200) {
                    Swal.fire({
                        title: 'Register success !',
                        text: 'Silahkan login!',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    $('#nameReg').val('');
                    $('#emailReg').val('');
                    $('#pwReg').val('');
                    $('#special_code').val('');
                    location.reload();
                } else if (result == 0) {
                    Swal.fire({
                        title: 'Register Failed !',
                        text: 'Silahkan register ulang!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 2) {
                    Swal.fire({
                        title: 'Register Failed !',
                        text: 'Email harus mengandung titik (.) dan (add) @',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 4) {
                    Swal.fire({
                        title: 'Register Failed !',
                        text: 'Email sudah terdaftar!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 7) {
                    Swal.fire({
                        title: 'Register Failed !',
                        text: 'Please fill all fields!hkhi',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 8) {
                    Swal.fire({
                        title: 'Register Failed !',
                        text: 'Your Special Code is incorrect!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 6) {
                    Swal.fire({
                        title: 'Register Failed !',
                        text: 'Please request a Special Code!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 9) {
                    Swal.fire({
                        title: 'Register Failed !',
                        text: 'Your Special Code has expired! Please request a new one!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else if (result == 14) {
                    Swal.fire({
                        title: 'Register Failed !',
                        text: 'Username not available!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else {}

            },
        });

    } else {
        Swal.fire({
            title: 'Register Failed !',
            text: 'Data belum lengkap!',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    }
});
	</script>