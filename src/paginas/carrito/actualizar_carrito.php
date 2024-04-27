<?php

session_start();

if (!isset($_SESSION['usuario_info']) || empty($_SESSION['usuario_info'])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../usuario/formlogin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //funcionamiento para actualizar la cantidad de un producto de anime
    require '../productos/funciones.php';

    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    if (is_numeric($cantidad) && isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    }

    header('Location: carrito.php');
    exit();
}