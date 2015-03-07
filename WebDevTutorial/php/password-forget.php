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
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   // Check if e-mail address syntax is valid or not
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      echo "Invalid Email!";
   }
   else {
      echo "Change0 ";
      $result = $mysqli->query("SELECT password FROM User WHERE email='$email'");
      $exEmail = $result->num_rows;
      echo "Change2 ";

      if (($exEmail) == 0) {
         echo "This email is incorrect. Please register first.";
      }
      else {
         // Insert query
         $emailSubject = "Cloud1 Password Email!";
         $mailto = $email;
         $body = <<<EOD
            <br><hr><br>
            Hi! <br>
            You seemed to have forgotten your password. <br>
            Here is your password: Incorrect <br>
            Don't forget your password! <br>
EOD;

         $headers = "From: $email\r\n"; // This takes the email and displays it as who this email is from.
         $headers .= "Content-type: text/html\r\n"; // This tells the server to turn the coding into the text.
         //$success = mail($mailto, $emailSubject, $body, $headers); // This tells the server what to send.

         $message = "Line 1\r\nLine 2\r\nLine 3";
         $message = wordwrap($message, 70, "\r\n");
         $success = mail('amendira@calpoly.edu', 'Test subject', 'Test message');

         if ($success) {
            echo "Email sent!";
         }
         else {
            echo "Database Error!";
         }
      }
   }
   $mysqli->close();
?>
