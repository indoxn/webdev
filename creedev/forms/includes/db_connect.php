<?php
  define("HOST", "localhost");
  define("USER", "forms");
  define("PASSWORD", "forms");
  define("DATABASE", "forms");

  $con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

  if($con === false){
    die("ERROR: Could not connect to database. " . mysqli_connect_error());
  }
?>