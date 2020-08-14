<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../libraries/vendor/autoload.php';
class Correo
{
    private $email;

    function __construct()
    {
        $this->email = new PHPMailer(true);
        $this->email->SMTPDebug = SMTP::DEBUG_OFF;
        $this->email->isSMTP();
        $this->email->Host = 'smtp.gmail.com';
        $this->email->SMTPAuth = true;
        $this->email->Username = '';
        $this->email->Password = '';
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->email->Port = 587;
        $this->email->CharSet = 'UTF-8';
        $this->email->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );
        $this->email->isHTML(true);
        $this->email->setFrom('', '');
    }
    public function enviarCredenciales($nombre, $correo, $clave)
    {
        try {
            //De donde se envia el correo
            $this->email->addAddress($correo, $nombre);
            $this->email->Subject = 'Credenciales para administrador de CandidatosSV';
            //Lllenando el HTML con las variables
            $html = file_get_contents('../../web/usuario.html');
            $html = str_replace('##NOMBRE##', $nombre, $html);
            $html = str_replace('##CORREO##', $correo, $html);
            $html = str_replace('##CLAVE##', $clave, $html);
            $this->email->Body = $html;
            if ($this->email->send()) {
                return true;
            } else {
                throw new Exception($this->email->ErrorInfo);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
