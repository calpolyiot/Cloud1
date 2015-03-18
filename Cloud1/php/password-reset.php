<?php
   $servername = "localhost";
   $username = "secure";
   $password = "";
   $dbname = "cloud1_database";
   // Establishing Connection with Server
   $mysqli = new mysqli($servername, $username, $password, $dbname);
   if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
   }
   // Fetching Values from URL
   $email = $_POST['email'];
   $oldPassword = $_POST['oldPassword'];
   $newPassword = $_POST['newPassword'];
   $cNewPassword = $_POST['cNewPassword'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   // Check if e-mail address syntax is valid or not
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      echo "Invalid Email!";
   }
   else{
      // checks for existing usernames
      //$result = $mysqli->query("SELECT * FROM User WHERE username='$username'");
      //$exUsername = $result->num_rows;
      // checks for existing email addresses
      $result = $mysqli->query("SELECT * FROM User WHERE email='$email'");
      $exEmail = $result->num_rows;

      $result = $mysqli->query("SELECT * FROM User WHERE email='$email' AND password='$oldPassword'");
      $exPassword = $result->num_rows;

      /*if(($exUsername) > 0) {
         echo "This username is already being used. Please try another username.";
      }*/
      if (($exEmail) == 0) {
         echo "Your email/password combination is incorrect.";
      }
      else if(($exPassword == 0)) {
         echo "Your email/password combination is incorrect.";
      }
      else {
         // date: Year-Month-Day (ex: 2001-01-31)
         $date = date("Y-m-d");
         // Insert query
         $query = $mysqli->query("UPDATE User SET password = '$newPassword' WHERE email = '$email';");
         
         if ($query) {
            echo "Password Reset Success!";
         }
         else {
            echo "Database Error!";
         }
      }
   }
   $mysqli->close();
?>
