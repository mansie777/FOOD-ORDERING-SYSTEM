<?php include('partials/menu.php');?>
<?php
    //Check whether id is set or not
    if (isset($_GET['id'])) {
        # Get all details
        $id = $_GET['id'];

        //SQL Query to get the Select Food
        $sql2 = "SELECT * FROM table_food WHERE id=$id";
        //execute the query
        $res2 = mysqli_query($conn,$sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Value of Selected Food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else {
        // Redirection to manage Food with message
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td> 
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td> 
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>" >
                    </td> 
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if ($current_image=="") {
                                # Image not available
                                echo "<div class='error'>Image is not Available.</div>";
                            } else {
                                # Image available
                        ?><img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image;?>" width="100px">
                        <?php
                            }
                            
                        ?>
                    </td> 
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td> 
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                           
                            <?php
                                //Query to Get active Categories
                                $sql = "SELECT * FROM table_category WHERE active='Yes'";

                                //Execute query
                                $res = mysqli_query($conn,$sql);
                                //count the Rows
                                $count = mysqli_num_rows($res);

                                //Check whether if Category is available or not
                                if ($count>0) {
                                    # Category available
                                    while ($row=mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        ?><option <?php if ($current_category==$category_id){ echo"selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php     
                                    }
                                } else {
                                    # Category is not available
                                    echo"<option value='0'>Category not available.</option>";
                                }
                                ?>
     
                        </select>
                    </td> 
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                            <input <?php if ($featured=="Yes"){ echo"Checked";}?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if ($featured=="No"){ echo"Checked";}?> type="radio" name="featured" value="No"> No
                    </td> 
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active=="Yes"){ echo"Checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active=="No"){ echo"Checked";}?> type="radio" name="active" value="No"> No
                    </td> 
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                 </tr>
            </table>
        </form>

        <?php
            if (isset($_POST['submit'])) {
                //1. Get all the details from form
                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $description = mysqli_real_escape_string($conn,$_POST['description']);
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];


                //2. Upload the image if selected 

                //Check whether upload button is click or not
                if (isset($_FILES['image']['name'])) {
                    # Upload button Clicked
                    $image_name = $_FILES['image']['name'];// New image name

                    //Check whether the file is available or not
                    if($image_name!="") {
                        // Image is available
                        //A.Upload the New image
                        
                            //Auto Rename our Image
                        //Get the extension of our Image (jpg,png,git,etc..) e.g. "specialfood.jpg"
                        $extension = explode('.',$image_name);
                        $ext = end($extension);
                        //Rename the Image
                        $image_name = "Food_category".rand(000, 999).'.'.$ext;// e.g. Food_category_57.jpg

                        // Get the Source Path and Destination Path
                        $src_path = $_FILES['image']['tmp_name'];// source path
                        $dest_path = "../images/food/".$image_name;//Destination path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //Chech whether the image is upload or not 
                        if ($upload==false) {
                            # Failed to upload
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                            //redirect to manage category
                            header("location:".SITEURL.'admin/manage-food.php');
                            //Stop the process
                            die();

                        }
                        //3. Remove the image if new image is Upload and current image exists
                        //B. Remove current Image if available
                        if ($current_image!="") {
                            //current image is available
                            //Remove the image
                            $remove_path="../images/food/".$current_image;
                            
                            $remove=unlink($remove_path);
                            //Check whether the image is removed or not
                            if ($remove==false) {
                                # Failed to remove current image
                                $_SESSION['remove-failed']="<div class='error'>Failed to remove current image.</div>";
                                //redirect to manage category
                                header("location:".SITEURL.'admin/manage-food.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else {
                        $image_name = $current_image; //Default Image when image is not Selected
                    }

                }
                else {
                    $image_name = $current_image; //Default Image when image is not Clicked
                }
                //4. Update the food in database
                $sql3 = "UPDATE table_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                    ";
                
                //execute the sql query
                $res3 = mysqli_query($conn,$sql3);
                //Check whether the query is executed or not
                if ($res3==true) {
                    # Query executed and food Update
                    $_SESSION['update']="<div class='success'>Food Updated successfully.</div>";
                    //redirect to manage category
                    //header('location:'.SITEURL.'admin/manage-food.php');
                    header("location:".SITEURL.'admin/manage-food.php');
                } else {
                    # Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    //redirect to manage category
                    header("location:".SITEURL.'admin/manage-food.php');
                }
            }
        ?>

</div>
</div>
<?php include('partials/footer.php');?>