<?php include('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br><br>
            <?php
            
                // 1. get the ID of Select admin 
                $id =  $_GET['id'];

                // 2. Create sql Query to Get details of admin
                $sql = "SELECT * FROM table_admin WHERE id=$id";

                // execute the query
                $res = mysqli_query($conn, $sql);

                //Check whether the Query is Executed succesfully or Not
                if ($res == true) 
                {
                    // Check whether data is available or note
                    $count = mysqli_num_rows($res);
                    // Check whether we have admin data or not 
                    if ($count==1) {
                        // Get the Details
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];

                    }
                    else {
                        // Redirect Page to manage Admin
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }

                }
                    
                
            ?>
           
           <form action="" method="POST">
           <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td> 
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>"></td> 
                    </tr>
                    
                    <tr>
                        <td colspan="2">

                            <input type="hidden" name="id" value="<?php echo $id;?>"> 
                            <input type="submit" name="submit" value="Add-admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
           </form>
        </div>
</div>  

<?php 
    // check whether the submit Button is clicked or not
    if(isset($_POST['submit']))
    {
        //Get All values From form to Update
        //mysqli_real_escape_string() is a function that help to secure your webside, invite injection sql in your database to delete
        $id = $_POST['id'];
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);

        // Create a sql Query to Update Admin
        $sql = "UPDATE table_admin SET 
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
        ";

        // execute sql query
        $res = mysqli_query($conn, $sql);

        //Check whether the Query is Executed or Not
        if ($res == true) 
        {
            // Query Executed and Admin Update
            $_SESSION['update'] = "<div class='success'>Admin Update SuccessFully.</div>";
            //Redirect Page to manage Admin
             header("location:".SITEURL.'admin/manage-admin.php');
        }
        else {
            
             // Query Executed and Admin Failed to Update
             $_SESSION['update'] = "<div class='error'>Admin Failed to Update.</div>";
             //Redirect Page to manage Admin
              header("location:".SITEURL.'admin/manage-admin.php');
        }

    }
?>

<?php include('partials/footer.php');?>
