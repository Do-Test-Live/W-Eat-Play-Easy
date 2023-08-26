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

/*insert category*/
if (isset($_POST['add_category'])) {
    $category = $db_handle->checkValue($_POST['category']);
    $inserted_at = date("Y-m-d H:i:s");
    $insert_category = $db_handle->insertQuery("INSERT INTO `category`(`category_name_cn`, `inserted_at`) VALUES ('$category','$inserted_at')");
    if ($insert_category) {
        echo "<script>
document.cookie = 'alert = 3;';
window.location.href = 'Category-Add';
</script>";
    }
}

/*update category*/
if (isset($_POST['update_category'])) {
    $category = $db_handle->checkValue($_POST['category']);
    $category_id = $db_handle->checkValue($_POST['category_id']);
    $updated_at = date("Y-m-d H:i:s");

    $update_category = $db_handle->insertQuery("update category set category_name_cn = '$category', updated_at = '$updated_at' where id = '$category_id'");

    if ($update_category) {
        echo "<script>
document.cookie = 'alert = 3;';
window.location.href = 'Category-View';
</script>";
    }
}

/*delete category*/
if (isset($_GET['catId'])) {
    $db_handle->insertQuery("delete from category where id=" . $_GET['catId'] . "");
    echo 'success';

}

/*blog add*/
if (isset($_POST['add_blog'])) {
    $blog_title = $db_handle->checkValue($_POST['blog_title']);
    $blog_desc = $db_handle->checkValue($_POST['blog_desc']);
    $blog_cat = $db_handle->checkValue($_POST['blog_cat']);
    $image = '';
    $inserted_at = date("Y-m-d H:i:s");
    if (!empty($_FILES['blog_file']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['blog_file']['name'];
        $file_size = $_FILES['blog_file']['size'];
        $file_tmp = $_FILES['blog_file']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        move_uploaded_file($file_tmp, "assets/blog/" . $file_name);
        $image = "assets/blog/" . $file_name;
    }

    $insert_blog = $db_handle->insertQuery("INSERT INTO `blog`(`category_id`, `title`, `description`, `image`, `inserted_at`) VALUES ('$blog_cat','$blog_title','$blog_desc','$image','$inserted_at')");
    if ($insert_blog) {
        echo "<script>
document.cookie = 'alert = 3;';
window.location.href = 'Blog-Add';
</script>";
    }
}

/*update blog*/
if (isset($_POST['update_blog'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $blog_title = $db_handle->checkValue($_POST['blog_title']);
    $blog_desc = $db_handle->checkValue($_POST['blog_desc']);
    $status = $db_handle->checkValue($_POST['status']);
    $image = '';
    $query = '';
    $updated_at = date("Y-m-d H:i:s");

    if (!empty($_FILES['blog_file']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['blog_file']['name'];
        $file_size = $_FILES['blog_file']['size'];
        $file_tmp = $_FILES['blog_file']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $data = $db_handle->runQuery("select * FROM `blog` WHERE id='{$id}'");
        unlink($data[0]['course_image']);
        move_uploaded_file($file_tmp, "assets/blog/" . $file_name);
        $image = "assets/blog/" . $file_name;
        $query .= ",`image`='" . $image . "'";
    }

    $update_blog = $db_handle->insertQuery("UPDATE `blog` SET `title`='$blog_title',`description`='$blog_desc',`status`='$status',`updated_at`='$updated_at'" . $query ." WHERE `id` = '{$id}'");
    if($update_blog){
        echo "<script>
document.cookie = 'alert = 3;';
window.location.href = 'Blog-View';
</script>";
    }
}

/*delete blog*/
if (isset($_GET['blogId'])) {
    $data = $db_handle->runQuery("select * FROM `blog` WHERE id = " . $_GET['blogId'] . "");
    unlink($data[0]['image']);
    $db_handle->insertQuery("delete from blog where id = " . $_GET['blogId'] . "");
    echo 'success';
}