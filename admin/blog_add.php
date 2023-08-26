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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Play Eat Easy</title>
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
                <h2 class="text-black font-w600 mb-0">Add Blog</h2>
                <form action="Backend" method="post" class="mt-3" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Blog Title</label>
                        <input type="text" class="form-control input-default" name="blog_title" placeholder="Blog Title" required>
                    </div>
                    <div class="form-group">
                        <label>Blog Category</label>
                        <select class="form-control" name="blog_cat" required>
                            <option>Please Select Category</option>
                            <?php
                            $fetch_cat = $db_handle->runQuery("select * from category order by id desc");
                            $fetch_cat_no = $db_handle->numRows("select * from category order by id desc");
                            for ($i = 0; $i < $fetch_cat_no; $i++){
                                ?>
                                <option value="<?php echo $fetch_cat [$i]['id'];?>"><?php echo $fetch_cat [$i]['category_name_cn'];?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Blog Description</label>
                        <textarea class="form-control" rows="4" id="comment" spellcheck="true" name="blog_desc" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Blog Image</label>
                        <input type="file" class="form-control input-default" name="blog_file" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="add_blog" class="btn btn-primary">Add</button>
                    </div>
                </form>
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

<script>
    CKEDITOR.replace('blog_desc');
</script>
</body>

</html>