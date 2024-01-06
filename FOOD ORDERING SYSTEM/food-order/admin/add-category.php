<?php include('partials/menu.php');?>

    
<div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
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
            ?>
            <br>
            
            <!--Add Category Form Starts-->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Title Category"></td> 
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td><input type="file" name="image" ></td> 
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td> 
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Add category" class="btn-secondary"></td>
                    </tr>
                </table>
            </form>
        <!--Add Category Form ends-->
        <?php

            //Check whether the submit button is click or not
            if (isset($_POST['submit'])) {
                //1. Get the value from Category Form
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                //For Radio input, we need to check whether the button is select or not
                if (isset($_POST['featured'])) {
                    //Get the value from form
                    $featured = $_POST['featured'];
                }else {
                    //Set the default value
                    $featured = "No";
                }

                if (isset($_POST['active'])) {
                    //Get the value from form
                    $active = $_POST['active'];
                }else {
                    //Set the default value
                    $active = "No";
                }
                //Check whether the image is selected or not and set the value for image name accoridinly
                // print_r($_FILES['image']);
                // die();//break the code here
                if (isset($_FILES['image']['name'])) {


                    //upload the Image
                    //To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //Upload the image only if image is selected

                    if ($image_name !="") {
                        
                   
                        //Auto Rename our Image
                        //Get the extension of our Image (jpg,png,git,etc..) e.g. "specialfood.jpg"
                        $ext = end(explode('.', $image_name));
                        //Rename the Image
                        $image_name = "Food_category".rand(000, 999).'.'.$ext;// e.g. Food_category_57.jpg


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // finally upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);
                        //Check whether the image is uploaded or not 
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if ($upload==false) {
                            //set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            //Redirect to add Category page
                            header("location:".SITEURL.'admin/add-category.php');
                            // stop the process
                            die();
                        }
                }
                    
                    
                } else {
                    //don't upload the image and set the image_name value as blank
                    $image_name = "";

                }
                
                
                //2. Create SQL Query To insert Category
                $sql = "INSERT INTO table_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    ";
                
                //3.execute the query and save in DataBase
                $res = mysqli_query($conn, $sql);
                //4.Check whether the query executed or not and data added or not
                if ($res==true) {
                    //Query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect Page to manage Category
                    header("location:".SITEURL.'admin/manage-category.php');
                }else {
                    //Failed to added category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                    //Redirect Page to add Admin
                    header("location:".SITEURL.'admin/add-category.php');
                }

            }

        ?>



        </div>
</div>  


<?php include('partials/footer.php');?>

