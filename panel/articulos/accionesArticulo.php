<?php
require '../../vendor/autoload.php'; // se llama a autoload de composer

$articulo = new Anizen\Articulo; //se crea un nuevo articulo, para usar los metodos

if($_SERVER['REQUEST_METHOD'] ==='POST'){ //se hace una validacion dependiendo de si se usa Post

    if ($_POST['accion']==='Registrar'){ //si la accion es "registrar" se efectuan estas lineas de codigo

        if(empty($_POST['titulo'])) //se hacen validaciones para cada valor
            exit('Completar titulo');
        
        if(empty($_POST['descripcion']))
            exit('Completar titulo');

        if(empty($_POST['anime_id']))
            exit('Seleccionar un anime');

        if(!is_numeric($_POST['anime_id']))
            exit('Seleccionar un anime válido');

        
        $_params = array( //se meten los valores del formulario a un array
            'titulo'=>$_POST['titulo'],
            'descripcion'=>$_POST['descripcion'],
            'anime_id'=>$_POST['anime_id'],
            'fecha'=> date('Y-m-d')
        );

        $registrar = $articulo->registrarArticulo($_params); //se le pasa el array al articulo mediante registrarArticulo

        if($registrar) //si ha funcionado correctamente te lleva al archivo index de articulos
            header('Location: index.php');
        else //si ha dado error te salta el siguiente error
            print 'Error al registrar un articulo';

    }

}

if ($_POST['accion']==='Actualizar'){ //si la accion es actualizar se efectuan estas lineas de codigo

    if(empty($_POST['titulo']))//se hacen validaciones para cada valor
    exit('Completar titulo');

    if(empty($_POST['descripcion']))
    exit('Completar titulo');

    if(empty($_POST['anime_id']))
    exit('Seleccionar una Categoria');

    if(!is_numeric($_POST['anime_id']))
    exit('Seleccionar una Categoria válida');


$_params = array( //se meten los valores del formulario a un array
    'titulo'=>$_POST['titulo'],
    'descripcion'=>$_POST['descripcion'],
    'anime_id'=>$_POST['anime_id'],
    'fecha'=> date('Y-m-d'),
    'id'=>$_POST['id'],
);


$rpt = $articulo->actualizarArticulo($_params); //se le pasa el array al articulo mediante actualizarArticulo
if($rpt)//si ha funcionado correctamente te lleva al archivo index de articulos
    header('Location: index.php');  
else //si ha dado error te salta el siguiente error
    print 'Error al actualizar un articulo';

}

if($_SERVER['REQUEST_METHOD'] ==='GET'){ //si se hace mediante GET se efectuan estas lineas de codigo

    $id = $_GET['id']; // se coge la id 

    $rpt = $articulo->eliminarArticulo($id); //se elimina el articulo mediante la id cogida
    
    if($rpt) //si ha funcionado correctamente te lleva al archivo index de articulos
        header('Location: index.php');
    else //si ha dado error te salta el siguiente error
        print 'Error al eliminar un articulo';


}
function subirFoto() { //definimos la función subirFoto

    $carpeta = __DIR__.'/../../upload/'; //se crea $carpeta una variable con el directorio /../../upload

    $archivo = $carpeta.$_FILES['foto']['name'];//se crea la variable archivo que concatena la ruta de la carpeta con el nombre del archivo de imagen que se encuentra en $_FILES['foto']['name']. $_FILES 

    move_uploaded_file($_FILES['foto']['tmp_name'],$archivo); //Se utiliza la función move_uploaded_file() para mover el archivo cargado desde su ubicación temporal ($_FILES['foto']['tmp_name']) a la ubicación final especificada en $archivo

    return $_FILES['foto']['name']; // Se devuelve el nombre del archivo subido ($_FILES['foto']['name']


}




