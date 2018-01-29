<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$fname = "";
$lname1 = "";
$errors = array();

$db = mysqli_connect('localhost', 'forms', 'forms', 'forms');

if (isset($_POST['register'])) {
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname1 = mysqli_real_escape_string($db, $_POST['lname1']);
  
  if (empty($fname)) { array_push($errors, "Nombre vacio");}
  if (empty($lname1)) { array_push($errors, "Apellido vacio");}
  
  if (count($errors) == 0) {
    $query = "INSERT INTO ubr (fname, lname1) VALUES ('$fname', '$lname1');";
    mysqli_query($db, $query);
  }
  
}
?>