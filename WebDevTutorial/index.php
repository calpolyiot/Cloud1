<?php session_start();
   if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
      header("Location: ./main.php");
      exit;
   }
?>

<!DOCTYPE html>

<html lang="en-US">

   <head>

      <title>Cloud1</title>

      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <link rel="stylesheet" href="./css/global-styles.css">
      <link rel="stylesheet" href="./css/index.css">
      
      
      <link href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    
      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
      <script type="text/javascript" src="./js/login.js"></script>

   </head>

   <body>
      <noscript>
         <div id="noscript">
            Please enable Javascript. This website will not function with javascript disabled.
         </div>
      </noscript>

      <div id="login-box">
         <div id="invalid-user">
            <p>Invalid Username</p>
            <p>Usernames must be between 3-24 characters long and contain only alphanumeric characters</p>
         </div>
         <div id="invalid-pass">
            <p>Invalid Password</p>
            <p>Passwords must be between 5-24 characters long and contain only alphanumeric characters</p>
         </div>
         <div>
            <h1>Cloud1</h1>
            <img id="header-icon" src="./img/logo1.png" alt="Project Logo">
         </div>
         <form method="post" id="login-form" name="login-form">
            <div id="left-block" class="form-block">
            <label> Username </label>
            <input id="user" class="input" type="text" name="Username">
            </div>
            <div class="form-block">
            <label> Password </label>
            <input id="pass" class="input" type="password" name="Password">
            </div>
            <a class="links" id="pass-reset" href="./password-reset.html">Reset Password</a>
            <a class="links" id="register" href="./register.html">Register</a>
            <a class="links" id="pass-forget" href="./password-forget.html">Forget Password?</a>
            <div id="loginDiv">
               <input id="login" type="button" value="Login">
               <!--<span id="submit-text">Login</span>-->
            </div>
         </form>
      </div>
   </body>

</html>
