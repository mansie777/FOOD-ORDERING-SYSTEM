<?php include("partials-font/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                //Create SQL query to display Food from Database
                $sql = "SELECT * FROM table_food WHERE active='Yes'";

                //Execute the Query
                $res = mysqli_query($conn,$sql);

                $count =mysqli_num_rows($res);

                //Chech whether if the food is available or not
                if ($count>0) {
                    # Food is available
                    while ($row=mysqli_fetch_assoc($res)) {
                        # Get the value like id, title,image name,description, price from database
                        $id =$row['id'];
                        $title =$row['title'];
                        $desc =$row['description'];
                        $price =$row['price'];
                        $image_name =$row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if ($image_name=="") {
                                        # Image is not Available
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
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">$<?php echo $price;?></p>
                                <p class="food-detail"><?php echo $desc;?></p>
                                <br>
                                <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php

                    }

                } else {
                    # Food is not available
                    echo "<div class='error'>Food not Added</div>";
                }
                

            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   

    <?php include("partials-font/footer.php"); ?>