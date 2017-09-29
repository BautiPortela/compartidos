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
    	header("Location:home.php");exit;
  										}
			}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>L o g i n || N@LU</title>
		<link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
		<link href="http://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
	</head>
	<body>
	<div class="registro">
    	<form>
      		<div class="user">
      			Usuario: <input type="text" name="" value="" placeholder="Usuario">
      		</div>
      		<div class="pass">
      			Contraseña: <input type="password" value="" placeholder="Contraseña">
      		</div>
      		<div class="login">
      			<button type="submit">Iniciar sesion</button>
	      		<div class="record">
	        		Recordarme <input type="checkbox">
	      		</div>
      		</div>
    	</form>
  	</div>
	</body>
</html>