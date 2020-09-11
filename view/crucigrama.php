<?php
// Innicializar la sesion
session_start();
 
// Compruebe si el usuario ha iniciado sesión, de lo contrario, rediríjalo a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Crucigrama</title>
  
  
 <!--  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">

      <link rel="stylesheet" href="../css/style-game.css">

  
</head>

<body>
<div class="container">
      <?php require '../controller/header.php' ?>
<h1>Crucigrama, pon a prueba tus conocimientos!!!!</h1>
      <div id="app" class="container" @keyup.escape="selected = undefined">
  <div class="table-container" style="display:none;" v-show="true">
    <div class="timer">{{cronometro}}</div>
    <div class="mensaje" v-if="mensaje !== undefined">
      <div class="content">{{mensaje}}</div>
      <button @click="mensaje = undefined" class="btn btn-primary">OK</button>
    </div> 
    <table>
      <tr v-for="(row, y) in matrix" :key="y">
        <td v-for="(cell, x) in row" :class="{empty: cell.empty, start: !!cell.start, selected: cell.words.includes(selected)}" @click="selectWord(cell.start)">
          <label v-if="!!cell.start">{{cell.start}}</label>
          {{cell.words.some(i => completed[i]) ? cell.letter : ' '}}
        </td>
      </tr>
    </table>
    <div v-if="selected !== undefined" style="text-align: center;">
      <p class="pista" v-if="pista">
        {{pista}}
      </p>
      <input v-model="answer" ref="input" @keyup.enter="corregir"/>
      <button @click="corregir" class="btn btn-primary">Colocar</button>
      <button @click="solucion" class="btn btn-danger">Pista</button>
    </div>
    <hr>
    <button class="btn btn-block btn-primary" @click="finalizar">Finalizar</button>
  </div>  
  <h3 v-show="false">Cargando....</h3>
</div>
<!--Footer-->
<br>
<br>
<br>
<?php require '../controller/footer.php' ?>
</div>
  <script src='https://unpkg.com/vue'></script>
    <script  src="../js/index.js"></script>




</body>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
</html>