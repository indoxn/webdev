<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <title>Padrón | Búsqueda</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="./resources/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./resources/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"> </head>

  <body>
    <header>
      <nav>
        <div class="row"> <img src="resources/img/creetepic_header.png" alt="logo CREE Tepic" class="logo" /> </div>
      </nav>
    </header>
    <div class="intro">
      <h3>Búsqueda de expedientes registrados</h3>
      <p>Ingrese el nombre del usuario o el número de expediente:</p>
      <form id="search" action="search.php" method="GET">
        <input type="text" name="query" title="Nombre o Expediente" placeholder="Nombre o Expediente ..." />
        <input type="submit" value="Buscar" /> </form>
    </div>
    <div class="logout">
      <div><a href="includes/logout.php">Salir</a></div>
    </div>
  </body>

  </html>
