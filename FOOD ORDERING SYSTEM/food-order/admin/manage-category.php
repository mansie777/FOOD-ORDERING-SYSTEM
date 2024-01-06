<?php include('partials/menu.php');?>

<div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br/>
            <?php
                 if (isset($_SESSION['add']))
                 {
                     echo $_SESSION['add']; // Displaying Session Message if Set
                     unset($_SESSION['add']);// removing the Session Message 
                 }

                 if (isset($_SESSION['remove']))
                 {
                     echo $_SESSION['remove']; // Displaying Session Message if Set
                     unset($_SESSION['remove']);// removing the Session Message 
                 }

                 if (isset($_SESSION['delete']))
                 {
                     echo $_SESSION['delete']; // Displaying Session Message if Set
                     unset($_SESSION['delete']);// removing the Session Message 
                 }

                 if (isset($_SESSION['no-category-found']))
                 {
                     echo $_SESSION['no-category-found']; // Displaying Session Message if Set
                     unset($_SESSION['no-category-found']);// removing the Session Message 
                 }

                 if (isset($_SESSION['update']))
                 {
                     echo $_SESSION['update']; // Displaying Session Message if Set
                     unset($_SESSION['update']);// removing the Session Message 
                 }

                 if (isset($_SESSION['upload']))
                 {
                     echo $_SESSION['upload']; // Displaying Session Message if Set
                     unset($_SESSION['upload']);// removing the Session Message 
                 }

                 if (isset($_SESSION['failed-remove']))
                 {
                     echo $_SESSION['failed-remove']; // Displaying Session Message if Set
                     unset($_SESSION['failed-remove']);// removing the Session Message 
                 }
            ?>
            <br/><br/>
            <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br/><br/><br/>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Images</th>
                    <th>Featured</th>
                    <th>active</th>
                    <th>Action</th>
                </tr>

                <?php
                
                 //Query to Get All Category from form
                 $sql = "SELECT * FROM table_category";

                 //Execute Query
                 $res = mysqli_query($conn, $sql);

                 //Count Rows
                 $count = mysqli_num_rows($res);

                 //create serial number Variable and assign value as 1
                 //$SN = 1;

                 //Check whether we have Data in database or not
                 if ($count>0) {
                     // we have Data in Database 
                     //Get the Data and Display
                     while($row=mysqli_fetch_assoc($res)){
                         $id = $row['id'];
                         $title = $row['title'];
                         $image_name = $row['image_name'];
                         $featured = $row['featured'];
                         $active = $row['active'];
                         
                         ?>
                            <tr >
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>

                                <td>
                                    <?php 
                                        //Check whether image is available or not
                                        if ($image_name!="") {
                                            //Display Image
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">
                                            <?php

                                        } else {
                                            //Display the message
                                            echo "<div class='error'>Image not added</div>";
                                        }
                                        
                                    ?>
                                </td>

                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td >
                                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                    
                                </td>
                            </tr>

                         <?php
                     }

                 }else {
                     //we don't have data in Database
                     //we 'll display the message inside table
                     ?>
                     <tr>
                         <td colspan="6"><div class="error">No Category Added</div></td>
                     </tr>
                     <?php
                 }
                
                ?>

               
               
               
                
            </table>
        </div>
    </div> 
<?php include('partials/footer.php');?>