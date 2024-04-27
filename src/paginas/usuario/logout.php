<?php
session_start();
 //como cerrar sesion y forma de guardar carrito en relacion al usuario
if (isset($_SESSION['carrito'])) {
    $array = array(); // Inicializar el array vacío

    foreach ($_SESSION['carrito'] as $valor) {
        $array[] = $valor; // Agregar cada valor al array
    }
    $_SESSION['carrito_temporal'][$_SESSION['usuario_info']['id']] = $array;
}



unset($_SESSION['carrito']);
$_SESSION['usuario_info'] = array();

header('Location: ../../../index.php');