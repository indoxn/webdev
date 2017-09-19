<?php
    ini_set('display_errors', 1);
    //DB Connection
    $con = mysqli_connect('localhost', 'padron', 'padron', 'pdb_ct');
?>

<!doctype html>
<html>
        <head>
                <title>Padron | Búsqueda</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="initial-scale=1.0">
                <link rel="stylesheet" type="text/css" href="./resources/style.css">
        </head>

        <body>

        <div class="back-button">
                <p><a href="./index.html">Realizar otra búsqueda</a></p>
        </div>

       <div style="overflow-x:auto;">
        <table id="results">
            <tr>
                <th>Expediente</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>CURP</th>
            </tr>

        <?php
    $query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($con, "SELECT * FROM pdb
            WHERE (`nombre` LIKE '%".$query."%') OR (`expediente` LIKE '%".$query."%')");
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysqli_fetch_assoc($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                    echo "<tr>";
                    echo "<td>".$results['expediente']."</td>";
                    echo "<td>".$results['nombre']."</td>";
                    echo "<td>".$results['edad']."</td>";
                    echo "<td>".$results['curp']."</td>";
                    echo "</tr>";
             // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo '<div class="error">Paciente no registrado</div>';
        }
         
    }
    else{ // if query length is less than minimum
        echo '<div class="error">Escriba mas de '.$min_length.' letras</div>';
    }
?>
        </table>
	</div>

<?php

if(strlen($query) < $min_length) {
        echo '<div class="total">0 Expedientes</div>';
} else {
        echo '<div class="total">'.mysqli_num_rows($raw_results).' Expedientes</div>';
}
?>

	</body>
</html>
