<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <?php
        
            //Check whether id is set or not
            if (isset($_GET['id'])) {
                # Get the order details
                $id =$_GET['id'];

                //Get all other details based on this id
                // Query to get the order details
                $sql = "SELECT * FROM table_order WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn,$sql);
                //count Rows
                $count = mysqli_num_rows($res);

                if ($count==1) {
                    # Details available
                    $row=mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                } else {
                    # Details not available
                    //Redirection to manage order page
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                

            } else {
                # Redirect to manage Order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><?php echo $food;?></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>$<?php echo $price;?></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty;?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){ echo"selected";}?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){ echo"selected";}?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){ echo"selected";}?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancalled"){ echo"selected";}?> value="Cancalled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea  name="customer_address" cols="30" rows="5"><?php echo $customer_address;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
        
            //Check whether Update Button is click or not
            if (isset($_POST["submit"])) {
                # Get all value from form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty; // total = price x qty
                $status = $_POST['status'];
                $customer_name = mysqli_real_escape_string($conn,$_POST['customer_name']);
                $customer_contact = mysqli_real_escape_string($conn,$_POST['customer_contact']);
                $customer_email = mysqli_real_escape_string($conn,$_POST['customer_email']);
                $customer_address = mysqli_real_escape_string($conn,$_POST['customer_address']);

                //Update the value
                $sql2 = "UPDATE table_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";
                //echo $sql2; die();
                //Execute the query
                $res2 = mysqli_query($conn,$sql2);
    
                //Check whether update or not
                // and redirectionto manage order page with page
                if ($res2==TRUE) {
                    //update
                    $_SESSION['update'] = "<div class='success'>Order Update Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                } else {
                    # failed to update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                
                
            } 
        
        ?>

    </div>

</div>







<?php include('partials/footer.php');?>