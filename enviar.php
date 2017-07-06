<?php
// Developement
header("Location: http://bodyart.mx");
die();
var_dump($_POST);
die();
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

if(isset($_POST['email'])) {
 
    $email_to = "humbertowoody@gmail.com";
    $email_subject = "Nueva Orden";
 
    function died($error) {
        // your error code can go here
        echo "Lo sentimos mucho, ha ocurrido un error.";
        echo "Los errores se muestran a continuación:<br /><br />";
        echo $error."<br /><br />";
        echo "Porfavor, regresa y arregla los errores.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['nombre']) ||
        !isset($_POST['apellido']) ||
        !isset($_POST['email']) ||
        !isset($_POST['estudios']) ||
        !isset($_POST['zona']) ||
        !isset($_POST['clinica']) ||
        !isset($_POST['doctor'])
        ) {

        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['nombre']; // required
    $last_name = $_POST['apellido']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['estudios']; // not required
    $comments = $_POST['zona']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers);  

}
?>