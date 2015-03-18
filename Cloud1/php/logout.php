<?php
   session_start();
   if(session_destroy()) // Destroying All Sessions
   {
      $_SESSION['loggedIn'] = false;
      header("Location: /../index.php"); // Redirecting To Home Page
   }
?>