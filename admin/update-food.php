<?php
declare(strict_types=1);
ob_start();
if (headers_sent($file, $line)) {
    die("Headers already sent in $file on line $line");
}
include("partails/menu.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_food WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
        $category = $row['category_id']; // Ensure category is fetched
    } else {
        $_SESSION['no-food-found'] = "<div class='error'>Food Not Found</div>";
        header("Location:" . SITEURL . "admin/manage-food.php");
        exit();
    }
} else {
    header("Location:" . SITEURL . "admin/manage-food.php");
    exit();
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required></td>
                </tr>
                <tr>
                    <td>New Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="10" placeholder="Description of the Food."><?php echo htmlspecialchars($description); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>New Price:</td>
                    <td><input type="number" name="price" placeholder="Enter Food Price" required value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php if ($current_image != ""): ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                        <?php else: ?>
                            <div class='error'>Image Not Found</div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id" required>
                            <?php
                            // Fetch categories for the dropdown
                            $sql_cat = "SELECT * FROM tbl_category"; // Assuming you have a table for categories
                            $res_cat = mysqli_query($conn, $sql_cat);
                            if ($res_cat) {
                                while ($row_cat = mysqli_fetch_assoc($res_cat)) {
                                    $cat_id = $row_cat['id'];
                                    $cat_name = $row_cat['title'];
                                    // Check if the category is selected
                                    $selected = ($category == $cat_id) ? "selected" : "";
                                    echo "<option value='$cat_id' $selected>$cat_name</option>";
                                }
                            } else {
                                echo "<option value=''>No categories found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($featured == "Yes") {echo "checked";} ?>>Yes
                        <input type="radio" name="featured" value="No" <?php if ($featured == "No") {echo "checked";} ?>>No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($active == "Yes") {echo "checked";} ?>>Yes
                        <input type="radio" name="active" value="No" <?php if ($active == "No") {echo "checked";} ?>>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Hidden field for id -->
                        <input type="submit" name="submit" class="btn-secondary" value="Update Food">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category_id']; // Get category from POST
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/".$image_name;

                // Upload the new image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check if the image is uploaded or not
                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. Try Again.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();
                }

                // Remove the current image if available
                if ($current_image != "") {
                    $remove_path = "../images/food/".$current_image;
                    $remove = unlink($remove_path);

                    if ($remove == false) {
                        $_SESSION['remove'] = "<div class='error'>Failed to Remove Current Image.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }
                }

                $current_image = $image_name; // Set current image to new image name
            }

            // Update the database
            $sql2 = "UPDATE tbl_food SET 
                title = '$title', 
                description = '$description', 
                price = $price, 
                image_name = '$current_image', 
                category_id = '$category',  -- Fixed syntax error (removed semicolon)
                featured = '$featured', 
                active = '$active' 
                WHERE id = '$id'";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2) {
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                header("Location:".SITEURL."admin/manage-food.php");
                exit();
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Food. Try Again</div>";
                header("Location:".SITEURL."admin/manage-food.php");
                exit();
            }
        }
        ?>
    </div>
</div>
<?php include("partails/footer.php"); ?>
