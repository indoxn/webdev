<?php
require_once './includes/config.php';

//Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  //Check if username is empty
  if(empty(trim($_POST["username"]))){
    $username_err = 'Escribe tu nombre usuario';
  } else{
    $username = trim($_POST["username"]);
  }
  
  //Check if password is empty
  if(empty(trim($_POST['password']))){
    $password_err = 'Escribe tu contraseña';
  } else{
    $password = trim($_POST['password']);
  }
  
  //Validate credentials
  if(empty($username_err) && empty($password_err)){
    //Prepare a select statement
    $sql = "SELECT username, password FROM users WHERE username = ?";
    
    if($stmt = mysqli_prepare($con, $sql)){
      //Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      //set parameters
      $param_username = $username;
      //Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
        //Store result
        mysqli_stmt_store_result($stmt);
        //Check if username exists, if so verify password
        if(mysqli_stmt_num_rows($stmt) == 1){
          //Bind results variable
          mysqli_stmt_bind_result($stmt, $username, $hashed_password);
          
          if(mysqli_stmt_fetch($stmt)){
            if(password_verify($password, $hashed_password)){
              //If password verified, start new session under username
              session_start();
              $_SESSION['username'] = $username;
              header("location: buscar.php");
            } else{
              //display an error message if username doesn't exist
              $password_err = 'Contraseña no válida';
            }
          }
        } else{
          //Display an error message if username doesn't exist
          $username_err = 'El usuario no existe';
        }
      } else{
        echo "Ooops! Algo salió mal. Por favor intenta de nuevo más tarde.";
      }
    }
    //Close statement
    mysqli_stmt_close($stmt);
  }
  //Close connection
  mysqli_close($con);
}
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Padron | Ingreso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="shortcut icon" href="./resources/img/favicon.ico" />
    <style type="text/css">
      body {
        font: 14px sans-serif;
      }
      
      .wrapper {
        width: 350px;
        padding: 20px;
      }

    </style>
  </head>

  <body>
    <div class="wrapper">
      <h2>Padrón de Beneficiarios</h2>
      <p>Escribe los datos de acceso.</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <label>Usuario:<sup>*</sup></label>
          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
          <label>Contraseña:<sup>*</sup></label>
          <input type="password" name="password" class="form-control">
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Ingresar">
        </div>
        <p></p>
      </form>
    </div>
  </body>

  </html>
