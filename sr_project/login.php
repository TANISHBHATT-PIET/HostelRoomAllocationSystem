<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <title>Document</title>
</head>
<body>
 <?php
      // Database connection details
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "hras";

      // Create a new database connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check the connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve the submitted username and password
        $submittedUsername = $_POST["email"];
        $submittedPassword = $_POST["password"];
       

        // Check if the email domain is allowed
        if (strpos($submittedUsername, "@poornima.org") !== false) {
          // Email domain is allowed
          // Proceed with the login logic

          // Prepare and execute the SQL query to check if the user exists
          $stmt = $conn->prepare("SELECT * FROM login WHERE email = ?");
          $stmt->bind_param("s", $submittedUsername);
          $stmt->execute();

          $result = $stmt->get_result();

          if ($result->num_rows == 1) {
            // User found, verify the password
            $row = $result->fetch_assoc();
            $storedPassword = $row["password"];

            if ($submittedPassword === $storedPassword) {
              // Password is correct, log in the user
              session_start();
              $_SESSION["username"] = $submittedUsername;
              if ($keepSignedIn) {
                // Set a long session expiration time (e.g., 30 days)
                ini_set('session.cookie_lifetime', 30 * 24 * 60 * 60);
              }
              // Redirect to the home page
              header("Location: nsp.php");
              exit();
            } else {
              // Password is incorrect
              $errorMessage = '<br><center><span style="color:black;"> Invalid password </center>';
            }
          } else {
            // User not found
            $errorMessage = '<br><center><span style="color:black;"> Invalid username or password </center> ';
          }

          // Close the prepared statement
          $stmt->close();
        } else {
          // Email domain is not allowed
         echo '<span style="color:white;"> invalid address';
        }
      }

      // Close the database connection
      $conn->close();
?>



        <div class="log">
            <form method="Post"> 
                <p>Login</p>    
                       
            <input class="inlog_1" type="text" name="email" placeholder="Email address or Phone Number">
            <input class="inlog_2" type="password" name="password" placeholder="Password">
            <button class="inlog_3" type="submit" value="login" name="login" >Log in</button><br>
            <div class="inlog_4"><a href="#">Forgetten password?</a></div>
        </form>
        </div>
    
</body>
</html>