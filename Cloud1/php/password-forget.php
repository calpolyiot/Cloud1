<?php
require_once "Mail.php";
error_reporting(E_ALL & ~E_STRICT);
ini_set('display_errors', '1');
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
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   // Check if e-mail address syntax is valid or not
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      echo "Invalid Email Address!";
   }
   else {
      $result = $mysqli->query("SELECT firstName, lastName, username, " .
         "password FROM User WHERE email='$email'");

      if ($result->num_rows == 0) {
         echo "This email is not registered. Please register first.";
      }
      else {
         $row = $result->fetch_assoc();
         $from = "calpolyiot@gmail.com";
         $to = $email;

         $host = "ssl://smtp.gmail.com:465";
         $username = 'calpolyiot@gmail.com';
         $password = 'cloud1platform';

         $subject = "Cloud1 Forgotten Password";
         $body = "Hi " . $row["firstName"]. " " . $row["lastName"].
            ",\n\nYou seemed to have forgotten your password for Cloud1." .
            "\n\n\tUsername: " . $row["username"].
            "\n\tPassword: " . $row["password"].
            "\n\nYou can change it to a new password anytime by going to the" .
            " main site and clicking 'Reset password'.\n\n-Cloud1";

         $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
         $smtp = Mail::factory('smtp',
            array ('host' => $host,
            'auth' => true,
            'username' => $username,
            'password' => $password));

         $mail = $smtp->send($to, $headers, $body);

         if (PEAR::isError($mail)) {
           echo($mail->getMessage());
         } else {
           echo("Email successfully sent!\n" .
                "If it's not in your inbox, try checking the spam folder!");
         }
      }
   }
   $mysqli->close();
?>
