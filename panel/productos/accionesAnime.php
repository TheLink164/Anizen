<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../../vendor/autoload.php'; //se llama al autoload de composer

$anime = new Anizen\Anime; //se crea un nuevo producto, pa

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // se recoge la informacion de los formularios con metodo "post"

    if ($_POST['accion'] === 'Registrar') { //si la accion es registrar

        if (empty($_POST['nombre'])) // se hacen validaciones de todos los campos
            exit('Completar nombre');

        if (empty($_POST['trama']))
            exit('Completar trama');

        if (empty($_POST['dia']))
            exit('Seleccionar un dia');

        $_params = array( //se mete en un array los valores pasados por el formulario 
            'nombre' => $_POST['nombre'],
            'trama' => $_POST['trama'],
            'dia' => $_POST['dia'],
        );

        $rpt = $anime->registrar($_params); //usando el metodo registrar, se registra el producto en la base de datos

        if ($rpt)
            header('Location: index.php'); //si ha funcionado se vuelve a la pagina principal de productos
        else
            print 'Error al registrar un anime'; 

    }

}

if ($_POST['accion'] === 'Actualizar') {

    if (empty($_POST['nombre'])) // se hacen validaciones de todos los campos
    exit('Completar nombre');

if (empty($_POST['trama']))
    exit('Completar trama');

if (empty($_POST['dia']))
    exit('Seleccionar un dia');

$_params = array( //se mete en un array los valores pasados por el formulario 
    'nombre' => $_POST['nombre'],
    'trama' => $_POST['trama'],
    'dia' => $_POST['dia'],
);

    $rpt = $producto->actualizar($_params);
    if ($rpt)
        header('Location: index.php');
    else
        print 'Error al actualizar un anime';

}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id = $_GET['id'];

    $rpt = $anime->eliminar($id);

    if ($rpt)
        header('Location: index.php');
    else
        print 'Error al eliminar un anime';


}
