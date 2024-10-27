<?php declare(strict_types=1); // Make sure this is the very first line
ob_start(); // Start output buffering
include("partails/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); // Unset session variable
            }
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <br><br>
       
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Enter Food Title" required></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="10" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" placeholder="Enter Food Price" required></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id" required>
                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count > 0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
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
                        <input type="submit" name="submit" class="btn-secondary" value="Add Food">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php 
            if(isset($_POST['submit'])){
                // Get data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category_id']; // Ensure this variable is correctly spelled

                // Check whether radio button
                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                $active = isset($_POST['active']) ? $_POST['active'] : "No";

                // Upload the image if selected
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        // Auto rename image
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $image_name = "Food_Name" . rand(0000, 9999) . '.' . $ext; // e.g. Food_Name_867.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination = "../images/food/" . $image_name;

                        // Upload the image
                        $upload = move_uploaded_file($source_path, $destination);
                        if($upload == false){
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                            header('Location: ' . SITEURL . 'admin/add-food.php'); // Redirect
                            die();
                        }
                    }
                } else {
                    // Don't upload image
                    $image_name = "";
                }
            
                // Insert into database
                $sql2 = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active) 
                        VALUES ('$title', '$description', $price, '$image_name', '$category', '$featured', '$active')";
                
                // Execute the query
                $res2= mysqli_query($conn, $sql2);

                // Redirect with message
                if($res2==true){
                    //query Execute and category add
                    $_SESSION['add']="<div class='success'> Food Add Successfully.</div>";
                    //redirect to manage admin page
                   header("Location:".SITEURL."admin/manage-food.php");
                  }else{
                    //Failed add category
                    $_SESSION['add']="<div class='success'>  Failed  to Add Food .</div>";
                    //redirect to manage admin page
                    header('location'.SITEURL.'admin/add-food.php');
                  }
            }
        ?>
    </div>
</div>

<?php include("partails/footer.php");?>
