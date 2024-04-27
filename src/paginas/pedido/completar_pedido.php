<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
require '../productos/funciones.php';
require '../../../vendor/autoload.php';

if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    $usuario_id = $_SESSION['usuario_info']['id'];
    $pedido = new Anizen\Pedido;
    $_params = array(
        'usuario_id' => $usuario_id,
        'total' => calcularTotal(),
        'fecha' => date('Y-m-d')
    );
    $pedido_id = $pedido->registrarPedido($_params);
    foreach ($_SESSION['carrito'] as $indice => $value) {
        $_params = array(
            "pedido_id" => $pedido_id,
            "producto_id" => $value['id'],
            "precio" => $value['precio'],
            "cantidad" => $value['cantidad'],
        );
        $pedido->registrarDetalle($_params);
    }
    $_SESSION['carrito'] = array();
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $email=$_SESSION["usuario_info"]["email"];
    $direccion=$_SESSION["usuario_info"]["direccion"];
    $body="Hemos recibido tu pedido con ID $pedido_id y te llegara a tu domicilio $direccion un plazo de 10 dias habiles.";
    try {
        //Server settings
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.ionos.es'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'web@worldofcataclysm.eu'; //SMTP username
        $mail->Password = '6%x44_OhuN?!!'; //SMTP password
        $mail->SMTPSecure = "tls"; //Enable implicit TLS encryption
        $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('web@worldofcataclysm.eu', 'Anizen');
        $mail->addAddress($email); //Name is optional
        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->CharSet="UTF-8";
        $mail->Subject = 'Pedido recibido';
        $mail->Body = $body;
        header("location:gracias.php");
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}