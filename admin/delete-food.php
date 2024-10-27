<?php declare(strict_types=1); include("../confg/constants.php"); ?>
<?php
    //check whether the id and image_name values are set or not
    if (isset($_GET["id"]) && isset($_GET["image_name"])) {
        $id = (int)$_GET["id"];
        $image_name = $_GET["image_name"];

        // Check if the image exists and remove it
        if ($image_name !== "") {
            $path = "../images/food/" . $image_name;  // Correct path
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION["remove"] = "<div class='error'>Failed to Remove Food Image.</div>";
                header("Location:" . SITEURL . "admin/manage-food.php");
                die();
            }
        }

        // Delete data from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        // Check if the data was deleted from the database
        if ($res == true) {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        }

        // Redirect to manage category page
        header("Location:" . SITEURL . "admin/manage-food.php");

    } else {
        // Redirect if no ID or image is set
        header("Location:" . SITEURL . "admin/manage-food.php");
    }
?>