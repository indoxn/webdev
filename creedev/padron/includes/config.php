<?php
  define("HOST", "localhost");
  define("USER", "padron");
  define("PASSWORD", "padron");
  define("DATABASE", "pdb_ct");

  $con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

  if($con === false){
    die("ERROR: Could not connect to database. " . mysqli_connect_error());
  }
?>