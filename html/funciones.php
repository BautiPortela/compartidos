<?php


/*if (!estaLogueado() && isset($_COOKIE["usuarioLogueado"])) {
  loguear($_COOKIE["usuarioLogueado"]);
}*/


function validarInfo($param) {
  $arrayDeErrores = [];
  validaSiExiste($_POST);
  if (empty($_POST["nombre"])) {

    $arrayDeErrores["nombre"] ="Por favor ingrese un nombre";
  }
  if (empty($_POST["user"])) {

    $arrayDeErrores["user"] = "Por favor ingrese un usuario";
  }
  elseif (strlen($_POST["user"]) < 5 ) {

    $arrayDeErrores["usuario"] = "Usuario debe tener al menos 5 caracteres";
    }
  if (empty($_POST["email"]) || empty($_POST["email-confirm"])) {

    $arrayDeErrores["email"] = "Por favor ingrese un email en ambos campos";
  }
  else {
    if ($_POST["email"] != $_POST["email-confirm"]) {
    $arrayDeErrores["email"] = "El e-mail y su confirmacion no coinciden";
  }
}
  if (empty($_POST["pass"])) {

    $arrayDeErrores["password"][0] = "Por favor ingrese una contraseña";
    $arrayDeErrores["password"][1] = "Usar al menos 8 chars para password";
    $arrayDeErrores["password"][2] = "Su password debe contener una mayuscula y una miniscula";
  }
  elseif (strlen($_POST["pass"])<8 ) {

    $arrayDeErrores["password"][0] = "Usar al menos 8 chars para password";
    $arrayDeErrores["password"][1] = "Su password debe contener una mayuscula y una miniscula";
  }
  if (preg_match('/a-zA-Z/',$_POST["pass"]) && $_POST["pass"] != $_POST["pass-confirm"]) {
    $arrayDeErrores["password"][0] = "Su password debe contener una mayuscula y una miniscula";
    $arrayDeErrores["password"][1] = "Ambas contraseñas no coinciden";
  }
  elseif (preg_match('/a-zA-Z/',$_POST["pass"])) {
      $arrayDeErrores["password"][0] = "Su password debe contener una mayuscula y una miniscula";
    }
  elseif ($_POST["pass"] != $_POST["pass-confirm"]) {
      $arrayDeErrores["password"][0] = "Ambas contraseñas no coinciden";
    }
  if($_FILES["foto-perfil"]["error"] != 0) {
  $arrayDeErrores["foto-perfil"] = "Por favor cargue una foto para su perfil";
}
  return $arrayDeErrores;
}
  /*
  if (empty($param["genero"])){

    $arrayDeErrores = [("genero"),("Por favor seleccione un genero")];
  }
  if (empty($param["fnac_dia"])|| empty($param["fnac_mes"]) || empty($param["fnac_anio"])) {

    $arrayDeErrores = [];
}*/
function creaUsuario($param1){
  $data["nombre"]=$param1["nombre"];
  $data["apellido"]=$param1["apellido"];
  $data["user"]=$param1["user"];
  $data["email"]=$param1["email"];
  $data["pass"]=password_hash($param1["pass"], PASSWORD_DEFAULT);
  $dataJSON = json_encode($data);
  file_put_contents("user.json", $dataJSON . PHP_EOL, FILE_APPEND);
}
function validaSiExiste($param2){
  $arraysss = [];
  $usuarios = file_get_contents("user.json");
  $arraysss = json_decode($usuarios, true);
/*  foreach ($array as $key => $value) {
    if ($array[$key] == $_POST["email"]) {
      echo "E-mail ya esta registrado";
    }
  }*/
}
/*Esta funcion es la que establece el cookie asi se guarda el perfil. */
function recordarUsuario($email) {
  setcookie("usuarioLogueado", $email, time() + 60*60*24*7);
}

function validarLogin(){
    /*esta funcion deberia devolverme un array de errores*/
}
function loginExitoso(/*????*/){
  /*esta funcion va a recibir los parametros y iniciar una session*/
}
function logout(){
}

?>
