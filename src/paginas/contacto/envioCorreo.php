<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../vendor/autoload.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$asunto =$_POST['asunto'];
$mensaje = $_POST['mensaje'];

// Crear una instancia; pasando `true` se habilitan las excepciones
$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP(); // Enviar utilizando SMTP
    $mail->Host = 'smtp.ionos.es'; // Configurar el servidor SMTP para enviar
    $mail->SMTPAuth = true; // Habilitar la autenticación SMTP
    $mail->Username = 'web@worldofcataclysm.eu'; // Nombre de usuario SMTP
    $mail->Password = '6%x44_OhuN?!!'; // Contraseña SMTP
    $mail->SMTPSecure = "tls"; // Habilitar cifrado TLS implícito
    $mail->Port = 587; // Puerto TCP para conectarse; usa 587 si has configurado `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Destinatarios
    $mail->setFrom($email, $nombre);
    $mail->addAddress('web@worldofcataclysm.eu'); // El nombre es opcional

    // Contenido
    $mail->isHTML(true); // Establecer el formato del correo electrónico a HTML
    $mail->CharSet = "UTF-8";
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;

    $mail->send();
    header("Location: finalizar.php");

} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error del correo: {$mail->ErrorInfo}";
}
?>