<?php include("partials-font/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            
                //Get the Search keyword
                //$search = $_POST['search']; the function mysqli_real_escape_string is use for sql injection
                $search = mysqli_real_escape_string($conn,$_POST['search']);
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //SQL query to get Foods based on search keyword
                //$search = burger ';Database name;
                //SELECT * FROM table_food WHERE title LIKE '%%' OR description LIKE '%%' OR price LIKE '$search'";
                $sql = "SELECT * FROM table_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR price LIKE '$search'";

                // Execute the query
                $res = mysqli_query($conn,$sql);
                //count rows
                $count = mysqli_num_rows($res);

                //Check whether the foods are available or not
                if ($count>0) {
                    # food available
                    while ($row=mysqli_fetch_assoc($res)) {
                        # Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $desc = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //Check whether image is available or not
                                    if ($image_name=="") {
                                        # Image is not Available
                                        echo "<div class='error'> Image is not Available</div>";
                                    } else {
                                        # Image is Available
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">$<?php echo $price;?></p>
                                <p class="food-detail"><?php echo $desc?></p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php

                    }
                } 
                else {
                    # Food is not available
                    echo "<div class='error'> Food not Found</div>";
                }
                

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-font/footer.php"); ?>