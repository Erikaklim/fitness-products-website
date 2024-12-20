<?php include("partials/menu.php");?>

<section class="content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <?php 
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res == true){
                $count = mysqli_num_rows($res);

                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }else{
                    $_SESSION['update'] = "<div class='error'>Admin Not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }else{
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>

</section>

<?php

        if(isset($_POST['submit'])){

            $id = $_POST['id'];
            $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);

            $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id = '$id'";
            
            $res = mysqli_query($conn, $sql);
            if($res == true){
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            }else{
                $SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
            }

            header('Location:'.SITEURL.'admin/manage-admin.php');
        }

?>

<?php include("partials/footer.php");?>