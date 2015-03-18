<?php session_start();
   $devices = $_SESSION['userDevices'];
   echo json_encode($devices);
?>