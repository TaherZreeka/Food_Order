<?php declare(strict_types=1); 
include("partails/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
        <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['no-category-found'])){
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
                if(isset($_SESSION['update-category'])){
                    echo $_SESSION['update-category'];
                    unset($_SESSION['update-category']);
                }
                
            
            ?>
        <br>
        <!-- button add to admin -->
        <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>image_name</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php 
                    //query get all Category from database
                    $sql = "SELECT * FROM tbl_category ";
                    //Execute query
                    $res=mysqli_query($conn,$sql);

                    $count=mysqli_num_rows($res);

                    $sn=1;
                    //check whether we have data in database or no

                    if($count>0){   
                        //we have data in database
                        //get the data and display
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];

                            ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td>
                    <?php
                            //ckeck whether the images is available or not

                            if($image_name!==""){
                                //display  images
                               ?>

                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="100px">
                    <?php 
                            }else{
                                //display the message and
                                echo "<div class='error'>Image Not Added</div>";
                            }
                          ?>
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>"class="btn-danger">Delete Category</a>
                </td>
            </tr>
            <?php
                        }   
                    }else{
                        //we do not have data in database
                        //we will display the error message inside table

                        ?>
            <tr>
                <td colspan="6">
                    <div class='error'>No category added</div>
                </td>
            </tr>
            <?php
                    }

                
                ?>




        </table>
    </div>
</div>

<?php include("partails/footer.php");?>