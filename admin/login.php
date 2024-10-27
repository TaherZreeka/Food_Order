<?php declare(strict_types=1);include("../confg/constants.php")  ?>

<html>

<head>
    <title> Login - Food Order System </title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
    .login {
        background-color:#dfe4ea;
        padding: 2%;
        margin: 10% auto;
        width: 20%;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 0;
        left: 36%;
        border: 2px solid black;
    }
    .img-login{
        width: 100%;
        height: 100%;
       
    }
    
    </style>
</head>

<body>
<img src="login-food.jpg" class="img-login">

    <div class="login">
        <h1 class="txt-center">Login</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];//display session massage information
                unset($_SESSION['login']);//remove session massage information
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];//display session massage information
                unset($_SESSION['no-login-message']);//remove session massage information
            }
        
        
        ?>
        <!-- Login start -->
        <form action="" method="POST" class="txt-center">
            
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

        </form>
        <!-- Login end -->
        <p class="txt-center">Create By-<a href="#">Taher Zreek</a></p>
    </div>
</body>

</html>

<?php
        //check submit is clicke or not
       if(isset($_POST['submit'])){
        // echo"click here";
        //get the data from the form
         $username = $_POST['username'];
         $password = md5($_POST['password']);

         //SQl to check whether the user with username and a password or not
         $sql="SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

         $res=mysqli_query($conn,$sql);

         $count=mysqli_num_rows($res);
         if($count==1){
            //user available
            $_SESSION['login']="<div class='success'>Login Succsseful</div>"; 


            $_SESSION['user']=$username; 
            //redirect to home page dashboard
            header("location:".SITEURL."admin/");
         }else{
            //user not available
            $_SESSION['login']="<div class='error'>Username or Password Did Not Match</div>"; 
            //redirect to home page dashboard
            header("location:".SITEURL."admin/login.php");
         }
       } 
       
?>