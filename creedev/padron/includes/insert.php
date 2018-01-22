<?php
error_reporting(E_ALL ^ E_NOTICE);

  //Setting up the form variables
  $expediente = $_POST['expediente'];
  $fcaptura = $_POST['fcaptura'];
  $fprevaloracion = $_POST['fprevaloracion'];
  $rango = $_POST['rango'];
  $enviado = $_POST['enviado'];
  $nombre = $_POST['nombre'];
  $fnacimiento = $_POST['fnacimiento'];
  $curp = $_POST['curp'];
  $edad = $_POST['edad'];
  $een = $_POST['een'];
  $sexo = $_POST['sexo'];
  $ecivil = $_POST['ecivil'];
  $ocupacion = $_POST['ocupacion'];
  $escolar = $_POST['escolar'];
  $nacionalidad = $_POST['nacionalidad'];
  $entidadnac = $_POST['entidadnac'];
  $telefono = $_POST['telefono'];
  $calle = $_POST['calle'];
  $ninterior = $_POST['ninterior'];
  $nexterior = $_POST['nexterior'];
  $cp = $_POST['cp'];
  $colonia = $_POST['colonia'];
  $entidad = $_POST['entidad'];
  $municipio = $_POST['municipio'];
  $localidad = $_POST['localidad'];
  $servicios = $_POST['servicios'];
  $fconsulta = $_POST['fconsulta'];
  $dx = $_POST['dx'];
  $discapacidad = $_POST['discapacidad'];
  $dtemporal = $_POST['dtemporal'];
  $dlimitacion = $_POST['dlimitacion'];
  
  //Setting up DB connection
  $mysqli = new mysqli('localhost', 'padron', 'padron', 'pdb_ct');  
  if (mysqli_connect_errno()){ //Error debugging for DB Connection
    printf("Connection:  FAILED  ", mysqli_connect_error());
    exit;
  }
  
  //setting up the SQL query that will insert the form data into the DB
  $sql = "INSERT INTO pdb_test (`expediente`, `fcaptura`, `fprevaloracion`, `rango`, `enviado`, `nombre`, `fnacimiento`, `curp`, `edad`, `een`, `sexo`, `ecivil`, `ocupacion`, `escolar`, `nacionalidad`, `entidadnac`, `telefono`, `calle`, `ninterior`, `nexterior` ,`cp` ,`colonia`, `entidad`, `municipio`, `localidad`, `servicios`, `fconsulta`, `dx`, `discapacidad`, `dtemporal`, `dlimitacion`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
  //When using bind_param() all VALUES must use "?" as placeholder, they will later be bind to a specific string assigned to a variable from the html form
  
  //Preparing the SQL query
  $stmt = $mysqli->prepare($sql);
  if(false===$stmt) { //Error debugging for the prepare statement
    exit('prepare():  FAILED  '. htmlspecialchars($stmt->error));
  } 
  
  //Binding the variables. Here we replace the "?" in the sql query with the actual variables/strings posted from the html form
  $rc = $stmt->bind_param('sssssssssssssssssssssssssssssss', $expediente, $fcaptura, $fprevaloracion, $rango, $enviado, $nombre, $fnacimiento, $curp, $edad, $een, $sexo, $ecivil, $ocupacion, $escolar, $nacionalidad, $entidadnac, $telefono, $calle, $ninterior, $nexterior, $cp, $colonia, $entidad, $municipio, $localidad, $servicios, $fconsulta, $dx, $discapacidad, $dtemporal, $dlimitacion);
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
