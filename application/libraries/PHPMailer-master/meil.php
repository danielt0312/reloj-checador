<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<body>
<?php 

 require_once('class.phpmailer.php'); 
 require_once('class.smtp.php');
/* $mail = new PHPMailer();
//indico a la clase que use SMTP
$mail­>IsSMTP();
//permite modo debug para ver mensajes de las cosas que van ocurriendo
$mail­>SMTPDebug =2;
//Debo de hacer autenticación SMTP
$mail­>SMTPAuth = true;
$mail­>SMTPSecure = "ssl";
//indico el servidor de Gmail para SMTP
$mail­>Host = "smtp.gmail.com";
//indico el puerto que usa Gmail
$mail­>Port = 465;
//indico un usuario / clave de un usuario de gmail
$mail­>Username = "pauss10@gmail.com";
$mail­>Password = "10088710";
$mail­>SetFrom('pauss10@gmail.com', 'Paulino Santiago Santiago');
$mail­>AddReplyTo("paulino10@gmail.com","Paulino Santiago Santiago");
$mail­>Subject = "Envío de email usando SMTP de Gmail";
$mail­>MsgHTML("Hola que tal, esto es el cuerpo del mensaje!");
//indico destinatario
$address = "paulino.87@hotmail.com";
$mail­>AddAddress($address, "Paulino Santiago Santiago");
if(!$mail­>Send()) {
echo "Error al enviar: " . $mail­>ErrorInfo;
} else {
echo "Mensaje enviado!";
}*/


$mail = new PHPMailer();
$mail->IsSMTP();

$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";

$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "pauss10@gmail.com";
$mail->Password = "10088710";

$mail->From = "paulino.87@hotmail.com";
$mail->FromName = "Paulino Santiago Santiago";
$mail->Subject = "Verificando el envio del correo";
$mail->AltBody = "Hola,\neste correo ha sido enviado desde PHP usando PHPMailer.";
$mail->MsgHTML("Hola,<br>este correo ha sido enviado desde PHP usando <strong>PHPMailer</strong>.");

// Adjuntar archivos
// Podemos agregar mas de uno si queremos.
//$mail->AddAttachment("ruta-del-archivo/archivo.zip");

$mail->AddAddress("paulino.87@hotmail.com", "Santiago");
$mail->IsHTML(true);
//Por último, solo nos queda enviar el mensaje.

if(!$mail->Send()) {
  echo "Error: " . $mail->ErrorInfo;
} else {
  echo "Mensaje enviado.";
}

/*
$mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
$mail->IsSendmail();
//Set who the message is to be sent from
$mail->SetFrom('from@example.com', 'First Last');
//Set an alternative reply-to address
$mail->AddReplyTo('replyto@example.com','First Last');
//Set who the message is to be sent to
$mail->AddAddress('whoto@example.com', 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer sendmail test';
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
//$mail->MsgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->AddAttachment('images/phpmailer_mini.gif');

//Send the message, check for errors
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}*/


?>
</body>
</html>