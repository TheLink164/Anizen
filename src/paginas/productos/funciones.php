<?php


function agregarProducto($resultado, $id, $cantidad = 1) { //funcion para agregar producto al carrito
    $_SESSION['carrito'][$id] = array(
        'id' => $resultado['id'],
        'titulo' => $resultado['titulo'],
        'foto' => $resultado['foto'],
        'precio' => $resultado['precio'],
        'cantidad' => $cantidad
    );
}
   function actualizarProducto($id,$cantidad = FALSE){ //funcion para actualizar producto

    if($cantidad)
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    else
        $_SESSION['carrito'][$id]['cantidad']+=1;
}

function calcularTotal(){ //funcion para caluclarTotal

    $total = 0;
    if(isset($_SESSION['carrito'])){
        foreach($_SESSION['carrito'] as $indice => $value){
            $total += $value['precio'] * $value['cantidad'];
        }
    }
    return $total;

}

function cantidadProductos(){ //funcion para mostrar la cantidad de productos del carrito
    $cantidad = 0;
    if(isset($_SESSION['carrito'])){
        foreach($_SESSION['carrito'] as $indice => $value){
           $cantidad++;
        }
    }

    return $cantidad;
}