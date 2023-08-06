<?php
session_start();
require_once('../include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

if(!isset($_SESSION['admin_id'])){
    echo "<script>
window.location.href = 'Login';
</script>";
} else{
    $id = $_SESSION['admin_id'];
    $admin_data = $db_handle->runQuery("select * from admin where id = '$id'");
}
if(isset($_POST['update_password'])){
    $pass = $db_handle->checkValue($_POST['password']);
    $c_pass = $db_handle->checkValue($_POST['confirm_password']);
    if($pass == $c_pass){
        $update_pass = $db_handle->insertQuery("UPDATE `admin` SET `admin_pass`='$pass' WHERE id = '$id'");
        if($update_pass){
            echo "<script>
document.cookie = 'alert = 3;';
window.location.href = 'Dashboard';
</script>";
        }
    } else {
        echo "<script>
document.cookie = 'alert = 5;';
window.location.href = 'Admin-Profile';
</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Eat Play Easy - Profile</title>
    <!-- Favicon icon -->
    <?php include('includes/css.php'); ?>


</head>
<body>

<!--*******************
    Preloader start
********************-->
<?php include('includes/preloader.php'); ?>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <?php include('includes/navbar.php'); ?>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <?php include('includes/header.php'); ?>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <?php include('includes/sidebar.php'); ?>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="form-head mb-4">
                <h2 class="text-black font-w600 mb-0">Profile</h2>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <input type="password" class="form-control input-rounded" placeholder="new password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control input-rounded" placeholder="confirm new password" name="confirm_password">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="update_password" class="btn btn-primary">Update Password</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <!--**********************************
        Footer start
    ***********************************-->
    <?php include('includes/footer.php'); ?>
    <!--**********************************
        Footer end
    ***********************************-->

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<?php include('includes/js.php');?>


</body>

</html>