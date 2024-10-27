<?php declare(strict_types=1); include("partails/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
        <br><br>
        <!-- add category from start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title:</td>
                    <td><input placeholder="create category" name="title" type="text"></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input name="featured" type="radio" value="Yes">Yes
                        <input name="featured" type="radio" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input name="active" type="radio" value="Yes">Yes
                        <input name="active" type="radio" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" class="btn-secondary" value="Add Category">
                    </td>
                </tr>
            </table>
        </form>

        <!-- add category from end -->
    </div>
</div>


<?php 
            //check whether the button is checked or not

            if(isset($_POST['submit'])){
                // echo "checked";

                //get the value form Form
                $title=$_POST['title'];
              if(isset($_POST['featured'])){
                $featured=$_POST['featured'];
              }else{
                $featured="No";
              }


              if(isset($_POST['active'])){
                $active=$_POST['active'];
              }else{
                $active="No";
              }
              // images is selected 
              //print_r($_FILES['image']);
              //die();
              if(isset($_FILES['image']['name'])){
                 //  upload image
                 $image_name=$_FILES['image']['name'];

                 if($image_name!=""){

                 
                 // auto rename image
                 //get extension of our image(png,jpg,etc)
                 $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                 //rename the image
                 $image_name="Food_category_".rand(000,999).'.'.$ext;//e.g.Food_category_867.jpg

                 
                 $source_path=$_FILES['image']['tmp_name'];
                 $destination="../images/category/".$image_name;

                 $upload=move_uploaded_file($source_path,$destination);

                 if($upload==false){
                    //set message
                    $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                    //redirect to add category page
                    header('Location:'.SITEURL.'admin/add-category.php');
                    //Stop process
                    die();
                 }
                }
              }else{
                // Dont upload image
                $image_name ="";
              }
              // create sql query to insert category into category_table database

              $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
              ";

              //Execute the query and save in database

              $res=mysqli_query($conn,$sql);

              //check whether the query succeeded or not data add or no

              if($res==true){
                //query Execute and category add
                $_SESSION['add']="<div class='success'> Catergory Add Successfully.</div>";
                //redirect to manage admin page
               header("Location:".SITEURL."admin/manage-category.php");
              }else{
                //Failed add category
                $_SESSION['add']="<div class='success'>  Failed  to Add Catergory .</div>";
                //redirect to manage admin page
                header('location'.SITEURL.'admin/add-category.php');
              }
            }
        
        ?>
<?php include("partails/footer.php"); ?>