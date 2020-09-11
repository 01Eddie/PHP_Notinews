
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cv</title>

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
    <?php require '../controller/header.php' ?>
    <hr>

<hr><br><br>
    <form  name="form1" action="" method="post" id="formulario">
        <fieldset>
            <legend>Formulario de solicitud de empleo</legend>
            <p>Gracias por su interés en trabajar con nosotros. Por favor observe aquí abajo las oportunidades laborales que se adapten a sus criterios y envíe su petición completando este formulario de solicitud de empleo.</p>
            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                <div class="col-md-8">
                <input id="fname" name="name" type="text" placeholder="Nombres" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                <div class="col-md-8">
                <input id="lname" name="name" type="text" placeholder="Apellidos" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                <div class="col-md-8">
                <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                </div>                
            </div>

            <div class="form-group">
                <div class="col-md-8">
                
            <p>Edad: <input type="number" name="txtedad" min="15" max="60">   Fecha de Nacimiento: <input type="date" name="txtfecha"></p>
        </div>
        </div><br>
            <hr><br>
            
            
                
        
        <fieldset>
            <legend>Informacion Academica</legend>
            <div class="col-md-8">
            <label>Carrera Profesional: <select name="cbCar">
                <option>Ingenieria de Sistemas</option>
                <option>Ingenieria de Software</option>
                <option>Periodismo</option>
                <option>Fotografo</option>
                <option>Seguridad</option>
                <option>editor</option>
                <option>marketing</option>
            </select>
        </label>
        
        <p>Enlace del Cv: <input type="url" name="txturl" required></p>                                       
        <p>Carga de CV: <input type="file" name="txtarchivo" id=""></p></div>
        </fieldset>
        <fieldset>
            <legend>Otros datos:</legend>
            <div class="col-md-8">
            <p>Hobbies</p>
            <p><input type="checkbox" name="chhobbies"><-- Ver TV</p>
            <p><input type="checkbox" name="chhobbies"><-- Leer</p>
            <p><input type="checkbox" name="chhobbies"><-- Pasear</p></div>
        </fieldset>
    </fieldset>
    <button class="btn btn-primary" type="submit">Enviar</button>

    </form>
    

     <!--Footer-->
     <?php require '../controller/footer.php' ?>

</div>



<script>
    var formulario = document.getElementById('formulario');

    formulario.alert('submit', function (e) {
        e.preventDefault();
        console.log('Archivo enviado')
    })

</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>