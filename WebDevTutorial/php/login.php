<?php session_start();
   // define variables and set to empty values
   $name = $pass = "";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = test_input($_POST["Username"]);
     $pass = test_input($_POST["Password"]);
   }

   function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }

   $servername = "localhost";
   $username = "secure";
   $password = "";
   $dbname = "cloud1_database";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   $query = "SELECT * FROM User WHERE username='$name' AND password='$pass'";
   $result = $conn->query($query);

   if ($result->num_rows != 0) {
      $user = $result->fetch_assoc();
      $userDevices = $conn->query("SELECT Device.* FROM Device, User WHERE username='$name' AND User.id=ownerId");
      $_SESSION['loggedIn'] = true;
      $_SESSION['user'] = $user;
      $_SESSION['deviceCount'] = $userDevices->num_rows;
      for ($i = 0; $i < $userDevices->num_rows; $i++) {
         $_SESSION['userDevices'][$i] = $userDevices->fetch_assoc();
      }
      
      echo "Login Success!";
      $conn->close();
      exit;
   }
   echo "Invalid Username/Password.";
   $conn->close();
?>