<?php

$response_recaptcha = $_POST['g-recaptcha-response'];
if(isset($response_recaptcha)&& $response_recaptcha){
  $secret = "6LfwHkgUAAAAAHbwWT8abBexmdaI4NTwx7NITyOg";
  $ip = $_SERVER['REMOTE_ADDR'];
  $validation_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response_recaptcha&remoteip=$ip");

  if(isset($_POST['email'])) {

  // Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
  $email_to = "Marketing <marketing@grupomundoline.com>";
  $email_subject = "Presupuesto de PiscinaMP";

  // Aquí se deberían validar los datos ingresados por el usuario

  if(!isset($_POST['nombre']) ||
  !isset($_POST['email']) ||
  !isset($_POST['telefono']) ||
  !isset($_POST['mensaje'])) {

  echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
  echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
  die();
  }

  $email_message = "Detalles del formulario de contacto:\n\n";
  $email_message .= "Nombre: " . utf8_decode($_POST['nombre']) . "\n";
  $email_message .= "E-mail: " . $_POST['email'] . "\n";
  $email_message .= "Teléfono: " . $_POST['telefono'] . "\n";
  $email_message .= "Comentarios: " . utf8_decode($_POST['mensaje']) . "\n\n";

  // Ahora se envía el e-mail usando la función mail() de PHP
  $headers = 'From: '.$email_from."\r\n".
  'Reply-To: '.$email_from."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  mail($email_to, $email_subject, $email_message, $headers);

  header("location:index.html");
  }

}else{
  header("location:404.html");
}

?>