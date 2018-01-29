<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

//Setting up variables
$fname = isset($_POST['fname']);
$lname1 = isset($_POST['lname1']);
$lname2 = isset($_POST['lname2']);
$age = isset($_POST['age']);
$sex = isset($_POST['sex']);
$academic = isset($_POST['academic']);
$diploma = isset($_POST['diploma']);
$profesion = isset($_POST['profesion']);
$school = isset($_POST['school']);
$ubr = isset($_POST['ubr']);
$title = isset($_POST['_title']);
$jobtype = isset($_POST['jobtype']);
$jobdate = isset($_POST['jobdate']);
$tvial = isset($_POST['tvial']);
$nvial = isset($_POST['nvial']);
$nextvial = isset($_POST['nextvial']);
$nintvial = isset($_POST['nintvial']);
$tasent = isset($_POST['tasent']);
$nasent = isset($_POST['nasent']);
$cpostal = isset($_POST['cpostal']);
$localidad = isset($_POST['localidad']);
$municipio = isset($_POST['_municipio']);
$phoneubr = isset($_POST['phoneubr']);
$phonextubr = isset($_POST['phonextubr']);
$phonepersonal = isset($_POST['phonepersonal']);
$emailubr = isset($_POST['emailubr']);
$presdif = isset($_POST['presdif']);
$dirdif = isset($_POST['dirdif']);
$phonedif = isset($_POST['phonedif']);
$emaildif = isset($_POST['maildif']);

//DB Connection
$mysqli = new mysqli('localhost', 'forms', 'forms', 'forms');
if (mysqli_connect_errno()) {
  printf("Connection   FAILED  ", mysqli_connect_errno());
  exit;
}

//Insert query
$sql = "INSERT INTO ubr (`fname`, `lname1`, `lname2`, `age`, `sex`, `academic`, `diploma`, `profesion`, `school`, `ubr`, `title`, `jobtype`, `jobdate`, `tvial`, `nvial`, `nextvial`, `nintvial`, `tasent`, `nasent`, `cpostal`, `localidad`, `municipio`, `phoneubr`, `phonextubr`, `phonepersonal`, `emailubr`, `presdif`, `dirdif`, `phonedif`, `emaildif`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

print_r($_POST);
  //Preparing the SQL query
  $stmt = $mysqli->prepare($sql);
  if(false===$stmt) { //Error debugging for the prepare statement
    exit('prepare():  FAILED  ' . htmlspecialchars($stmt->error));
  } 
//Bind variables.
  $rc = $stmt->bind_param('ssssssssssssssssssssssssssssss', $fname, $lname1, $lname2, $age, $sex, $academic, $diploma, $profesion, $school, $ubr, $title, $jobtype, $jobdate, $tvial, $nvial, $nextvial, $nintvial, $tasent, $nasent, $cpostal, $localidad, $municipio, $phoneubr, $phonextubr, $phonepersonal, $emailubr, $presdif, $dirdif, $phonedif, $emaildif);
  if(false===$rc){ //error debugging for the bind_param() statement
    die('bind_param():  FAILED  ' . htmlspecialchars($stmt->error));
  }
//Execute the query
  $rc = $stmt->execute();
  if(false===$rc){ //Error debugging for the statement execution
    die('execute():  FAILED  ' . htmlspecialchars($stmt->error));
  }

  $stmt->close();
  $mysqli->close();
?>