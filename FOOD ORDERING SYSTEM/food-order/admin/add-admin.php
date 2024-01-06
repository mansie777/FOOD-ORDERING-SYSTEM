<?php include('partials/menu.php');?>

<div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br><br>
            <?php 
                    if (isset($_SESSION['add']))//Checking whether the Session is not Set or Not 
                    {
                        echo $_SESSION['add']; // Displaying Session Message
                        unset($_SESSION['add']);// removing the Session Message
                    }
                
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter your Name"></td> 
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Enter your Username"></td> 
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter your Password"></td> 
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Add-admin" class="btn-secondary"></td>
                    </tr>
                </table>
            </form>
        </div>
</div>  
<?php include('partials/footer.php');?>


<?php 
   //Process the value from form and save it in Database 

   // Check whether the button is clicked or not
    if(isset($_POST['submit']))
    {
        
        //1. Get the Data from form
        //mysqli_real_escape_string() is a function that help to secure your webside, invite injection sql in your database to delete
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $raw_password = md5($_POST['password']);//md5 helping me to encription my password
        $password =  mysqli_real_escape_string($conn,$raw_password);
        
        //2. SQL Query to Save the Data into  Database
        $sql = "INSERT INTO table_admin SET
         full_name = '$full_name',
         username =  '$username',
         password = '$password'
        ";
       
        //3. executing query and save into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // check whether the (query is executed) data is insert or not display appropriate message
        if ($res == TRUE) {
            //Data inserted
            // Create a Session variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page to manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else {
            
            // Create a Session variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            //Redirect Page to add Admin
            header("location:".SITEURL.'admin/add-admin.php');

        }

    }
    
?>