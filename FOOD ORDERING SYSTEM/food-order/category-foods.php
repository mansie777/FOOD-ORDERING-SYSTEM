<?php include("partials-font/menu.php"); ?>

    <?php
        if (isset($_GET['category_id'])) {
            # Category id is set and get the id
            $category_id =$_GET['category_id'];
            //Get the category Title based on categfory id
            $sql = "SELECT title FROM table_category WHERE id=$category_id ";
            //execute the query
            $res =mysqli_query($conn,$sql);
            //Get the value fram Database
            $row =mysqli_fetch_assoc($res);
            //Get the title
            $category_title=$row['title'];



        }
        else{
            //Category not passed
            //Redirection to home page
            header('location:'.SITEURL);
        }
    
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                //Create the query to get based on Selected category
                $sql2 = "SELECT * FROM table_food WHERE category_id=$category_id";
                //execute the query
                $res2 = mysqli_query($conn,$sql2);
                //Get the row
                $count2 = mysqli_num_rows($res2);

                //Check whether food is available or not
                if ($count2>0) {
                    # Food is Available
                    while ($row2=mysqli_fetch_assoc($res2)) {
                        $id =$row2['id'];
                        $title =$row2['title'];
                        $price = $row2['price'];
                        $desc = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                
                                    if ($image_name=="") {
                                        # image is not available
                                        echo "<div class='error'> Image is not Available</div>";

                                    } 
                                    else {
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

                } 
                else {
                    # Food is not Available
                    echo "<div class='error'>Image is not Available</div>";
                }
                
            
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    
    <?php include("partials-font/footer.php"); ?>