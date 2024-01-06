<?php 
    // include constants.php file here
    include('../config/constants.php');

    // 1. get the ID of admin to be deleted
    $id =  $_GET['id'];

    // 2. Create sql Query to Delete Admin
    $sql = "DELETE FROM table_admin WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the Query is Executed succesfully or Not
    if ($res == true) 
    {
        // Query executed Successfully and Admin Deleted
        //echo'Admin Deleted';
        // Create a Session variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        //Redirect Page to manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');

    }else {
        // Failed to Delete Admin
        // Create a Session variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Failed to Delete Admin. Please Try Again Later.</div>";
        //Redirect Page to manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }

    // 3. Redirect to manage Admin page with message (success / error)



?>
