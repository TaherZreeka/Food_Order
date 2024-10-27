<?php declare(strict_types=1);  
include("../confg/constants.php");
    // get the id of admin to be delete
  $id= $_GET['id'];
   
   //create sql query to delete admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";
   
    //Execute Query and delete Data in database
    $res=mysqli_query($conn,$sql) ;
   
    // if successfully deleted
    if($res){
        $_SESSION['delete']="<div class='success'> Admin Delete successfully</div>";
     header("location:".SITEURL."admin/manage-admin.php");
    }else {
        $_SESSION['delete']="<div class='error'> Failed to Delete Admin.Try Again</div>";
        header("location:".SITEURL."admin/manage-admin.php");
    }
    
    //after delete redirect to manage-admin page with massege(success/error)



