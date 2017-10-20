<?php 
    require_once("funciones.php");


    /*if (estaLogueado()) {
                header("Location:home.php");
            }
    */


$arrayErrores = [];
if ($_POST) {

  //Validar
  $arrayErrores = validarLogin($_POST);

  //Si es valido, loguear
  if (count($arrayErrores) == 0) {
    loguear($_POST["email"]);
    if (isset($_POST["recordame"])) {
      recordarUsuario($_POST["email"]);
    }
    header("Location:homeOX.php");exit;
  }
}

     
?>
<!DOCTYPE html>
<html>
  <head>
    <title>L o g i n || N@LU</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="http://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
  </head>
  <body>
  <header>
    <div class="logo">
      <a href="homeOX.php"><img src="../imagenes/flor.png" alt="" "></a>
    </div>
  </header>
  <div class="registrologin">
    <?php if (count($arrayErrores) > 0) : ?>
        <ul style="color:red">
          <?php foreach($arrayErrores as $error) : ?>
            <li><?=$error?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <form action="" method="post">
          <div class="user">
            Email:        <input type="text" name="email" value="" placeholder="Usuario">
          </div>
          <div class="pass">
            Contraseña: <input type="password" value="" name="password" placeholder="Contraseña">
          </div>
          <div class="ingreso">
            <button class="login" type="submit">Iniciar sesion</button>
            <div class="record">
              Recordarme <input type="checkbox" name="recordame" value="recordame">
            </div>
          </div>
      </form>
    </div>
  <div class="box">
        <div class="infopromo">
          <img src="" alt="">
          <h1></h1>         
          <h3></h3>
          <p></p>
        </div>
  </div>
<?php require_once ("footer.php"); ?>