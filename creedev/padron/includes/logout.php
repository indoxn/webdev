<?php
  //Initialize the session
session_start();
//Clear all session variables
$_SESSION = array();
//Destroy session
session_destroy();
//Redirect to login page
header("location: ../login.php");
exit;
?>