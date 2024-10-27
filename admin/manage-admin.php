<?php declare(strict_types=1);include("partails/menu.php"); ?>




<!--Main Content start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];//display session massage information
                    unset($_SESSION['add']);//remove session massage information
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];//display session massage information
                    unset($_SESSION['delete']);//remove session massage information
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];//display session massage information
                    unset($_SESSION['update']);//remove session massage information
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];//display session massage information
                    unset($_SESSION['user-not-found']);//remove session massage information
                }
                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];//display session massage information
                    unset($_SESSION['pwd-not-match']);//remove session massage information
                }
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];//display session massage information
                    unset($_SESSION['change-pwd']);//remove session massage information
                }
            ?>
        <br><br>
        <!-- button add to admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>


            <?php
                    //Query to get all admin
                    $sql="select * from tbl_admin";
                    //Execute the query
                    $res=mysqli_query($conn,$sql);
                    //check whether the query succeeded
                    if($res==true){
                        //count rows
                        $count=mysqli_num_rows($res);//fuction get all the rows in database
                        $cn=1;
                        //check the num rows
                        if($count>0){
                            //we have data in database
                            while($rows=mysqli_fetch_assoc($res)){
                                
                                //get individual values
                                $id=$rows["id"];
                                $full_name=$rows["full_name"];
                                $username=$rows["username"];
                                //display the values in our table

                            ?>
            <tr>
                <td><?php echo $cn++?></td>
                <td><?php echo $full_name ?></td>
                <td><?php echo $username  ?></td>
                <td>
                    <a href="<?php echo SITEURL;?>/admin/update-change.php?id=<?php echo $id; ?>" class="btn-primary">Changed Password</a>
                    <a href="<?php echo SITEURL;?>/admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Apdate admin</a>
                    <a href="<?php echo SITEURL;?>/admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete admin</a>
                </td>
            </tr>
          
            <?php
                            }
                        }else{
                            //we have not  data in database
                        }
                    }
                ?>
           
        </table>
    </div>
</div>
<!-- Main Content end -->



<?php include("partails/footer.php");?>