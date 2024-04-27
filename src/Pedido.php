<?php

namespace Anizen;

class Pedido
{

    private $cfg;
    private $con = null;

    public function __construct()
    {

        $this->cfg = parse_ini_file(__DIR__ . '/../config.ini');

        $this->con = new \PDO($this->cfg['dns'], $this->cfg['usuario'], $this->cfg['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        )
        );

    }

    public function registrarPedido($_params) //creamos la funcion para registrar un pedido en la base de datos
    {
        $sql = "INSERT INTO `pedidos`(`usuario_id`, `total`, `fecha`) 
        VALUES (:usuario_id,:total,:fecha)";



        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":usuario_id" => $_params['usuario_id'],
            ":total" => $_params['total'],
            ":fecha" => $_params['fecha'],

        );

        if ($resultado->execute($_array))
            return $this->con->lastInsertId();

        return false;
    }

    public function registrarDetalle($_params) //creamos la funcion para registrar un detalle de pedido en la base de datos
    {
        $sql = "INSERT INTO `detalle_pedidos`(`pedido_id`, `producto_id`, `precio`, `cantidad`) 
        VALUES (:pedido_id,:producto_id,:precio,:cantidad)";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":pedido_id" => $_params['pedido_id'],
            ":producto_id" => $_params['producto_id'],
            ":precio" => $_params['precio'],
            ":cantidad" => $_params['cantidad'],
        );

        if ($_params['producto_id'] != null && $resultado->execute($_array))
            return true;

        return false;
    }

    public function mostrarPedido() //creamos la funcion para mostrar los pedidos
    {
        $sql = "SELECT p.id, nombre_usuario, email, total, fecha FROM pedidos p 
        INNER JOIN usuarios u  ON p.usuario_id = u.id ORDER BY p.id DESC";

        $resultado = $this->con->prepare($sql);

        if ($resultado->execute())
            return $resultado->fetchAll();

        return false;

    }

    public function mostrarPedidoPorId($id) //creamos la funcion para mostar un pedido por su id
    {
        $sql = "SELECT p.id, nombre_usuario, email, total, fecha FROM pedidos p 
        INNER JOIN usuarios u ON p.usuario_id = u.id WHERE p.id = :id";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ':id' => $id
        );

        if ($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
    public function mostrarPedidoPorIdUsuario($id) //Creamos la funcion para mostrar los pedidos de un usuario
    {
        $sql = "SELECT p.id, nombre_usuario, email, total, fecha FROM pedidos p 
        INNER JOIN usuarios u ON p.usuario_id = u.id WHERE u.id = :id ORDER BY fecha DESC";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ':id' => $id
        );

        if ($resultado->execute($_array))
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarDetallePorIdPedido($id) //creamos la funcion para mostrar el detalle de un pedido
    {
        $sql = "SELECT dp.id,p.titulo,dp.precio,dp.cantidad,p.foto
                FROM detalle_pedidos dp
                INNER JOIN productos p ON p.id= dp.producto_id
                WHERE dp.pedido_id = :id
                ORDER BY dp.id DESC";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ':id' => $id
        );

        if ($resultado->execute($_array))
            return $resultado->fetchAll();

        return false;

    }
    public function mostrarUltimos()//creamos la funcion para mostrar los ultimos 10 pedidos
    {
        $sql = "SELECT p.id, u.nombre_usuario, u.email, p.total, p.fecha FROM pedidos p 
        INNER JOIN usuarios u ON p.usuario_id = u.id ORDER BY p.id DESC LIMIT 10";

        $resultado = $this->con->prepare($sql);

        if ($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }


}