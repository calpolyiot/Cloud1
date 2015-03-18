<?php session_start();
   if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
      header("Location: ./index.php");   
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
      <link rel="stylesheet" href="./css/main.css">

      <link href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
      <script type="text/javascript" src="./js/main.js"></script>
   </head>

   <body>
      <!--class to store devices-->
      <div id="sign-out"><a href="./php/logout.php" id="signout">Sign out?</a></div>
      <div id="body">
         <div id="device-column">
            <div class="devices" id="my-devices">
               <span class="device-header">My Devices</span>
               <img src="./img/IoTIcons/plus-50.png" class="button" id="button1">
               <hr>
               <ul id="list">
                  <?php
                     //for($i = 0; $i < $_SESSION['deviceCount']; $i++) {
                           //echo "<li>";
                           //echo $_SESSION['userDevices'][$i];
                           //echo "</li>";
                     //}
                  ?>
               </ul>
            </div>
            <div class="devices">
               <span class="device-header">My Shared Devices</span>
               <img src="./img/IoTIcons/plus-50.png" class="button" id="button2">
               <hr>
               <ul>
               </ul>
            </div>
         </div>
         <div id="project-column">

            <label class="label">Device:</label><br/><br/>

            <div id="master-inputs">
               <select id="project-device-master" class="dropdown-text" name="selectAPI">
                  <option value="selectAPI">Select Device</option>
                  <?php
                     //for($i = 0; $i < $_SESSION['deviceCount']; $i++) {
                           //echo "<option value='";
                           //echo $_SESSION['userDevices'][$i];
                           //echo "'>";
                           //echo $_SESSION['userDevices'][$i];
                           //echo "</option>";
                     //}
                  ?>
               </select>
            </div>

            <br/><br/>

            <label class="label">Sensor:</label><br/><br/>

            <div id="slave-inputs">
               <select id="sensors" class="dropdown-text" name="selectAPI">
                  <option value="selectAPI">Select Device</option>
                  <?php
                     //for($i = 0; $i < $_SESSION['deviceCount']; $i++) {
                           //echo "<option value='";
                           //echo $_SESSION['sensors'][$i];
                           //echo "'>";
                           //echo $_SESSION['sensors'][$i];
                           //echo "</option>";
                     //}
                  ?>
               </select>
            </div>

            <br/><br/>

            <span id="generate-code" class="submit-button">Submit</span>

            <div id="dialog" title="Add New Device">
               <form action="" method="post">
                  <label>Device Name:</label><br/>
                  <input type="text" id="name" name="name"><br/>
                  <div id="ip-input">
                     <label>Endpoint:</label><br/>
                     <input type="text" id="endpoint" name="endpoint"><br/>
                     <label>Sensor Name:</label><br/>
                     <input type="text" id="sensor-name" name="sensor-name"><br/>
                  </div>
                  <!--<div id="fblogin" class="secret">
                     <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
                  </div>-->
                  <br/><span id="add-device" class="submit-button">Submit</span>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>
