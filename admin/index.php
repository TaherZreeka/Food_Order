<?php declare(strict_types=1); include("partails/menu.php"); ?>
<html>

<head>
    <title>Food Order website-Home Page </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu section start -->
   


    <!--Main Content start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>
            <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];//display session massage information
                unset($_SESSION['login']);//remove session massage information
            }
        
        
        ?>
        <br><br>
            <div class="col-4 txt-center">
                <?php 
                    $sql="SELECT * FROM tbl_category ";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                
                ?>
                <h1><?php echo $count; ?></h1><br>
                categories
            </div>
            <div class="col-4 txt-center">
            <?php 
                    $sql2="SELECT * FROM tbl_food ";
                    $res2=mysqli_query($conn,$sql2);
                    $count2=mysqli_num_rows($res2);
                
                ?>
                <h1><?php echo $count2; ?></h1><br>
                Foods
            </div>
            <div class="col-4 txt-center">
                 <?php 
                    $sql3="SELECT * FROM tbl_order ";
                    $res3=mysqli_query($conn,$sql3);
                    $count3=mysqli_num_rows($res3);
                
                ?>
                <h1><?php echo $count3; ?></h1><br>
                Total Order
            </div>
            <div class="col-4 txt-center">
                <?php 
                     $sql4 = "SELECT SUM(total) AS Total FROM tbl_order";
                    $res4=mysqli_query($conn,$sql4);
                    $row4=mysqli_fetch_assoc($res4);

                    $total_revemmue=$row4['Total'];
                ?>
                <h1><?php echo"$".$total_revemmue; ?></h1><br>
                Revennue Grnerated
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content end -->
<?php include("partails/footer.php")?>