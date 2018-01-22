<?php

//DB connection
$servername = "localhost";
$username = "padron";
$password = "padron";
$dbname = "pdb_ct";

$con = new mysqli($servername, $username, $password, $dbname);
if($con->connect_error){
  die("Connection:  FAILED  "  . $con->connect_error);
}

//Form variables
$expediente = $_POST['expediente'];
$fcaptura = $_POST['fcaptura'];
$fprevaloracion = $_POST['fprevaloracion'];
$rango = $_POST['rango'];
$enviado = $_POST['enviado'];
$name_1 = $_POST['name_1'];
$name_2 = $_POST['name_2'];
$name_3 = $_POST['name_3'];
$fnacimiento = $_POST['fnacimiento'];
$curp_1 = $_POST['curp_1'];
$curp_2 = $_POST['curp_2'];
$curp_3 = $_POST['curp_3'];
$curp_4 = $_POST['curp_4'];
$edad = $_POST['edad'];
$een = $_POST['een'];
$sexo = $_POST['sexo'];
$ecivil = $_POST['ecivil'];
$ocupacion = $_POST['ocupacion'];
$escolar = $_POST['escolar'];
$nacionalidad = $_POST['nacionalidad'];
$entidadnac = $_POST['entidadnac'];
$telefono = $_POST['telefono'];
$tvial = $_POST['tvial'];
$nvial = $_POST['nvial'];
$ninterior = $_POST['ninterior'];
$nexterior = $_POST['nexterior'];
$cp = $_POST['cp'];
$tasenta = $_POST['tasenta'];
$nasenta = $_POST['nasenta'];
$entidad = $_POST['entidad'];
$municipio = $_POST['municipio'];
$localidad = $_POST['localidad'];


//Merge variables to fit DB structure
//Merge all name fields and separate with a blank space
$nombre = array($name_1, $name_2, $name_3);
$ftd_nombre = implode(" ", $nombre);
$curp = $curp_1 . $curp_2 . $curp_3 . $curp_4;
$calle = array($tvial, $nvial);
$ftd_calle = implode(" ", $calle);
$colonia = array($tasenta, $nasenta);
$ftd_colonia = implode(" ", $colonia);


//SQL Query
$con->set_charset("utf8"); //Make sure we deal with special chars
$sql = "INSERT INTO pdb_test (expediente, fcaptura, fprevaloracion, rango, enviado, nombre, fnacimiento, curp, edad, een, sexo, ecivil, ocupacion, escolar, nacionalidad, entidadnac, telefono, calle, ninterior, nexterior, cp, colonia, entidad, municipio, localidad)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

//Prepare query
$stmt = $con->prepare($sql);
  if(false===$stmt) { //Error debugging for the prepare statement
    exit('prepare():  FAILED  '. htmlspecialchars($stmt->error));
  }

//Bing variables to query
$rc = $stmt->bind_param("sssssssssssssssssssssssss", $expediente, $fcaptura, $fprevaloracion, $rango, $enviado, $ftd_nombre, $fnacimiento, $curp, $edad, $een, $sexo, $ecivil, $ocupacion, $escolar, $nacionalidad, $entidadnac, $telefono, $ftd_calle, $ninterior, $nexterior, $cp, $ftd_colonia, $entidad, $municipio, $localidad);
  if(false===$rc){ //error debugging for the bind_param() statement
    die('bind_param():  FAILED  ' . htmlspecialchars($stmt->error));
  }

//Run the query
$rc = $stmt->execute();
  if(false===$rc){ //Error debugging for the statement execution
    die('execute():  FAILED  ' . htmlspecialchars($stmt->error));
  }

//Print variables
var_dump($_POST);

//Close
$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>

<body>
  <a href="../test.html">Back</a>
</body>
</html>
