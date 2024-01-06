<?php include('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br/><br/>
            <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br/><br/><br/>
                <?php
                if (isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; // Displaying Session Message if Set
                        unset($_SESSION['add']);// removing the Session Message 
                    }

                if (isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload']; // Displaying Session Message if Set
                        unset($_SESSION['upload']);// removing the Session Message 
                    }
                if (isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; // Displaying Session Message if Set
                        unset($_SESSION['delete']);// removing the Session Message 
                    }
                if (isset($_SESSION['Unauthorized']))
                    {
                        echo $_SESSION['Unauthorized']; // Displaying Session Message if Set
                        unset($_SESSION['Unauthorized']);// removing the Session Message 
                    }
                if (isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; // Displaying Session Message if Set
                        unset($_SESSION['update']);// removing the Session Message 
                    }
                ?>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Create a SQL Query to Get all the Food
                    $sql = "SELECT * FROM table_food";

                    //execute the query
                    $res = mysqli_query($conn,$sql);

                    //count Rows to check whether we have foods or not
                    $count = mysqli_num_rows($res);

                    //Create Serial number variable And set default value as 1
                    //$sn=1;

                    if ($count>0) {
                        //we have Food in database
                        //Get the Foods from Database and Display
                        while ($row=mysqli_fetch_assoc($res)) {
                            # Get the values from individual columns
                            $id = $row['id'];
                            $title= $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                            <tr >
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>$<?php echo $price; ?></td>
                                <td>
                                    <?php
                                        //Check whether we have image or not 
                                        if ($image_name!="") {
                                           
                                              # we have Image, Display image
                                              ?>
                                              <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px">
                                              <?php
                                        }else {
                                          
                                                 # we don't have image, Display Error message
                                                 echo "<div class='error'>Image not Added.</div>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td >
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                    
                                </td>
                            </tr>
                            <?php


                        }
                    }
                    else {
                        # Food not Added in Database and this the way to write html code in php code
                        echo "<tr> <td colspan='7' class='error'> Food not Added Yet.<td> </tr>";
                    }
                ?>
                
            </table>
        </div>
    </div> 
<?php include('partials/footer.php');?>