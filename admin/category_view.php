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
            <div class="row">
                <?php
                if(isset($_GET['id'])){
                    $cat_id = $_GET['id'];
                    $category_fetch = $db_handle->runQuery("select * from category where id = '$cat_id'");
                    ?>
                    <div class="col-xl-12 col-lg-12">
                        <div class="form-head mb-4">
                            <h2 class="text-black font-w600 mb-0">Edit Category</h2>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="Backend" method="post">
                                        <input type="hidden" name="category_id" value="<?php echo $cat_id;?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-default" name="category" placeholder="Category Name" value="<?php echo $category_fetch[0]['category_name_cn'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="update_category" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-12">
                        <div class="form-head mb-4">
                            <h2 class="text-black font-w600 mb-0">View Category</h2>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Category List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $fetch_cat = $db_handle->runQuery("select * from category order by id desc");
                                        $no_fetch_cat = $db_handle->numRows("select * from category order by id desc");
                                        for($i=0; $i<$no_fetch_cat; $i++){
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                <td><?php echo $fetch_cat[$i]['category_name_cn'];?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="Category-View?id=<?php echo $fetch_cat[$i]['id'];?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                        <a onclick="categoryDelete(<?php echo $fetch_cat[$i]['id'];?>)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
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
    function categoryDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'get',
                    url: 'Backend',
                    data: {
                        catId: id
                    },
                    success: function (data) {
                        if (data.toString() === 'P') {
                            Swal.fire(
                                'Not Deleted!',
                                'Your have store in this category.',
                                'error'
                            ).then((result) => {
                                window.location = 'Category-View';
                            });
                        } else {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result) => {
                                window.location = 'Category-View';
                            });
                        }
                    }
                });
            } else {
                Swal.fire(
                    'Cancelled!',
                    'Your Category is safe :)',
                    'error'
                ).then((result) => {
                    window.location = 'Category-View';
                });
            }
        })
    }
</script>
<script src="vendor/jQuery/jquery-3.6.4.min.js"></script>
</body>

</html>