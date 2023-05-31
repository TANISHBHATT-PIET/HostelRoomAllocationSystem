<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $insert = false;
    if(isset($_POST['form-submit'])){
        // Set connection variables
        $server = "localhost";
        $username = "root";
        $password = "";
    
        // Create a database connection
        $con = mysqli_connect($server, $username, $password);
    
        // Check for connection success
        if(!$con){
            die("connection to this database failed due to" . mysqli_connect_error());
        }
        // echo "Success connecting to the db";
    
        // Collect post variables
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
         $email = $_POST['email'];
         $reg = $_POST['reg'];
       $number = $_POST['number'];
       $choose = $_POST['choose'];
        $hy = "INSERT INTO `hras`.`plan` (`fname`, `lname`, `email`, `reg`, `number`, `choose`) VALUES ('$fname', '$lname', '$email', '$reg', '$number', '$choose');";
        // echo $sql;
    
        // Execute the query
        if($con->query($hy) == true){
            // echo "Successfully inserted";
    
            // Flag for successful insertion
            $insert = true;
        }
        else{
            echo "ERROR: $hy <br> $con->error";
        }
    
        // Close the database connection
        $con->close();
    }
    ?>
    
    <form method="POST">
        <div class="rmbk">
            <p class="rmbk_1">Booking Form</p>
            <input class="rmbk_2" type="email" name="email" placeholder="Email address">
            <input class="rmbk_3" type="text" name="fname" placeholder="First Name">
            <input class="rmbk_4" type="text" name="lname" placeholder="Last Name">
            <input class="rmbk_5" type="text" name="reg" placeholder="Registration No.">
            <input class="rmbk_6" type="number" name="number" placeholder="Phone No.">
            <p class="rmbk_7">Select plan</p>
            <select class="rmbk_8" name="choose">
                <option value="a">Plan-A</option>
                <option value="b">Plan-B</option>
                <option value="c">Plan-C</option>
                <option value="d">Plan-D</option>
            </select><br><br>
            <hr>
            <input class="rmbk_9" name="form-submit"  type="submit" value="Submit" >
        </div>
</div>
</form>
    
</body>
</html>