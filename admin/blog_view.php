<?php
session_start();
require_once('../include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

if (!isset($_SESSION['admin_id'])) {
    echo "<script>
window.location.href = 'Login';
</script>";
} else {
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
            <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $fetch_blog_data = $db_handle->runQuery("select * from blog where id = '$id'");
            ?>
            <div class="form-head mb-4">
                <h2 class="text-black font-w600 mb-0">Add Blog</h2>
                <form action="Backend" method="post" class="mt-3" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $id;?>" name="id">
                    <div class="form-group">
                        <label>Blog Title</label>
                        <input type="text" class="form-control input-default" name="blog_title" value="<?php echo $fetch_blog_data[0]['title'];?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Blog Description</label>
                        <textarea class="form-control" rows="4" id="comment" spellcheck="true" name="blog_desc"
                                  required><?php echo $fetch_blog_data[0]['description'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Blog Status</label>
                        <select class="form-control default-select form-control-lg" tabindex="-98" name="status">
                            <option <?php if($fetch_blog_data[0]['status'] == '1') echo "selected";?> value="1">Active</option>
                            <option <?php if($fetch_blog_data[0]['status'] == '0') echo "selected";?> value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>Blog Image</label>
                                <input type="file" class="form-control input-default" name="blog_file" accept="image/*">
                            </div>
                            <div class="col-6">
                                <img src="<?php echo $fetch_blog_data[0]['image'];?>" style="width: 150px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update_blog" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <?php
            }
            else{
            ?>
            <div class="form-head mb-4">
                <h2 class="text-black font-w600 mb-0">View Blog</h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Blog Title</th>
                                <th>Blog Description</th>
                                <th>Blog Status</th>
                                <th>Blog Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $fetch_blog = $db_handle->runQuery("select * from blog order by id desc");
                            $no_fetch_blog = $db_handle->numRows("select * from blog order by id desc");
                            for ($i = 0; $i < $no_fetch_blog; $i++) {
                                ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $fetch_blog[$i]['title']; ?></td>
                                    <td><?php echo $fetch_blog[$i]['description']; ?></td>
                                    <td><?php if ($fetch_blog[$i]['status'] == '1') {
                                            echo 'Active';
                                        } else echo 'Inactive'; ?></td>
                                    <td><a href="<?php echo $fetch_blog[$i]['image']; ?>" target="_blank">Image</a></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="Blog-View?id=<?php echo $fetch_blog[$i]['id']; ?>"
                                               class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                            <a onclick="blogDelete(<?php echo $fetch_blog[$i]['id']; ?>)"
                                               class="btn btn-danger shadow btn-xs sharp"><i
                                                        class="fa fa-trash"></i></a>
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
            <?php
            }
            ?>
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
    function blogDelete(id) {
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
                        blogId: id
                    },
                    success: function (data) {
                        if (data.toString() === 'P') {
                            Swal.fire(
                                'Not Deleted!',
                                'Your have store in this category.',
                                'error'
                            ).then((result) => {
                                window.location = 'Blog-View';
                            });
                        } else {
                            Swal.fire(
                                'Deleted!',
                                'Your blog has been deleted.',
                                'success'
                            ).then((result) => {
                                window.location = 'Blog-View';
                            });
                        }
                    }
                });
            } else {
                Swal.fire(
                    'Cancelled!',
                    'Your Blog is safe :)',
                    'error'
                ).then((result) => {
                    window.location = 'Blog-View';
                });
            }
        })
    }
</script>

<script>
    CKEDITOR.replace('blog_desc');
</script>
</body>

</html>