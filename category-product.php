<?php include('partials-front/menu.php'); ?>

<?php 
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else
    {
        header('location:'.SITEURL);
    }
?>


<section class="product-search text-center">
    <div class="container">
        <div class="text-box">
             <h3>Products in "<a href="#"><?php echo $category_title; ?>"</a></h3>
        </div>

    </div>
</section>

<section class="product-menu">
    <div class="container">
        <h2 class="text-center">Products</h2>

        <?php 
        
            $sql2 = "SELECT * FROM tbl_product WHERE category_id=$category_id";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    
                    <div class="product-menu-box">
                        <div class="product-menu-img">
                            <?php 
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="product-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="product-price">$<?php echo $price; ?></p>
                            <p class="product-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Products are not Available.</div>";
            }
        
        ?>

        

        <div class="clearfix"></div>

        

    </div>

</section>

<?php include('partials-front/footer.php'); ?>