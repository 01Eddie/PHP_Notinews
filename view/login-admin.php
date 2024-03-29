<?php
// Initialize the session, cabe resaltar que tienes que ver como que tipoes, osea agregar un campo.
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../controller/logout.php");
    exit;
}
 
// Include config file
require_once "../model/config.php";
 
//Definir variables e inicializar con valores vacíos.
$username = $password = $type = "";
$username_err = $password_err = $type_err = "";
 
// Procesar datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su Email.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciales
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username,name, password, tipo FROM login_cliente WHERE username = ? ";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincula las variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Intentar ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                // Verifique si existe el nombre de usuario($username), en caso afirmativo, verifique la contraseña($password)
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $name, $hashed_password, $type);
                        if(mysqli_stmt_fetch($stmt)){
                        //   if($_POST['tipo'] == 1){
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                // Store data in session variables
                                 $_SESSION["loggedin"] = true;
                                 $_SESSION["id"] = $id;
                                 $_SESSION["username"] = $username;     
                                 $_SESSION["name"] = $name; 
                                 // Redirect user to welcome page
                                 header("location: ../model/table.php");
                                 exit;
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "La contraseña introducida no coincide.";
                            }
                        }
                }else{
                    // Display an error message if username doesn't exist
                    $username_err = "No existe esta cuenta.";
                }
            } else{
                echo "Ups! Algo salio mal. Intentelo mas tarde";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);
}
?>
 
<html>
<head>
   <meta charset="utf-8">
   <title>Login-Admin</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <script>
      $(document).ready(function()
      {
         $("#mostrarmodal").modal("show");
      });
    </script>
</head>
<body>
   <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <h3>Login-admin</h3>
           </div>
           <div class="modal-body">
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
                   
            </div>

        </form>
       </div>
           <div class="modal-footer">
           <?php //require '../controller/header.php' ?>
           <a href="index.php" class="btn btn-danger">Cerrar</a>
          <!--<a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>-->
           </div>
      </div>
   </div>
</div>
</body>
</html>