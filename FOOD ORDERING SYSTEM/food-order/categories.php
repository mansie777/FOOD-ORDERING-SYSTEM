<?php include("partials-font/menu.php"); ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
            
                //Create SQL query to display categories from Database
                $sql = "SELECT * FROM table_category WHERE active='Yes'";
                
                //execute the query
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                
                if ($count>0) {
                    # Category is availaible
                    while ($row=mysqli_fetch_assoc($res)) {
                        # Get all data from Data base
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if ($image_name=="") {
                                        # Image is not available
                                        echo "<div class='error'> Category not Added</div>";
                                    } else {
                                        # Image is available
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
                }
                else {
                    # Category is not available
                    echo "<div class='error'> Category not Added</div>";

                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include("partials-font/footer.php"); ?>