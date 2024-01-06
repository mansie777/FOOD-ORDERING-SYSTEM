<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br> <br>
        <?php
            if (isset($_SESSION['upload']))
            {
                echo $_SESSION['upload']; // Displaying Session Message if Set
                unset($_SESSION['upload']);// removing the Session Message 
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of the Food"></td> 
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food" ></textarea>
                    </td> 
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" >
                    </td> 
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td> 
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <!-- add categories that here -->
                            <?php  
                                //Create php code to display categories from Database 
                                //1. Create SQL code to get all active categories from database 
                                $sql = "SELECT * FROM table_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);

                                //count Rows to check whether we have Category or not
                                $count = mysqli_num_rows($res);

                                // If count is Greater than zero, we have Categories else we don't have Categories
                                if ($count>0) {
                                    # we have categoiries
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // Get the details of Categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    } 
                                }
                                else {
                                    # we don't have Category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php 
                                    
                                }
                                //2. Display on Dropdown 
                            ?>
                        </select>
                    </td> 
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                    </td> 
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td> 
                </tr>
                <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                 </tr>
            </table>
        </form>
        <?php
        
            //Check whether the button is clicked or not
            if (isset($_POST['submit'])) {
                # Add the food in Database
                //echo 'button is clicked';
                //1. Get the Data from Form
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $description = mysqli_real_escape_string($conn,$_POST['description']);
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radio button for featured and active are checked or not
                if (isset($_POST['featured'])) {
                    
                    $featured = $_POST['featured'];
                }
                else {
                    $featured = 'No'; // Setting the default value 
                }

                if (isset($_POST['active'])) {
                    
                    $active = $_POST['active'];
                } 
                else {
                    
                    $active = 'No'; // Setting the default value
                }   

                //2. Update Image if Selected
                // Check whether the select image is click or not and update the image only if the image is selected
                if (isset($_FILES['image']['name'])) {
                    // Get the details of selected image
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is selected or not and upload image only if selected
                    if ($image_name!="") {
                        # Image is selected
                        # A. Rename the Image
                        //Get the extension of selected image (jpg, png, gif, etc) e.g. "specialfood.jpg"
                        $extension = explode('.',$image_name);
                        $ext = end($extension);
                        // Create New name for Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;//New image Name may be "Food-Name-976.pjg"
                        
                        # B. Uplaod the image
                        //Get the source path and destination path of image

                        //source path is the current location of the image 
                        $src = $_FILES['image']['tmp_name'];

                        //Destination path for image to be upload
                        $dst = "../images/food/".$image_name;

                        //Fanally Upload the Food image
                        $upload = move_uploaded_file($src,$dst);

                        //Check whether image is uploaded or not
                        if ($upload==false) {
                            # Failed to Upload the image
                            # Redirection to Add Food page with error message
                            $_SESSION['add'] = "<div class='error'>Failed to Upload Image.</div>";
                            header("location:".SITEURL.'admin/add-food.php');
                            # Stop the process
                            die();
                        }

                    }

                }
                else {
                    $image_name = "";// setting default value as blank
                }

                //3.  Insert into Database
                // Create a SQL query to save data  or Add food in database
                //for Numerical value we don't need to pass value inside quotes '' but for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO table_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";
                
                //execute the query 
                $res2 = mysqli_query($conn,$sql2);
                //Check whether the Data is inserted or not 
                //4. Redirection with message to message Food Page
                if ($res2==true) {
                    # Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Food Add successfully.</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }else {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }

                

            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>