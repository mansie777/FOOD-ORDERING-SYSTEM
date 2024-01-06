<?php
    //Include constant File
    include('../config/constants.php');
    //Check whether the id and image_name value is set or not
    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
        
        //Get the value and Delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical Image file is available
        if ($image_name != "") {
            
            //Image is available. so remove it
            $path = "../images/food/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an arror message and stop the process
            if ($remove==false) {
                // set session message
                $_SESSION['upload'] = "<div class='error'>Failed to Remove  Image File.</div>";
                //redirect to manage Category page 
                header("location:".SITEURL.'admin/manage-food.php');
                //Stop the process
                die();
            }
        }

        //Delete data from Database
        //SQL query to delete data from database
        $sql = "DELETE FROM table_food WHERE id=$id";
        //execute query
        $res = mysqli_query($conn, $sql);
        //Check whether the data is delete from database or not 
        if ($res==true) {
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            //redirect to manage Category page 
            header("location:".SITEURL.'admin/manage-food.php');

        }else {
            //set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>failed to Delete Food.</div>";
            //redirect to manage Category page 
            header("location:".SITEURL.'admin/manage-food.php');
        }

    } else {
        
        //redirect to manage Category Page with message
        $_SESSION['Unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
        header("location:".SITEURL.'admin/manage-category.php');
    }


?>