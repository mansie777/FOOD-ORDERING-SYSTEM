<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <?php
            if (isset($_GET['id'])) {
                //Get the ID and all other details
                $id = $_GET['id'];
                //Create sql query to get all other details
                $sql = "SELECT * FROM table_category WHERE id=$id";
                //execute the query
                $res = mysqli_query($conn, $sql);

                //Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if ($count==1) {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                }else {
                    //redirect to manage category page with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    //redirect to manage category
                    header("location:".SITEURL.'admin/manage-category.php');
                }

            } else {
                //redirect to manage category
                header("location:".SITEURL.'admin/manage-category.php');
            }
            
        
        ?>


        <!--update Category Form Starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td> 
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if ($current_image !="") {
                                //Display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                                <?php
                            } else {
                                //display message
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            
                        
                        ?>
                    </td> 
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" value="">
                    </td> 
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo"Checked";} ?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured=="No"){echo"Checked";} ?> type="radio" name="featured" value="No">No
                    </td> 
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo"Checked";} ?> type="radio" name="active" value="Yes">Yes

                        <input <?php if($active=="No"){echo"Checked";} ?> type="radio" name="active" value="No">No
                    </td> 
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!--update Category Form Starts-->

        <?php

            if (isset($_POST['submit'])) {
                //1.Get all the values from our Form
                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                /* start functionality to update image*/
                //2.Updating New Image if selected
                //Chech whether the image is select or not
                if (isset($_FILES['image']['name'])) {
                    //Get the Image Details
                    $image_name = $_FILES['image']['name'];
                    //Check whether the image is available or not
                    if ($image_name!="") {
                        // Image is available
                        //A.Upload the New image
                        
                            //Auto Rename our Image
                        //Get the extension of our Image (jpg,png,git,etc..) e.g. "specialfood.jpg"
                        $ext = end(explode('.',$image_name));
                        //Rename the Image
                        $image_name = "Food_category".rand(000, 999).'.'.$ext;// e.g. Food_category_57.jpg


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // finally upload the Image
                        $upload = move_uploaded_file($source_path,$destination_path);
                        //Check whether the image is uploaded or not 
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if ($upload==false) {
                            //set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            //Redirect to add Category page
                            header("location:".SITEURL.'admin/manage-category.php');
                            // stop the process
                            die();
                        }

                        //B.Remove the current image if is available
                        if ($current_image!="") {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path );

                            //Check whether the image is removed or not
                            //If failed to remove then Display and stop the process
                            if ($remove==false) {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image.</div>";
                                //Redirect to add Category page
                                header("location:".SITEURL.'admin/manage-category.php');
                                
                                die();// stop the process
                             }
                        }
                        

                    }
                    else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }
                /*The End of functionality to Update image*/

                //3.Update the Database
                $sql2 = "UPDATE table_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                    ";
                //Execut the query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether executed or not
                if ($res2==true) {
                    //Category Update
                    //redirect to manage category page with session message
                    $_SESSION['update'] = "<div class='success'>Category Update successfully.</div>";
                    //redirect to manage category
                    header("location:".SITEURL.'admin/manage-category.php');
                } else {
                    //Failed to Update category
                     //redirect to manage category page with session message
                     $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                     //redirect to manage category
                     header("location:".SITEURL.'admin/manage-category.php');
                }
                

            }
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>