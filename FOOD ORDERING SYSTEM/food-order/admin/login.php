<?php include("../config/constants.php");?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>
            
        <?php
            if (isset($_SESSION['login']))
            {
                echo $_SESSION['login']; // Displaying Session Message if Set
                unset($_SESSION['login']);// removing the Session Message 
            }

            if (isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message']; // Displaying Session Message if Set
                unset($_SESSION['no-login-message']);// removing the Session Message 
            }
        ?>
            <br>
            <!--Login form starts here-->
                <form method="POST" action="" class="text-center">
                    Username: <br><br>
                    <input type="text" name="username" placeholder="Enter Username"><br><br><br>
                    Password: <br><br>
                    <input type="password" name="password" placeholder="Enter Password"><br><br>

                    <input  type="submit" name="submit" value="Login" class="btn-primary">
                </form>
            <!--Login form ends here--> <br>

            <p class="text-center">Created By - <a href="www.mansiemalik.com">Manssie Malk</a></p>
        </div>
    </body>
</html>

<?php

    //Check whether the submit Button is clicked or not
    if (isset($_POST['submit'])) {
        //Process for login
        //1.Get the Data from login form
        //$username = $_POST['username'];
        //$password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn,$raw_password);
        
        //2. SQL to check whether the user with username and password exists or not 
        $sql = "SELECT * FROM table_admin WHERE username='$username' AND password='$password'";

        //3.Execute the Query
        $res= mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1){
            //User Available and Login success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username;// to check whether the user is logged in or not and logout will unset it
            //Rediction to hme page/Dashboad
            header('location:'.SITEURL.'admin/');
        }else {
            // User not Available and login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Rediction to hme page/Dashboad
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>