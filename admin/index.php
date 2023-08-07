<?php
session_start();
require_once('../include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

if(isset($_SESSION['admin_id'])){
   echo "<script>
window.location.href = 'Dashboard';
</script>";
}

if(isset($_POST['login'])){
    $email = $db_handle->checkValue($_POST['email']);
    $password = $db_handle->checkValue($_POST['password']);

    $login = $db_handle->runQuery("SELECT * FROM `admin` WHERE admin_email = '$email' and admin_pass = '$password'");
    $login_number = $db_handle->numRows("SELECT * FROM `admin` WHERE admin_email = '$email' and admin_pass = '$password'");

    if($login_number == 1){
        $admin_id = $login[0]['id'];
        $_SESSION['admin_id'] = $admin_id;
        echo "<script>
document.cookie = 'alert = 1;';
window.location.href = 'Dashboard';
</script>";
    } else{
        echo "<script>
document.cookie = 'alert = 5;';
window.location.href = 'Login';
</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Play Eat Easy - Admin Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/toastr/css/toastr.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


</head>

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <h1>Play Eat Easy</h1>
                                </div>
                                <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Email</strong></label>
                                        <input type="email" class="form-control" placeholder="hello@example.com" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Password</strong></label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-white text-primary btn-block" name="login">Sign Me In
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="vendor/jQuery/jquery-3.6.4.min.js"></script>
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendor/toastr/js/toastr.min.js"></script>
<script src="vendor/toastr/js/toastr.init.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>

</body>

</html>