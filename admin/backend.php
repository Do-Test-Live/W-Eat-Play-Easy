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

/*insert category*/
if(isset($_POST['add_category'])){
    $category = $db_handle->checkValue($_POST['category']);
    $inserted_at = date("Y-m-d H:i:s");
    $insert_category = $db_handle->insertQuery("INSERT INTO `category`(`category_name_cn`, `inserted_at`) VALUES ('$category','$inserted_at')");
    if($insert_category){
        echo "<script>
document.cookie = 'alert = 3;';
window.location.href = 'Category-Add';
</script>";
    }
}

/*update category*/
if(isset($_POST['update_category'])){
    $category = $db_handle->checkValue($_POST['category']);
    $category_id = $db_handle->checkValue($_POST['category_id']);
    $updated_at = date("Y-m-d H:i:s");

    $update_category = $db_handle->insertQuery("update category set category_name_cn = '$category', updated_at = '$updated_at' where id = '$category_id'");

    if($update_category){
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