<?php
/**
 * Clase Mail que onbtiene los parametros correspondientes para crear y enviar e-mail
 * sintaxis
 * $data = array('correo' => 'correo@servicio.com', 'asunto' => 'Asunto del mensaje', 'mensaje' => 'Texto del mensaje');
 * $this->enviarMensaje($data);
 */
include 'PHPMailer-master/class.phpmailer.php';
class Mail  extends PHPMailer {

    private $msj = '';
    private $openHtml = '';
    private $closeHtml = '';
    private $salto = '<br>';

  function __construct() {

      $this->startHtml();
      $this->stopHtml();

    }


    public function enviarMensaje($data) {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "infra.sistemas.cete@gmail.com"; //Correo del que se enviará el mensaje
        $mail->Password = "cite.87$"; //password del correo
        $mail->From = "infra.sistemas.cete@gmail.com";
        $mail->FromName = APP_NAME;
        $mail->Subject = $data['asunto']; //Asunto del mensaje
        $mail->AltBody = $data['asunto'];

        $mail->MsgHTML($this->estructuraMsj($data['asunto'], $data['mensaje'])); //Creamos la estructura o layout del mensaje
        $mail->AddAddress($data['correo']); //Destinatario
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';

        if(!$mail->Send()){
            #echo "Error: " . $mail->ErrorInfo;
            return ['error' => 1, 'mensaje' => $mail->ErrorInfo];
        } else {
            $mail->ClearAddresses ();
            return ['error' => 0, 'mensaje' => "Mensaje enviado correctamente"];
        }

    }

    public function estructuraMsj($asunto, $mensaje) {

        $this->msj .= $this->openHtml;

        $this->msj .= '<div style="width: 95%; display: block;">';
        $this->msj .= $this->insertImage('https://www.tamaulipas.gob.mx/educacion/wp-content/themes/secretarias/img/logo/tam.png',100,50,'');
        $this->msj .= $this->insertImage('https://www.tamaulipas.gob.mx/educacion/wp-content/themes/secretarias/img/logo/educacion.jpg',200,50,'');
        $this->msj .= $this->insertImage('http://207.248.56.243/contenido/diverticomputo.png',100,100,'margin-left: 60%;');
        
        $this->msj .= $this->msjTitle($asunto, '#bc955c', '#fff', '#FFF');
        $this->msj .= $this->salto;
        $this->msj .= $this->msjBody('#d9d9d9', '#E4DEDE', '#000', $mensaje);
        $this->msj .= $this->closeHtml;

        return $this->msj;

    }

    public function startHtml() {

        $this->openHtml .= '<html lang="en">';
        $this->openHtml .= '<head>';
        $this->openHtml .= '<meta charset="UTF-8">';
        $this->openHtml .= '<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">';
        $this->openHtml .= '<title>Notificación de Sistema</title>';
        $this->openHtml .= '<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">';
        $this->openHtml .= '</head>';
        $this->openHtml .= '<body>';


    }

    public function stopHtml() {

        $this->closeHtml .= '</body>';
        $this->closeHtml .= '</html>';

    }

    public function insertImage($imagen,$size1,$size2,$estilos) {

        $openImage = '';

       // $openImage .= '<div style="width: 80%; margin: 0 auto;">';
        $openImage .= '<img src="'.$imagen.'" width='.$size1.' height='.$size2.' style="'.$estilos.'"></img>';
       // $openImage .= '</div>';

        return $openImage;

    }

    public function msjTitle($asunto, $fondo, $color, $color_border) {

        $titleBlue = '';

        $titleBlue .= '<div style="width: 100%; margin: 0; border-radius: 5px 5px 0 0; background: '.$fondo.'; color: '.$color.'; padding-top: 0em; padding-left: 0px; display: block; border: 1px '.$color_border.' solid;">';
        $titleBlue .= '<center><h2>'.$asunto.'</h2></center>';
        $titleBlue .= '</div>';

        return $titleBlue;

    }

    public function  msjBody($fondo, $color_border, $color, $mensaje) {

        $body = '';

        $body .= '<div style="width: 75%; margin: 0 auto; background: '.$fondo.'; padding-top: 2em; padding-left: ; border: 1px '.$color_border.' solid;  display: block;">';
        $body .= '<div style="color: '.$color.';">';
        $body .= $mensaje;
        $body .= '</div>';
        $body .= '</div>';

        return $body;

    }

}
 ?>