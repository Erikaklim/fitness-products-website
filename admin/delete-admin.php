<?php
    include('../config/constants.php');
    $id = $_GET["id"];

    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    $res = mysqli_query($conn, $sql);

    if($res == true){
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    }else{
        $_SESSION['error'] = "<div class='error'>Failed to Delete Admin</div>";
    }

    header('location:'.SITEURL.'admin/manage-admin.php');

?>