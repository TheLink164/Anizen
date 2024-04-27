<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //manejo de inicio de sesion y asignacion de valores a la variable usuario_info
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];
    require '../../../vendor/autoload.php';
    $usuario = new Anizen\Usuario;
    $resultado = $usuario->iniciar_sesion($nombre_usuario, $clave);

    if ($resultado) {
        session_start();
        $_SESSION['usuario_info'] = array(
            'id' => $resultado['id'],
            'nombre_usuario' => $nombre_usuario,
            'email' => $resultado['email'],
            'telefono' => $resultado['telefono'],
            'direccion' =>$resultado['direccion'],
            'admin' => $resultado['admin']
        );
        if (isset($_SESSION['carrito_temporal'][$_SESSION['usuario_info']['id']])) {
            $_SESSION['carrito'] = $_SESSION['carrito_temporal'][$_SESSION['usuario_info']['id']];
            unset($_SESSION['carrito_temporal'][$_SESSION['usuario_info']['id']]);
        }
        header('location: ../../../index.php');
    } else {
        print 'error al iniciar sesion';
        exit(json_encode(array('estado' => FALSE, 'mensaje' => 'Error al iniciar session')));
    }

}