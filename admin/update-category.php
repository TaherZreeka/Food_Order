<?php
declare(strict_types=1);
ob_start();
if (headers_sent($file, $line)) {
    die("Headers already sent in $file on line $line");
}
include("partails/menu.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_category WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
        header("Location:".SITEURL."admin/manage-category.php");
        exit();
    }
} else {
    header("Location:".SITEURL."admin/manage-category.php");
    exit();
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php if ($current_image != ""): ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
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
                        <input type="submit" name="submit" class="btn-secondary" value="Update Category">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;
                
                // Upload the new image
                $upload = move_uploaded_file($source_path, $destination_path);
                
                // Check if the image is uploaded or not
                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. Try Again.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();
                }
                
                // Remove the current image if available
                if ($current_image != "") {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);
                    
                    if ($remove == false) {
                        $_SESSION['remove'] = "<div class='error'>Failed to Remove Current Image.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();
                    }
                }

                $current_image = $image_name; // Set current image to new image name
            }

            // Update the database
            $sql2 = "UPDATE tbl_category SET 
                title = '$title', 
                image_name = '$current_image', 
                featured = '$featured', 
                active = '$active' 
                WHERE id = '$id'";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2) {
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                header("Location:".SITEURL."admin/manage-category.php");
                exit();
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Category. Try Again</div>";
                header("Location:".SITEURL."admin/manage-category.php");
                exit();
            }
        }
        ?>
    </div>
</div>
<?php include("partails/footer.php"); ?>
