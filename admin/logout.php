<?php declare(strict_types=1);
include("../confg/constants.php");
//distory the session
 session_destroy();

 // redirect to logout page
 header('Location:'.SITEURL.'admin/login.php');
?>
