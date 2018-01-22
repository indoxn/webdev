<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<?php
ini_set('display_errors', 1);
require_once './includes/config.php';

$query = $_GET['query']; 
// gets value sent over search form
$min_length = 3;
// you can set minimum length of the query if you want
$raw_results = mysqli_query($con, "SELECT * FROM pdb
WHERE (`nombre` LIKE '%".$query."%') OR (`expediente` LIKE '%".$query."%')");
// * means that it selects all fields, you can also write: `id`, `title`, `text`
// articles is the name of our table         
// '%$query%' is what we're looking for, % means anything, for example if $query is Hello
// it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
// or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'     
?>
    <!doctype html>
    <html>

    <head>
      <title>Padron | Resultados</title>
      <meta charset="utf-8">
      <meta name="viewport" content="initial-scale=1.0">
      <link rel="shortcut icon" href="./resources/img/favicon.ico" />
      <link rel="stylesheet" type="text/css" href="./resources/style.css">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script type="text/javascript" src="./resources/js/tableExport.js"></script>
      <script type="text/javascript" src="./resources/js/jquery.base64.js"></script>
      <script type="text/javascript" src="./resources/js/FileSaver.js"></script>
      </head>

    <body>
<!-----------------------------    BUTTONS   --------------------------------------------------->
      <div class="button" id="button-back">
        <a href="./index.php">Realizar otra búsqueda</a>
      </div>
      <div class="button" id="button-total">
        <?php
        if(strlen($query) < $min_length) {
        echo '<div class="total">0 Expedientes</div>';
        } else {
        echo '<div class="total">'.mysqli_num_rows($raw_results).' Expedientes</div>';
        }
        ?> 
      </div>
      <div class="button" id="button-export">
        <a href="#" onClick ="$('#results').tableExport({type:'excel',escape:'false'});">XLS</a>  
      </div>
      <div class="logout">
        <div><a href="includes/logout.php">Salir</a></div>
      </div>
<!-----------------------------    TABLE  --------------------------------------------------->
      <div style="overflow-x:auto;">

        <table name="creet_padron" id="results">
          <thead>
          <tr>
            <th>Expediente</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>CURP</th>
          </tr>
          </thead>
      <?php
        if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
          
         while($results = mysqli_fetch_assoc($raw_results)){
         // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                echo "<tbody>";
                echo "<tr>";
                echo "<td>".$results['expediente']."</td>";
                echo "<td>".$results['nombre']."</td>";
                echo "<td>".$results['edad']."</td>";
                echo "<td>".$results['curp']."</td>";
                echo "</tr>";
                echo "</tbody>";
             // posts results gotten from database(title and text) you can also show id ($results['id'])
            }         
        } else { // if there is no matching rows do following
            echo '<div class="error">Paciente no registrado</div>';
        }
    } else { // if query length is less than minimum
        echo '<div class="error">Escriba mas de '.$min_length.' letras</div>';
    }
      ?>
        </table>
      </div>
      
    </body>
    </html>