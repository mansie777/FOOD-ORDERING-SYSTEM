<?php include('partials/menu.php');?>
    

    <!-- Menu Content Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
                <br/>

                <?php 
                    if (isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; // Displaying Session Message if Set
                        unset($_SESSION['add']);// removing the Session Message 
                    }

                    if (isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; // Displaying Session Message if Set
                        unset($_SESSION['delete']);// removing the Session Message 
                    }

                    if (isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; // Displaying Session Message if Set
                        unset($_SESSION['update']);// removing the Session Message 
                    }

                    if (isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found']; // Displaying Session Message if Set
                        unset($_SESSION['user-not-found']);// removing the Session Message 
                    }

                    if (isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match']; // Displaying Session Message if Set
                        unset($_SESSION['pwd-not-match']);// removing the Session Message 
                    }

                    if (isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd']; // Displaying Session Message if Set
                        unset($_SESSION['change-pwd']);// removing the Session Message 
                    }
                ?>
                <br/><br/>
            <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL;?>admin/add-admin.php" class="btn-primary">Add Admin</a>
                <br/><br/><br/>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Action</th>
                </tr>
                <?php 
                    // Query to Get all Admin in database
                   $sql = "SELECT * FROM table_admin";
                   $res = mysqli_query($conn, $sql);
                   
                   //Check whether the Query is Executed or Not
                   if ($res == true) {
                        // count Rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res);// function to get all the rows in database

                        //$sn = 1; // Create a variable and Assign the value

                        // Check the num of rows
                        if($count > 0) 
                        {
                            while ($rows = mysqli_fetch_assoc($res))
                            {
                                // Using While loop to get all data from database
                                // and While loop will run as long as we have data in database

                                //Get individual data 
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                // Display the Value in our table
                                ?>
                                <tr >
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $full_name; ?> </td>
                                    <td><?php echo $username; ?></td>
                                    <td >
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        
                                    </td>
                                </tr>
                                <?php 
                                    
                            }
                        }else {
                
                                //we do not have data in database
                        }
                }
                
                
                
                ?>
                
            </table>
        </div>
    </div>  
    <!-- Menu Content Ends -->


    <?php include('partials/footer.php');?>