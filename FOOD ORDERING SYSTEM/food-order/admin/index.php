<?php include('partials/menu.php');?>

    <!-- Menu Content Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1><br>
        
        <?php
            if (isset($_SESSION['login']))
            {
                echo $_SESSION['login']; // Displaying Session Message if Set
                unset($_SESSION['login']);// removing the Session Message 
            }
        ?>
        <br>
            <div class="col-4 text-center">
                <?php
                    //sql query
                    $sql = "SELECT * FROM table_category";
                    //execute query
                    $res = mysqli_query($conn,$sql);
                    //Count Rows in database
                    $count = mysqli_num_rows($res);
                    
                ?>
                <h1><?php echo $count?></h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
                <?php
                    //sql query
                    $sql2 = "SELECT * FROM table_food";
                    //execute query
                    $res2 = mysqli_query($conn,$sql2);
                    //Count Rows in database
                    $count2 = mysqli_num_rows($res2);
                    
                ?>
                <h1><?php echo $count?></h1>
                <br>
                Foods
            </div>
            <div class="col-4 text-center">
                <?php
                    //sql query
                    $sql3 = "SELECT * FROM table_order";
                    //execute query
                    $res3 = mysqli_query($conn,$sql3);
                    //Count Rows in database
                    $count3 = mysqli_num_rows($res3);
                    
                ?>
                <h1><?php echo $count3?></h1>
                <br>
                Order
            </div><div class="col-4 text-center">
                <?php
                
                    //Create sql query to get Total Revenue Generated
                    //Aggregate Function in sql
                    $sql4 = "SELECT SUM(total) AS total FROM table_order WHERE status='Delivered'";
                    //execute query
                    $res4 = mysqli_query($conn,$sql4);
                    //Get the value
                    $row4 = mysqli_fetch_assoc($res4);
                    //Get the total Revenue
                    $total_revenue = $row4['total'];

                ?>
                <h1>$<?php echo $total_revenue;?></h1>
                <br>
                Revenue Generated
            </div>
            <div class="clearfix"></div>
        </div>
    </div>  
    <!-- Menu Content Ends -->

    <?php include('partials/footer.php');?>
    

