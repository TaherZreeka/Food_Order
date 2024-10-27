<?php declare(strict_types=1); 
include("partails/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br>
            <?php 
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            
            ?>        

        <br><br>
        <table id="table-order">
        <tr class="grid-container">
            <th style="padding: 10px;">S.N</th>
            <th style="padding: 10px;">Food</th>
            <th style="padding: 10px;">Price</th>
            <th style="padding: 10px;">Qty</th>
            <th style="padding: 10px;">Total</th>
            <th style="padding: 20px;">Order Date</th>
            <th style="padding: 10px;">Status</th>
            <th style="padding: 15px;">Name</th>
            <th style="padding-right:10px;padding-left:10px;">Contact</th>
            <th style="padding: 10px;">Email</th>
            <th style="padding: 10px;">Address</th>
            <th style="padding: 10px;">Actions</th>
        </tr>

            <?php 
                    $sql= "SELECT * FROM tbl_order ORDER BY id DESC ";

                    $res=mysqli_query($conn,$sql);

                    $count=mysqli_num_rows($res);

                    $dn=1;
                    if($count>0){
                        //order available
                        while($row=mysqli_fetch_assoc($res)){
                            //get all the order
                            $id=$row['id'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $total=$row['total'];
                            $order_date=$row['order_date'];
                            $status=$row['status'];
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address=$row['customer_address'];

                            ?>
                                    <tr class="grid-container" >
                                        <td style="padding: 10px;"><?php echo $dn++;?></td>
                                        <td style="padding: 10px;"><?php echo $food;?></td>
                                        <td style="padding: 10px;"><?php echo $price;?></td>
                                        <td style="padding: 10px;"><?php echo $qty;?></td>
                                        <td style="padding: 10px;"><?php echo $total;?></td>
                                        <td style="padding: 20px;"><?php echo $order_date;?></td>
                                        <td style="padding: 10px;"><?php echo $status;?></td>
                                        <td style="padding: 15px;"><?php echo $customer_name;?></td>
                                        <td style="padding-right:10px;padding-left:10px;"><?php echo $customer_contact;?></td>
                                        <td style="padding: 10px;"><?php echo $customer_email;?></td>
                                        <td style="padding: 10px;"><?php echo $customer_address;?></td>
                                        <td style="padding: 10px;">
                                            <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-update-order" style="padding: 8px;" >Update order</a>
                                        </td>
                                    </tr>
                                
                            <?php
                        }
                    }else{
                        //order not available
                        echo "<tr><td colspan='12' class='error'> Order Not Available</td></tr>";
                    }
            
            ?>
            




        </table>
    </div>
</div>

<?php include("partails/footer.php");?>