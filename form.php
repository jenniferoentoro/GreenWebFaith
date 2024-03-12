<?php
    include_once "addForm.php";
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM user_data WHERE email='$email'";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);
$profileImg = $row['profileImg'];
$bio = $row['bio'];
$email = $row['email'];
$role = $row['role'];
$id = $row['id'];



$sql2 = "SELECT * FROM designer WHERE idUser='$id'";
$result2 = mysqli_query($con, $sql2);

$row2 = mysqli_fetch_assoc($result2);
$hp = $row2['phoneNumber'];
$address = $row2['designerAddress'];
$bank = $row2['bankName'];
$rekening = $row2['bankAccount'];

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Preview and Upload PHP</title>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="main.css">
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <link rel="icon" href="assets\logo.png" sizes="20">
    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-2 col-0"></div>
            <div class="col-12 col-sm-8 col-lg-4 form-div">
                <a style="text-decoration: none;" href="myprofile.php"><i class="fas fa-chevron-left"></i>Back</a>
                <form action="form.php" method="post" enctype="multipart/form-data">
                    <h2 class="text-center mb-3 mt-3">Update profile</h2>
                    <?php if (!empty($msg)): ?>
                    <div class="alert <?php echo $msg_class ?>" role="alert">
                        <?php echo $msg; ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-group text-center" style="position: relative;">
                        <span class="img-div">
                            <div class="text-center img-placeholder" onClick="triggerClick()">
                                <h4>Update image</h4>
                            </div>
                            <img src="<?php echo $profileImg ?>" onClick="triggerClick()" id="profileDisplay">
                        </span>
                        <input type="file" name="profileImage" accept="image/png, image/gif, image/jpeg"
                            onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                        <label>Profile Image</label>
                    </div>
                    <div class="form-group">
                        <label>Bio</label>
                        <textarea id="isibio" name="bio" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="save_profile" class="btn btn-primary btn-block">Save User</button>
                    </div>
                    <button type="button" id="btnpost" data-bs-toggle="modal" data-bs-target="#myModal" name="upgrade"
                        class="btn btn-primary mt-3">Be A Designer</button>
                    <button type="button" id="btnpre" data-bs-toggle="modal" data-bs-target="#myModal2"
                        class="btn btn-primary mt-3">Edit Data</button>

                </form>
            </div>
            <div class="col-lg-4 col-sm-2 col-0"></div>
        </div>
    </div>


    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upgrade Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <textarea id="telpon" name="nohp" class="form-control" placeholder="Phone Numbe..."></textarea>
                        <label>Address</label>
                        <textarea id="address" name="alamat" class="form-control" placeholder="Address..."></textarea>
                        <label>Bank Name</label>
                        <textarea id="bankname" name="namabank" class="form-control"
                            placeholder="Bank Name..."></textarea>
                        <label>Bank Account</label>
                        <textarea id="bankacc" name="rekening" class="form-control"
                            placeholder="Bank Account..."></textarea>
                        <div class="form-group mt-3">
                            <button type="submit" id="req_dsgn" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <textarea id="telpon2" name="nohp" class="form-control"></textarea>
                        <label>Address</label>
                        <textarea id="address2" name="alamat" class="form-control"></textarea>
                        <label>Bank Name</label>
                        <textarea id="bankname2" name="namabank" class="form-control"></textarea>
                        <label>Bank Account</label>
                        <textarea id="bankacc2" name="rekening" class="form-control"></textarea>
                        <div class="form-group mt-3">
                            <button type="submit" id="update" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</body>

</html>

<script>
var a = '<?php echo $hp ?>';
var b = '<?php echo $address ?>';
var c = '<?php echo $bank ?>';
var d = '<?php echo $rekening ?>';
$(document).ready(function() {
    var bio = '<?php echo $bio ?>';

    $("#isibio").val(bio);

    $("#telpon2").val(a);
    $("#address2").val(b);
    $("#bankname2").val(c);
    $("#bankacc2").val(d);


});


var role = <?php echo $role ?>


window.onload = function() {
    if (role == 2) {
        document.getElementById('btnpre').style.display = "block";
        document.getElementById('btnpost').style.display = "none";
    } else if (role == 0) {
        document.getElementById('btnpre').style.display = "none";
        document.getElementById('btnpost').style.display = "block";
    } else {
        x.style.display = "none";
        y.style.display = "none";
    }
}

$('#update').on('click', function() {
    var email = '<?php echo $email; ?>';
    var nohp = $('#telpon2').val();
    var alamat = $('#address2').val();
    var namabank = $('#bankname2').val();
    var rekening = $('#bankacc2').val();
    $.ajax({
        url: "getUpdate.php",
        type: "POST",
        cache: false,
        data: {
            email: email,
            nohp: nohp,
            alamat: alamat,
            namabank: namabank,
            rekening: rekening
        },
        success: function(dataResult) {
            if (dataResult == 1) {
                Swal.fire({
                    title: 'Success',
                    text: 'Data Telah Berhasil Diupdate!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
                $('#myModal').modal('hide');
            } else {
                Swal.fire({
                    title: 'Fail',
                    text: 'Data Gagal Diupdate!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        },
    })
});

$('#req_dsgn').on('click', function() {
    var email = '<?php echo $email; ?>';
    var nohp = $('#telpon').val();
    var alamat = $('#address').val();
    var namabank = $('#bankname').val();
    var rekening = $('#bankacc').val();
    $.ajax({
        url: "getUpgrade.php",
        type: "POST",
        cache: false,
        data: {
            email: email,
            nohp: nohp,
            alamat: alamat,
            namabank: namabank,
            rekening: rekening
        },
        success: function(dataResult) {
            if (dataResult == 1) {
                Swal.fire({
                    title: 'Success',
                    text: 'Data Telah Berhasil Diupdate!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
                $('#myModal').modal('hide');
            } else {
                Swal.fire({
                    title: 'Fail',
                    text: 'Data Gagal Diupdate!',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        },
    })
});


function triggerClick(e) {
    document.querySelector('#profileImage').click();
}

function displayImage(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}
</script>