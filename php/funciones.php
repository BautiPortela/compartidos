<?php
function validarInfo($param) {
  $arrayDeErrores = [];
  if (empty($_POST["nombre"])) {

    $arrayDeErrores["nombre"] ="*Por favor ingrese un nombre";
  }
  if (empty($_POST["user"])) {

    $arrayDeErrores["user"] = "*Por favor ingrese un usuario";
  }
  elseif (strlen($_POST["user"]) < 5 ) {

    $arrayDeErrores["usuario"] = "*Usuario debe tener al menos 5 caracteres";
    }
  if (empty($_POST["email"]) || empty($_POST["email-confirm"])) {

    $arrayDeErrores["email"] = "*Por favor ingrese un email en ambos campos";
  }
  else {
    if ($_POST["email"] != $_POST["email-confirm"]) {
    $arrayDeErrores["email"] = "*El e-mail y su confirmacion no coinciden";
  }
}
  if (empty($_POST["pass"])) {

    $arrayDeErrores["password"][0] = "*Por favor ingrese una contraseña";
    $arrayDeErrores["password"][1] = "*Usar al menos 8 chars para password";
    $arrayDeErrores["password"][2] = "*Su password debe contener una mayuscula y una miniscula";
  }
  elseif (strlen($_POST["pass"])<8 ) {

    $arrayDeErrores["password"][0] = "*Usar al menos 8 chars para password";
    $arrayDeErrores["password"][1] = "*Su password debe contener una mayuscula y una miniscula";
  }
  if (preg_match('/a-zA-Z/',$_POST["pass"]) && $_POST["pass"] != $_POST["pass-confirm"]) {
    $arrayDeErrores["password"][0] = "*Su password debe contener una mayuscula y una miniscula";
    $arrayDeErrores["password"][1] = "*Ambas contraseñas no coinciden";
  }
  elseif (preg_match('/a-zA-Z/',$_POST["pass"])) {
      $arrayDeErrores["password"][0] = "*Su password debe contener una mayuscula y una miniscula";
    }
  elseif ($_POST["pass"] != $_POST["pass-confirm"]) {
      $arrayDeErrores["password"][0] = "*Ambas contraseñas no coinciden";
    }
  if($_FILES["foto-perfil"]["error"] != 0) {
  $arrayDeErrores["foto-perfil"] = "*Por favor cargue una foto para su perfil";
}
  return $arrayDeErrores;
}

function creaUsuario($param1){
  $data["nombre"]=$param1["nombre"];
  $data["apellido"]=$param1["apellido"];
  $data["user"]=$param1["user"];
  $data["email"]=$param1["email"];
  $data["pass"]=password_hash($param1["pass"], PASSWORD_DEFAULT);
  $dataJSON = json_encode($data);
  file_put_contents("user.json", $dataJSON . PHP_EOL, FILE_APPEND);
}

function traerTodos() {
  $archivo = file_get_contents("user.json");
  /* Por lo que entendi esto divive las string de json por End Of Line en un array*/
  $array = explode(PHP_EOL, $archivo);
  array_pop($array);

  $arrayFinal = [];
  foreach ($array as $usuario) {
    $arrayFinal["usuario"] = json_decode($usuario, true);
  }
  foreach ($array as $password) {
    $arrayFinal["password"] = json_decode($password,true);
  }
  return $arrayFinal;
}

function traerPorEmail($email) {
  $todos = traerTodos();

  foreach ($todos as $usuario) {
    if ($usuario["email"] == $email) {
      return $usuario;
    }
  }

  return NULL;

}
/*Esta funcion es la que establece el cookie asi se guarda el perfil. */
function recordarUsuario($email) {
  setcookie("usuarioLogueado", $email, time() + 60*60*24*7);
}

function validarLogin($informacion) {
  $arrayDeErrores = [];
  if (empty($informacion["email"])) {
    $arrayDeErrores["email"] = "Por favor ingrese un email";
  }
  else if(filter_var($informacion["email"], FILTER_VALIDATE_EMAIL) == false) {
    $arrayDeErrores["email"] = "Por favor ingresar un email con formato valido";
  }
  else if (traerPorEmail($informacion["email"]) == NULL) {
    $arrayDeErrores["email"] = "El usuario no existe";
  } else {
    //Validar la contraseña
    $usuario = traerPorEmail($informacion["email"]);
    if (password_verify($informacion["pass"], $usuario["pass"]) == false) {
      $arrayDeErrores["pass"] = "La password es incorrecta";
    }
  }
  return $arrayDeErrores;
}

function loguear($email) {
  $_SESSION["usuarioLogueado"] = $email;
}
function loginExitoso(/*????*/){
  /*esta funcion va a recibir los parametros y iniciar una session*/
}
function logout(){
}

?>
