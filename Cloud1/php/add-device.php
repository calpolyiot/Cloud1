<?php session_start();
   $servername = "localhost";
   $username = "secure";
   $password = "";
   $dbname = "cloud1_database";

   // Create connection
   $mysqli = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($mysqli->connect_error) {
       die("Connection failed: " . $mysqli->connect_error);
   }
   
   $name = $_POST['name'];
   $endpoint = $_POST['endpoint'];
   $ownerId = $_SESSION['user']['id'];
/*   // checks for existing IP addresses
   $result = $mysqli->query("SELECT * FROM Device WHERE ip='$username'");
   $exIp = $result->num_rows;
   
   if (($exIp) > 0) {
      echo "There is already another registered device with the same IP address.";
   }
   else { */
      // date: Year-Month-Day (ex: 2001-01-31)
      $date = date("Y-m-d");
      // Insert query
      $query = $mysqli->query("INSERT INTO Device(deviceName, endpoint, dateAdded, ownerId) 
       VALUES ('$name', '$endpoint', '$date', '$ownerId')");
      
      if ($query) {
         echo "Device Successfully Added!";
      }
      else {
         echo "Database Error!";
      }
  //}
?>