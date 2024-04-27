<?php

ini_set ( 'display_errors', 1 );
error_reporting ( E_ALL );

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //manejo para registrar un usuario y que se guarde su informacion 
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    require '../../../vendor/autoload.php';
    $usuario = new Anizen\Usuario;
    $resultado = $usuario->registrar($nombre_usuario, $clave,$email,$telefono,$direccion);

    if ($resultado) {
        session_start();
        $_SESSION['usuario_info'] = array(
            'nombre_usuario' => $nombre_usuario,
            'email' => $email,
            'telefono' => $telefono,
            'direccion' =>$direccion,
            'admin'=>2
        );
        header('location: ../../../index.php');
    } else {
        print 'error al registrar';
        exit(json_encode(array('estado' => false, 'mensaje' => 'Error al registrar')));
    }
}
?>