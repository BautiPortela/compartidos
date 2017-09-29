<?php session_start(); ?>
<!DOCTYPE html>
<?php require_once("funciones.php"); ?>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Original+Surfer" rel="stylesheet">
		<link rel="stylesheet" href="../css/registro.css">
		<style>@import url('https://fonts.googleapis.com/css?family=Raleway');</style>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>R e g i s t r o</title>
	</head>
	<body>
		<header>
			<div class="logo">
				<a href="home.html"><img src="../imagenes/flor.png" alt=""></a>
			</div>
		</header>
		<div class="container">
			<?php
			/*Pregunta si se envio data, sino se envio pone en null los valores para q no de error en form*/
			if (empty($_POST)) {
				$nombrelleno = null;
				$apellidolleno = null;
				$userlleno = null;
				$emaillleno = null;
			}
			/*Si hay data envia los datos a variables para q persista en form cuando el server hace validacion*/
			if ($_POST){
				$nombrelleno=$_POST["nombre"];
				$apellidolleno=$_POST["apellido"];
				$userlleno=$_POST["user"];
				$emaillleno=$_POST["email"];
			/*Manda la info a arrayDeErrores para ver si es necesario mostrar errores de carga de datos al user*/
				$arrayDeErrores = validarInfo($_POST);
				if (empty($arrayDeErrores)) {
						creaUsuario($_POST);
					/*Guardamos foto solo porque no hay errores*/
					$nombreDeLaFoto = $_FILES["foto-perfil"]["name"];
					$archivo = $_FILES["foto-perfil"]["tmp_name"];
					$extension = pathinfo($nombreDeLaFoto, PATHINFO_EXTENSION);
					$location = '/upload/';
					$nombre = dirname(__FILE__) . "/img/" . $_POST["email"] . ".$extension";

					move_uploaded_file($archivo, $nombre);
				}
				else {
					$arrayDeErrores = validarInfo($_POST);
					/*Como hay errores de carga hace echo en pantalla de cada error acumulando el de password
					De esta forma muestra todos los errores de password juntos para q sea mas facil Usar
					una password correcta mucho mas rapido*/
					foreach ($arrayDeErrores as $key => $value) {
						if ($key == "password") {
							for ($i=0; $i<count($arrayDeErrores["password"]); $i++) {
								echo "<br>";?>
								<!--Esto se deberia hacer en CSS lo hice aca para q sea mas visible porque cambia de color -->
								<span style="color:yellow;"><?php echo $arrayDeErrores["password"][$i]; ?></span>
								<?php echo "<br>";
							}
						}
						else { ?>
							<span style="color:cyan;"> <?php echo "<br>"; echo ($value); echo "<br>";?></span>
							<?php
						}
					}
				}
			}
			echo "<br>";
			?>
			<div class="main">
				<form action="" method="post" enctype="multipart/form-data">
						<legend>Registrate:</legend>
						Nombre: <input type="text" name="nombre" value="<?php echo $nombrelleno;?>" placeholder="Nombre" >
						<br>
						<br>
						Apellido: <input type="text" name="apellido" value="<?php echo $apellidolleno;?>" placeholder="Apellido" >
						<br>
						<br>
						Usuario: <input type="text" name="user" value="<?php echo $userlleno;?>" placeholder="Nickname" >
						<br>
						 Select image to upload:
						 <input type="file" name="foto-perfil">
						<br>
						E-mail: <input type="email" name="email" value="<?php echo $emaillleno;?>" placeholder="yo@email.com">
						<br>
						<br>
						E-mail: <input type="email" name="email-confirm" value="" placeholder="Confirmar E-mail">
						<br>
						<br>
						Password:<input type="password" name="pass" value="" placeholder="Contraseña" >
						<br>
						<br>
						Password:<input type="password" name="pass-confirm" value="" placeholder="Confirmar Contraseña" >
						<br>
						<br>
						<!-- ESTO SE COMENTA, ES REGISTRO, NO LOGIN
						Recordarme<input type="checkbox" name="recordame">
						<br>
						<br> -->
						<a href=""><input type='submit' name='Submit' value='enviar'></a>
						<button type='reset' name='reset' value='Borrar'>Vaciar
				</form>
			</div>
		</div>
	</body>
</html>
</html>
