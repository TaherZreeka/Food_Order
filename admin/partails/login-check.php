<?php  declare(strict_types=1); 

    if(!isset($_SESSION['user'])){
        $_SESSION['no-login-message']="<div class='error txt-center'>Please login to access Admin panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>