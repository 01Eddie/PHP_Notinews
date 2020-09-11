<?php
// Include config file
require_once "../model/config.php";
 
// Define variables and initialize with empty values
$username = $name = $lastname = $password = $confirm_password = "";
$username_err = $name_err = $lastname_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese los nombres";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM login_cliente WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este mail ya esta siendo usado";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Algo salio mal. Ingrese mas tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    //validate name o nickname
    if(empty(trim($_POST["name"]))){
        $name_err = "Ingrese su nombre por favor";     
    } elseif(strlen(trim($_POST["name"])) < 1){
        $name_err = "Usted tiene que poner su nombre";
    } else{
        $name = trim($_POST["name"]);
    }

    //validate lastname
    if(empty(trim($_POST["lastname"]))){
      $lastname_err = "Por favor ingrese su apellido.";     
    } elseif(strlen(trim($_POST["lastname"])) < 1){
      $lastname_err = "Usted tiene que agregar su apellido.";
    } else{
      $lastname = trim($_POST["lastname"]);
    }



    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su numero de tarjeta.";     
    } elseif(strlen(trim($_POST["password"])) < 1){
        $password_err = "Numero de tarjeta aun no ingresada";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirme su numero de tarjeta.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "El numero de tarjeta no coincidio.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($name_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO login_cliente (username, name, lastname, password) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_name, $param_lastname, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_name = $name;
            $param_lastname = $lastname;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Algo ocurrio, intente mas tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>
</head>
  <body style="background-color:rgba(177, 179, 71, 0.397);">
    <div class="container">
      <div class="container">
      <?php require '../controller/header.php' ?>
    <hr>
    
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="72" height="72">
    <h2>Desea comprar este diario</h2>
   
  </div>



  <div class="row">
    <div class="col-md-8 order-md-1">
      <form class="needs-validation"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nombre</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Nombres" required>
            <span class="help-block"><?php echo $name_err; ?></span>

            <div class="invalid-feedback">
              Tu nombre tiene que estar obligatoriamente
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Apellidos</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" placeholder="Apellidos" required>
            <span class="help-block"><?php echo $lastname_err; ?></span>

            <div class="invalid-feedback">
              Tu apellido tiene que estar obligatoriamente
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Obligatorio)</span></label>
          <input type="email" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="tu@ejemplo.com">
                <span class="help-block"><?php echo $username_err; ?></span>

          
        </div>

        <div class="mb-3">          
          <label>Numero de tarjeta</label>
          <input type="text" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Numero de tarjeta" required>
          <span class="help-block"><?php echo $password_err; ?></span>
           
        </div>

        <div class="mb-3">
          <label>Repetir numero de tarjeta</label>
          <input type="text" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Repetir numero de tarjeta">
          
        </div>          
        
        <hr class="mb-4">
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Quiero comprar este diario">
        <br><br>    
        <p>Ya tienes una cuenta? <a href="login.php">Login aqui</a>.</p>
      </form>
    </div>
    
      <!--Aqui iran las noticias -->
  
  <div class="col-md-4 order-md-2 mb-4">
      <form name="miform" id="miform">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted" style="text-align: center;">Noticias</span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"> <input name="id" id="clt" type="checkbox" value="6-abcd" onclick="sumar()" /> Actualidad</h6>
            <small class="text-muted">Todo sobre la actualidad peruana</small>
          </div>
          <span class="text-muted">$6</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><input name="id" id="clt" type="checkbox" value="8-abcd" onclick="sumar()" /> Deportes</h6>
            <small class="text-muted">Todo sobre deporte mundial</small>
          </div>
          <span class="text-muted">$8</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><input name="id" id="clt" type="checkbox" value="5-abcd" onclick="sumar()" /> Covid-19</h6>
            <small class="text-muted">Todo sobre esta pandemia</small>
          </div>
          <span class="text-muted">$5</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><input name="id" id="clt" type="checkbox" value="5-abcd" onclick="sumar()" /> Economìa</h6>
            <small class="text-muted">Todo sobre economia</small>
          </div>
          <span class="text-muted">$5</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total</span>
          <strong> <div id="informacion">$0</div></strong>
        </li>
      </ul>
       </form>
    </div>


    
   
 
  </div>  
  <!--Footer-->
  <?php require '../controller/footer.php' ?>
  
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!--
<script>
function sumar(){
    obj = document.miform['id'];
    totalChecks = obj.length;
    totalSumado = 0;
    for( i=0; i<totalChecks; i++){ 
        if( obj[i].checked == true ){
            valor = obj[i].value.split('-');        
            totalSumado = totalSumado + parseInt(valor[0],10);
        }
    }
    document.getElementById('informacion').innerHTML = '$'+ totalSumado; 
}
</script>-->
</body>
</html>
