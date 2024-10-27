<?php declare(strict_types=1);include("partails/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php 
            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }
        
        ?>
        <form action="" method="POST">
            <table class="tbl-full">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="old password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="new password"></td>
                </tr>
                <tr>
                   <td>Confirm Password:</td>
                   <td><input type="password" name="confirm_password" placeholder="confirm password"></td>
                </tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" class="btn-secondary" value="Change Password">
            </td>
            </table>
        </form>


    </div>
</div>
</div>
        <?php
        // Check if the submit button is clicked or not
            if(isset($_POST['submit'])){
                // echo "click here"; 

                //get the data from the Form
                $id = $_POST['id'];
                //check if the current password and current id exits or no
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                //check if the confirm password equal to the new password or not
                $sql="SELECT * FROM tbl_admin WHERE id = $id   AND   password = '$current_password'";

                $res=mysqli_query($conn,$sql);
                
                if($res==true){
                    $count=mysqli_num_rows($res);

                    if($count==1){
                        //echo "User Found";
                        //check if the confirm password equal to the new password or not
                        if($new_password == $confirm_password){
                           //update the password
                          
                           $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id='$id'";

                         //execute the query
                         $res2=mysqli_query($conn,$sql2);
                        
                         //check whether the query succeeded or failed 
                            if($res2==true){
                                //displat the succeede message
                                  //redirect to manage admin page
                            $_SESSION['change-pwd']="<div class='success'> Password Change Successflly </div>";
                            header('Location:'.SITEURL.'admin/manage-admin.php');
                            }else{
                               //displat the erroe message
                               //redirect to manage admin page
                            $_SESSION['change-pwd']="<div class='error' >Failed to Change Password </div>";
                            header('Location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }else{
                            //redirect to manage admin page
                            $_SESSION['pwd-not-match']="<div class='error'> Password Did Not Match </div>";
                        header('Location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }else{
                        $_SESSION['user-not-found']="<div class='error'> User not found </div>";
                        header('Location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
        } 
        ?>
<?php include("partails/footer.php");?>