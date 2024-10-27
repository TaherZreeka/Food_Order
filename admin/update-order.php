<?php declare(strict_types=1); ob_start();  include("partails/menu.php");?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>    

        <?php 
                if(isset($_GET['id'])){
                    //get the order details
                    $id=$_GET['id'];

                    //get all the orders
                    //sql query
                    $sql="SELECT * FROM tbl_order WHERE id = '$id'";
                    //Execute query($sql);
                    $res=mysqli_query($conn,$sql);
                    //check whether the query execute
                    $count=mysqli_num_rows($res);
                    
                    if($count==1){
                            //details avaliable
                            $row=mysqli_fetch_assoc($res);
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $status=$row['status'];
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address = $row['customer_address'] ?? '';
                            
                            
                    }else{
                        //redirect to the manage order page
                        header('Location:'.SITEURL.'admin/manage-order.php');
                        exit;
                    }
                }else{
                    //redirect to the manage order page
                    header('Location:'.SITEURL.'admin/manage-order.php');
                }

        
        ?>
        <form method="POST" action="https://formspree.io/f/xnnqjqdz">
            <table class="tbl-full">
                <tr>
                    <td>Name Food:</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
               
                <tr>
                    <td>Price:</td>
                    <td><b><?php echo"$".$price;?></b></td>
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                
                <tr>
                    <td>Status:</td>
                    <td>
                    <select name="status">
                    <option <?php if($status=="order"){echo"Selected";} ?> value="order">Order</option>
                    <option <?php if($status=="on_delivery"){echo"Selected";} ?> value="on_delivery">On Delivery</option>
                    <option <?php if($status=="delivered"){echo"Selected";} ?> value="delivered">Delivered</option>
                    <option <?php if($status=="cancelled"){echo"Selected";} ?> value="cancelled">Cancelled</option>
                   </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer_Name:</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name;?>"></td>
                </tr>
                <tr>
                    <td>Customer_Contact:</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact;?>"></td>
                </tr>
                <tr>
                    <td>Customer_Email:</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email;?>"></td>
                </tr>
                <tr>
                    <td>Customer_Address:</td>
                    <td>
                        <textarea name="address" rows="5" cols="30" value="<?php echo $customer_address;?>" ><?php echo $customer_address;?></textarea>
                    </td>
                </tr>
               
                   
                    <td colspan="2">
                        <input type="hidden" name="id"value="<?php echo $id;?>">
                        <input type="hidden" name="price"value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-update-order" style="padding:10px;">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
        
                if(isset($_POST['submit'])){
                    // echo "click here";
                    //get all orders
                    $id=$_POST['id'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $status=$_POST['status'];
                    $customer_name=$_POST['customer_name'];
                    $customer_contact=$_POST['customer_contact'];
                    $customer_email=$_POST['customer_email'];
                    $customer_address=$_POST['customer_address'];  

                    $sql2="UPDATE tbl_order SET
                        qty=$qty,
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                    ";

                    //Execute query($sql2);
                    $res2=mysqli_query($conn,$sql2);

                    if($res==true) {
                        //update
                        $_SESSION['update']="<div class='success'>Order Updated Successfully.</div>";
                        //redirect to manage admin page
                        header("Location:".SITEURL."admin/manage-order.php");
                    }else{
                        //failed to add order
                        $_SESSION['update']="<div class='error'>Failed to update order.</div>";
                          //redirect to manage admin page Failed to update order
                          header("Location:".SITEURL."admin/manage-order.php");
                    }
                }
        
        
        ?>
    </div>
</div>
<?php include("partails/footer.php");?>