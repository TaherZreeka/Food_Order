<?php declare(strict_types=1);include("partails-front/menu.php"); ?>
<?php 
                if(isset($_GET['food_id'])){
                    //get the food id and details of select form    
                    $food_id = $_GET['food_id'];

                    //get selected food
                    $sql="SELECT * FROM tbl_food WHERE id=$food_id";
                    //Executequery($sql);
                    $res=mysqli_query($conn,$sql);
                    //check whether the query execute
                    $count=mysqli_num_rows($res);

                    //check whether the query execute
                          if($count==1){
                            //we have date
                            $row=mysqli_fetch_assoc($res);
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];

                           
                          }else{
                            //we have not date
                            //redirect to the food home page
                        header("Location:".SITEURL);
                          }
                    }else{
                        //redirect to the food home page
                        header("Location:".SITEURL);
                    }
            
            ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="https://formspree.io/f/mzzbdbrq" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                        if($image_name==""){
                            //no image found
                            echo "<div class='error'>Image not found.</div>";
                        }else{
                            ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
                        class="img-responsive img-curve">
                    <?php
                        }
                    
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo$title;?>">
                    <p class="food-price"><?php echo"$".$price; ?></p>
                    <input type="hidden" name="price" value="<?php echo$price;?>">
                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Taher Zreek" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. Tahrzx@rd.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
        <?php 
if (isset($_POST['submit'])) {
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $order_date = date('Y-m-d H:i:s');
    $status = "ordered";
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

    // Save order in the database
    $sql2 = "INSERT INTO tbl_order (
                food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address
             ) VALUES (
                '$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address'
             )"; 

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['order'] = "<div class='success txt-center'>Food order successfully .</div>";
        header("Location:" . SITEURL);
    } else {
        $_SESSION['order'] = "<div class='error txt-center'>Failed to order food.</div>";
        header("Location:" . SITEURL . "order.php");
    }
}
?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include("partails-front/footer.php"); ?>
