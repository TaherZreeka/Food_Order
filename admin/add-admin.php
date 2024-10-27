<?php declare(strict_types=1);
ob_start();
include("partails/menu.php"); 
?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            
            ?>
            <form action="https://formspree.io/f/meoqeqgb" method="POST">
    <table class="grid-container">
        <tr>
            <td>Full Name:</td>
            <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" placeholder="Your Username"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" placeholder="Your Password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" class="btn-primary" value="Add Admin">
            </td>
        </tr>
    </table>
</form>
          
        </div>
    </div>
<?php include("partails/footer.php");?>

<?php 
// Process the form data and save to the database

// Check if the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Button Clicked
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Password Encryption with MD5

    // SQL Query to Save the data into database
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    "; 


    // Execute the query and save data
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn)); // Execute the query

    // Check if the query executed successfully
   if($res==true){
    // echo "<script>alert('Admin Added Successfully')</script>";

    // ceate a session variable to display massage 
    $_SESSION['add']="<div class='success'> Admin Add successfully</div>";
    // Redirect to manage admin page
    header('Location:'.SITEURL."admin/manage-admin.php");
   }else{
    // echo "<script>alert('Failed to Add Admin')</script>";

    // ceate a session variable to display massage 
    $_SESSION['add']=  "<div class='success'> Failed to Add Admin</div>";
    // Redirect to add admin 
   }
}
ob_end_flush();
?>