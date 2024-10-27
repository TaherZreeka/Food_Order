<?php declare(strict_types=1);include("partails-front/menu.php"); ?>
<!DOCTYPE html>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
       
        <h2>Foods on Your Search <a href="#" class="text-white">YmYm</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php 
                    //get the search keyword
                   if(isset($_POST['search'])) 
                 {   
                    //get the search keyword                    
                    $search=$_POST['search'];
                    //sql query to get the search keyword
                    $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                    //Execute the query
                    $res=mysqli_query($conn,$sql);
                    //count rows
                    $count=mysqli_num_rows($res);
                    //check whether the query execute
                    if($count>0){
                        //food available
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $description=$row['description'];
                            $image_name=$row['image_name'];
                            ?>
                            <div class="food-m-box">
                                <div class="food-menu-img">
                                    <?php 
                                        if($image_name==""){
                                            //image_name not available
                                            echo "<div class='error'>Image Not Available</div>";
                                        }else{
                                            //image_name available
                                            ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    
                                    
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo"$".$price; ?></p>
                                    <p class="food-detail">
                                    <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
        <?php
                        }
                    }else{
                        //food not available
                        echo "<div class='error'>No food found with the keyword '$search'</div>";
                    }}
                           ?>

        <div class="clearfix"></div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partails-front/footer.php");?>