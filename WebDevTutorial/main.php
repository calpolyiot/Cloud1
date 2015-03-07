<?php session_start();
   if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
      header("Location: ./index.php");   
      exit;
   }
   // **TEST**
   //$message = $_SESSION['userDevices'][0]['type'];
   //echo "<script type='text/javascript'>alert('$message');</script>";
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
      <?php
         class Device{
            public $isPublic = false;
	    public $name;
            public $ip;
	    public $type;
           
            public function __construct($nam, $access, $adress, $sensor){
               $name = $nam;
	       $ip = $adress;
	       $type = $sensor;
               $isPublic = $access;
	    }
         }
      ?>

      <?php

	 $devices = array();
         //code to load in database
         mysql_connect("localhost", "secure", "") or die(mysql_error()); 
         mysql_select_db("cloud1_database") or die(mysql_error());

         //gets user devices
    
         $data = mysql_query("SELECT * FROM device") or die(mysql_error());
         while($info = mysql_fetch_array($data)){
	    $published = false;
	    if($user['id'] == $info['ownerId']){
		if(strcmp($info['access'],"private")!=0){
		   $published = true;
		}
		$devices[] = new Device($info['deviceName'],$published,$info['ip'],$info['type']);
	    }
	 }
      ?>
      <div id="sign-out"><a href="./php/logout.php" id="signout">Sign out?</a></div>
      <div id="body">
         <div id="device-column">
            <div class="devices" id="my-devices">
               <span class="device-header">My Devices</span>
               <img src="./img/IoTIcons/plus-50.png" class="button" id="button1">
               <hr>
               <ul>
	       <?php
		  for($i=0;$i<count($devices);$i++){
		     echo $devices[$i]->name." <br>";
		  } 
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
            <div class="devices">
               <span class="device-header">Public Devices</span>
               <img src="./img/IoTIcons/plus-50.png" class="button" id="button3">
               <hr>
               <ul>
               </ul>
            </div>
         </div>
         <div id="project-column">

            <label class="label">Master Device:</label><br/><br/>

            <div id="master-inputs">
               <select id="project-device-master" class="dropdown-text" name="selectAPI">
                  <option value="selectAPI">Select Device</option>
               </select>

               <div id="master-io" class="secret hidden-dropdown">
                  <select class="dropdown-text" name="Input/Output">
                     <option value="listInputs">Input/Output</option>
                     <option value="listInputs">Send</option>
                  </select>
               </div>

               <div class="secret hidden-dropdown">
                  <select class="dropdown-text" name="listOperators">
                     <option value="operators">List Operators</option>
                     <option value="and">Button Click</option>
                  </select>
               </div>

               <div id="master-io" class="secret hidden-dropdown">
                  <select class="dropdown-text" name="listOutputs">
                     <option value="listOutputs">List Outputs</option>
                     <option value="listOutputs">Binary</option>
                  </select>
               </div>
            </div>

            <br/><br/>

            <label class="label">Slave Device:</label><br/><br/>

            <div id="slave-inputs">
               <select id="project-device-slave" class="dropdown-text" name="selectAPI">
                  <option value="selectAPI">Select Device</option>
               </select>

               <div id="slave-io" class="secret hidden-dropdown">
                  <select class="dropdown-text" name="listInputs">
                     <option value="listInputs">Input/Output</option>
                     <option value="listInputs">Receive</option>
                  </select>
               </div>

               <div class="secret hidden-dropdown">
                  <select class="dropdown-text secret" name="listOperators">
                     <option value="operators">List Operators</option>
                     <option value="N/A">On/Off</option>
                  </select>
               </div>

               <div class="secret hidden-dropdown">
                  <select class="dropdown-text secret" name="listOutputs">
                     <option value="listOutputs">List Outputs</option>
                     <option value="N/A">N/A</option>
                  </select>
               </div>
            </div>

            <br/><br/>

            <span id="generate-code" class="submit-button">Generate Code</span>

            <div id="dialog" title="Add New Device">
               <form action="" method="post">
                  <label>Device Name:</label><br/>
                  <input type="text" id="name" name="name"><br/>
                  <label>Device Type:</label><br/>
                  <select id="device" class="dropdown-text">
                     <option value="selectAPI">Select API</option>
                     <option value="tempSensor">Temperature Sensor</option>
                     <option value="fbAccount">Facebook</option>
                  </select><br/>
                  <div id="ip-input">
                     <label>IP Address:</label><br/>
                     <input type="text" id="ip" name="ip"><br/>
                  </div>
                  <div id="fblogin" class="secret">
                     <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
                  </div>
                  <br/><span id="add-device" class="submit-button">Submit</span>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>
