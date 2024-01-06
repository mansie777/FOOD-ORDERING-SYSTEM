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
        <?php
                    if (isset($_SESSION['order']))//Checking whether the Session is not Set or Not 
                    {
                        echo $_SESSION['order']; // Displaying Session Message
                        unset($_SESSION['order']);// removing the Session Message
                    }
        ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
            <?php 
            
                //Create SQL query to display categories from Database
                $sql = "SELECT * FROM table_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the Query
                $res = mysqli_query($conn,$sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if ($count>0) {
                    # Categories available 
                    while ($row=mysqli_fetch_assoc($res)) {
                        # Get the value like id, title,image name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">

                                <?php 
                                
                                    if ($image_name=="") {
                                        # Image is not Available
                                        echo "<div class='error'> Image is not Available</div>";
                                    } else {
                                        # Image is Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php 
                                    }
                                    
                                
                                ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                    <?php   
                    }
                } else {
                    //Category is not Available
                    echo "<div class='error'> Category not Added</div>";
                }
                
            
            ?>

        
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
            //Create SQL query to display Foo from Database
            $sql2 = "SELECT * FROM table_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            //Execute the Query
            $res2 = mysqli_query($conn,$sql2);
            //Count rows to check whether the category is available or not
            $count2 = mysqli_num_rows($res2);

            if ($count2>0) {
                # Categories available 
                while ($row2=mysqli_fetch_assoc($res2)) {
                    # Get the value like id, title,image name
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $image_name = $row2['image_name'];
                    $price = $row2['price'];
                    $desc = $row2['description'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                        <?php
                            if ($image_name=="") {
                                # Image is not Available
                                echo "<div class='error'> Image is not Available</div>";
                            } else {
                                # Image is Available
                                ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php 
                            }
                                    
                                
                        ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                            <?php echo $desc; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else {
                # Food is not available
                echo "<div class='error'>Food not Added</div>";

            } 
            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   
    <?php include("partials-font/footer.php"); ?>
    