<?php
		require_once("funciones.php");

		// if (estaLogueado()) {
  	// 						header("Location:homeox.php");
		// 				}
		$arrayErrores = [];

if ($_POST) {

//Validar
  		$arrayErrores = validarLogin($_POST);

//Si es valido, loguear
  		if (count($arrayErrores) == 0) {
    									loguear($_POST["email"]);
											header("Location:../html/home.php");exit;
										}
										else {
											print_r($arrayErrores);
										}
    	if (isset($_POST["recordame"])) {
      									recordarUsuario($_POST["email"]);
    									}
  										}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>L o g i n || N@LU</title>
		<link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
		<link href="http://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/bienvenidos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
	</head>
	<body>
	<div class="registro">
    	<form action="" method="post">
      		<div class="user">
      			Email: <input type="email" name="email" value="" placeholder="Usuario">
      		</div>
      		<div class="pass">
      			Contraseña: <input type="password" name="pass" value="" placeholder="Contraseña">
      		</div>
      		<div class="login">
      			<button type="submit">Iniciar sesion</button>
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
          <h3>Novedades y Premios</h3>
          <p></p>
        </div>
  </div>

   <?php require_once ("footer.php"); ?>
