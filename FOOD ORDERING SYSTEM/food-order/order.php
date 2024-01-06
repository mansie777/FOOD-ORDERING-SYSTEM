<?php include("partials-font/menu.php"); ?>

    <?php
        if (isset($_GET['food_id'])) {
            # Get the Food id and Details of the selected food
            $food_id = $_GET['food_id'];
            //Get the food id and details of the selected food
            $sql = "SELECT * FROM table_food WHERE id=$food_id";
            //Execute the query
            $res = mysqli_query($conn,$sql);
            //count the rows
            $count = mysqli_num_rows($res);
            //Check whether the data is available or not
            if ($count==1) {
                # we have data
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];


            } else {
                # food not available
                //Redirect to home page
                header('location:'.SITEURL);
            }
            

        } else {
            # Redirection to home page
            header('location:'.SITEURL);
        }
        
    
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST"  class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //Check whether the image is available or not
                            if ($image_name=="") {
                                # image not available
                                echo "<div class='error'> Image is not Available</div>";

                            } else {
                                # Image is available
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price">$<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Mansie Malik" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9350 xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@mansiemalik.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if (isset($_POST['submit']))
                {
                    # Get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // Total = price x qty

                    $order_date = date("Y-m-d h:i:sa"); //order date

                    $status = "ordered"; //Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = mysqli_real_escape_string($conn,$_POST['full-name']);
                    $customer_contact = mysqli_real_escape_string($conn,$_POST['contact']);
                    $customer_email = $_POST['email'];
                    $customer_address = mysqli_real_escape_string($conn,$_POST['address']);

                    // Seve order in Database 
                    // Create sql to save data in database
                    $sql2 = "INSERT INTO table_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        ";
                      
                    //execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if ($res2==TRUE) {
                        # Query executed and order save
                        $_SESSION['order']= "<div class='success text-center'>Food Ordered Successfully</div>";
                        header('location:'.SITEURL);
                    } else {
                        # Query is not executed
                        $_SESSION['order']= "<div class='error text-center'>Failed to order Food</div>";
                        header('location:'.SITEURL);
                    }
                    


                }
                
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <?php include("partials-font/footer.php"); ?>