<?php
error_reporting(E_ALL ^ E_NOTICE);

//Setting up variables
$fname = $_POST['fname'];
$lname1 = $_POST['lname1'];
$lname2 = $_POST['lname2'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$academic = $_POST['academic'];
$diploma = $_POST['diploma'];
$profesion = $_POST['profesion'];
$school = $_POST['school'];
$ubr = $_POST['ubr'];
$title = $_POST['title'];
$jobtype = $_POST['jobtype'];
$jobdate = $_POST['jobdate'];
$tvial = $_POST['tvial'];
$nvial = $_POST['nvial'];
$nextvial = $_POST['nextvial'];
$nintvial = $_POST['nintvial'];
$tasent = $_POST['tasent'];
$nasent = $_POST['nasent'];
$cpostal = $_POST['cpostal'];
$localidad = $_POST['localidad'];
$municipio = $_POST['municipio'];
$phoneubr = $_POST['phoneubr'];
$phonextubr = $_POST['phonextubr'];
$phonepersonal = $_POST['phonepersonal'];
$emailubr = $_POST['phonepersonal'];
$presdif = $_POST['presdif'];
$dirdif = $_POST['dirdif'];
$phonedif = $_POST['phonedif'];
$emaildif = $_POST['emaildif'];

//DB Connection
$mysqli = new mysqli('localhost', 'forms', 'forms', 'forms');
if (mysqli_connect_errno()) {
  printf("Connection   FAILED  ", mysqli_connect_errno());
  exit;
}

//Insert query
$sql = "INSERT INTO ubr ('fname', 'lname1', 'lname2', 'age', 'sex', 'academic', 'diploma', 'profesion', 'school', 'ubr', 'title', 'jobtype', 'jobdate', 'tvial', 'nvial', 'nextvial', 'nintvial', 'tasent', 'nasent', 'cpostal', 'localidad', 'municipio', 'phoneubr', 'phonextubr', 'phonepersonal', 'emailubr', 'presdif', 'dirdif', 'phonedif', 'emaildif') VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,)
)";

  //Preparing the SQL query
  $stmt = $mysqli->prepare($sql);
  if(false===$stmt) { //Error debugging for the prepare statement
    exit('prepare():  FAILED  '. htmlspecialchars($stmt->error));
  } 

//Bind variables.
  $rc = $stmt->bind_param('sssssssssssssssssssssssssssss', $fname, $lname1, $lname2, $age, $sex, $academic, $diploma, $profesion, $school, $title, $jobtype, $jobdate, $tvial, $nvial, $nextvial, $nintvial, $tasent, $nasent, $cpostal, $localidad, $municipio, $phoneubr, $phonextubr, $phonepersonal, $emailubr, $presdif, $dirdif, $phonedif, $emaildif);
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

?>
