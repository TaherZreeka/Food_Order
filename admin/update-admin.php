<?php declare(strict_types=1);include("partails/menu.php"); ?>

      <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br><br>

            <?php
                //get the id of selection admin
                    $id=$_GET["id"];
                //create sql query to get the database
                   $sql=" SELECT * FROM tbl_admin WHERE id = '$id'";
                //Execute the query
                $res=mysqli_query($conn,$sql);
                //check whether the query execute
                if($res==true){
                    $count=mysqli_num_rows($res);
                    if($count==1){
                        //get the details
                        // echo"Admin Available";
                        $row=mysqli_fetch_assoc($res);
                        $full_name=$row["full_name"];
                        $username=$row["username"];
                    }else{
                        //redirect to manage admin page
                        header("location:".SITEURL."admin/manage-admin.php");
    
                    }
                }
              
            ?>
            <form action="" method="POST">
            <table class="tbl-full">
        <tr>
            <td>Full Name:</td>
            <td><input type="text" name="full_name" value="<?php echo $full_name;?>" ></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" value="<?php echo $username;?>"></td>
        </tr>
       
        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">  <!-- hidden field for id -->
                <input type="submit" name="submit" class="btn-secondary" value="Update Admin">
            </td>
        </tr>
                </table>
            </form>
        </div>

       </div>
                <?php
                    //check the whether the submit button is enabled
                    if(isset($_POST['submit'])){
                        $id=$_POST['id'];
                        $full_name=$_POST['full_name'];
                        $username=$_POST['username'];

                        //create sql query to update the admin
                        $sql="UPDATE tbl_admin SET full_name='$full_name', username='$username' WHERE id='$id'";

                        //Execute the query
                        $res=mysqli_query($conn,$sql);

                        //check whether the query execute
                        if($res==true){
                            //query execute and admin is updated
                            $_SESSION['update']="<div class='success'> Admin Update successfully</div>";
                            //redirect to manage admin page
                            header("location:".SITEURL."admin/manage-admin.php");
                        }else{
                            //query failed to execute and admin is not updated
                            $_SESSION['update']="<div class='error'> Failed to Update Admin.Try Again</div>";
                            //echo "Failed to update Admin";    
                            header("location:".SITEURL."admin/manage-admin.php");

                        }
                    }
                ?>

<?php include("partails/footer.php"); ?>