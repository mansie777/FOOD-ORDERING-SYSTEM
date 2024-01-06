<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php
                if (isset($_GET['id'])) 
                {
                    $id = $_GET['id'];
                }
            ?>
            

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>

        </div>

    </div>

    <?php 
        //Check whether the submit button is click or not
        if (isset($_POST['submit'])) 
        {
            //1. Get Data from form
            //mysqli_real_escape_string() is a function that help to secure your webside, invite injection sql in your database to delete
            $id = $_POST['id'];
            $raw_current_password = md5($_POST['current_password']);//md5 helping me to encription my password
            $current_password = mysqli_real_escape_string($conn,$raw_current_password);
            $raw_new_password = md5($_POST['new_password']);//md5 helping me to encription my password
            $new_password = mysqli_real_escape_string($conn,$raw_new_password);
            $raw_confirm_password = md5($_POST['confirm_password']);//md5 helping me to encription my password
            $confirm_password = mysqli_real_escape_string($conn,$raw_confirm_password);
            
            //2. Check whether the user with current ID and current password Exists or not
            $sql = "SELECT * FROM table_admin WHERE id=$id AND password='$current_password'";

            //Execute the query
            $res = mysqli_query( $conn,  $sql);

            if ($res==true) {
                //Check whether data is available or not
                $count = mysqli_num_rows($res);

                if ($count==1) {
                    //User exists and Password can be changed
                    //Check whether the New password and Confirm Password are same or not
                    if ($new_password==$confirm_password) {
                        // Update the password
                        $sql2 = "UPDATE table_admin SET
                        password = '$new_password'
                        WHERE id = $id
                        ";

                        //Execute  the  Query
                        $res2  =  mysqli_query($conn, $sql2);

                        //Check whether the Query executed or not
                        if ($res2=true) {
                            //Display message of success
                            //Redirection with success message
                            $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                            //Redirect Page to manage Admin
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }else {
                            // display message of error
                            //Redirection with error message
                            $_SESSION['change-pwd'] = "<div class='error'>Failed Password Changed.</div>";
                            //Redirect Page to manage Admin
                            header("location:".SITEURL.'admin/manage-admin.php');

                        }
                    }else {
                        //Redirection with error message
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password did not patch.</div>";
                        //Redirect Page to manage Admin
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }

                }else {
                    // User does not exists set message and Redirection
                    $_SESSION['user-not-found'] = "<div class='error'>User not Found.</div>";
                    //Redirect Page to manage Admin
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }

            //3. Check whether the new password and confirm password same or not

            //4. Change Password if all above is true
        }
    
    ?>

<?php include('partials/footer.php');?>