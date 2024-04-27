<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../../vendor/autoload.php'; //se llama al autoload de composer

$producto = new Anizen\Producto; //se crea un nuevo producto, pa

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // se recoge la informacion de los formularios con metodo "post"

    if ($_POST['accion'] === 'Registrar') { //si la accion es registrar

        if (empty($_POST['titulo'])) // se hacen validaciones de todos los campos
            exit('Completar titulo');

        if (empty($_POST['descripcion']))
            exit('Completar titulo');

        if (empty($_POST['anime_id']))
            exit('Seleccionar un anime');

        if (!is_numeric($_POST['anime_id']))
            exit('Seleccionar un anime válido');

        if (empty($_POST['categoria_id']))
            exit('Seleccionar una categoria');

        if (!is_numeric($_POST['categoria_id']))
            exit('Seleccionar una categoria válida');


        $_params = array( //se mete en un array los valores pasados por el formulario 
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'],
            'foto' => subirFoto(),
            'precio' => $_POST['precio'],
            'anime_id' => $_POST['anime_id'],
            'categoria_id' => $_POST['categoria_id'],
            'fecha' => date('Y-m-d')
        );

        $rpt = $producto->registrar($_params); //usando el metodo registrar, se registra el producto en la base de datos

        if ($rpt)
            header('Location: index.php'); //si ha funcionado se vuelve a la pagina principal de productos
        else
            print 'Error al registrar una Producto'; 

    }

}

if ($_POST['accion'] === 'Actualizar') {

    if (empty($_POST['titulo']))
        exit('Completar titulo');

    if (empty($_POST['descripcion']))
        exit('Completar titulo');

    if (empty($_POST['anime_id']))
        exit('Seleccionar un anime');

    if (!is_numeric($_POST['anime_id']))
        exit('Seleccionar un anime válido');

    if (empty($_POST['categoria_id']))
        exit('Seleccionar una categoria');

    if (!is_numeric($_POST['categoria_id']))
        exit('Seleccionar una categoria válida');



    $_params = array(
        'titulo' => $_POST['titulo'],
        'descripcion' => $_POST['descripcion'],
        'precio' => $_POST['precio'],
        'anime_id' => $_POST['anime_id'],
        'categoria_id' => $_POST['categoria_id'],
        'fecha' => date('Y-m-d'),
        'id' => $_POST['id'],
    );

    if (!empty($_POST['foto_temp']))
        $_params['foto'] = $_POST['foto_temp'];

    if (!empty($_FILES['foto']['name']))
        $_params['foto'] = subirFoto();

    $rpt = $producto->actualizar($_params);
    if ($rpt)
        header('Location: index.php');
    else
        print 'Error al actualizar una Producto';

}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id = $_GET['id'];

    $rpt = $producto->eliminar($id);

    if ($rpt)
        header('Location: index.php');
    else
        print 'Error al eliminar una Producto';


}
function subirFoto()
{

    $carpeta = __DIR__ . '/../../assets/upload/';

    $archivo = $carpeta . $_FILES['foto']['name'];

    move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);

    return $_FILES['foto']['name'];


}