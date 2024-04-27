<?php

namespace Anizen;

class Producto
{
    private $cfg;
    private $con = null;

    public function __construct()
    {
        $this->cfg = parse_ini_file(__DIR__ . '/../config.ini');

        $this->con = new \PDO(
            $this->cfg['dns'], $this->cfg['usuario'], $this->cfg['clave'],
            array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
    }
    public function registrar($_params) //funcion para registrar un producto
    {
        $sql = "INSERT INTO `productos`(`titulo`, `descripcion`, `foto`, `precio`, `anime_id`, `categoria_id`, `fecha`) 
        VALUES (:titulo, :descripcion, :foto, :precio, :anime_id, :categoria_id, :fecha)";
        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":titulo" => $_params['titulo'],
            ":descripcion" => $_params['descripcion'],
            ":foto" => $_params['foto'],
            ":precio" => $_params['precio'],
            ":anime_id" => $_params['anime_id'],
            ":categoria_id" => $_params['categoria_id'],
            ":fecha" => $_params['fecha'],
        );

        if ($resultado->execute($_array))
            return true;

        return false;

    }

    public function actualizar($_params) //funcion para actualizar un producto
    {
        $sql = "UPDATE `productos` SET `titulo`=:titulo,`descripcion`=:descripcion,`foto`=:foto,`precio`=:precio,`anime_id`=:anime_id,`categoria_id`=:categoria_id,`fecha`=:fecha  WHERE `id`=:id";
        ;

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":titulo" => $_params['titulo'],
            ":descripcion" => $_params['descripcion'],
            ":foto" => $_params['foto'],
            ":precio" => $_params['precio'],
            ":anime_id" => $_params['anime_id'],
            ":categoria_id" => $_params['categoria_id'],
            ":fecha" => $_params['fecha'],
            ":id" => $_params['id']
        );

        if ($resultado->execute($_array))
            return true;

        return false;
    }

    public function eliminar($id) //funcion para eliminar un producto
    {
        $sql = "DELETE FROM `productos` WHERE `id`=:id";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":id" => $id
        );

        if ($resultado->execute($_array))
            return true;

        return false;
    }
    public function mostrar() //funcion para mostrar todos los productos
    {
        $sql = "SELECT productos.id, productos.titulo, productos.descripcion, productos.foto, animes.nombre AS nombre_anime, categorias.nombre AS nombre_categoria, productos.precio, productos.fecha
        FROM productos
        INNER JOIN animes ON productos.anime_id = animes.id
        INNER JOIN categorias ON productos.categoria_id = categorias.id
        ORDER BY productos.id DESC";

        $resultado = $this->con->prepare($sql);

        if ($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }
    public function mostrarPorId($id) //funcion para mostrar por id un producto
    {

        $sql = "SELECT * FROM `productos` WHERE `id`=:id ";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":id" => $id
        );

        if ($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }

    public function mostrarUltimos() //funcion para mostrar los ultimos productos
    {
        $sql = "SELECT productos.id, titulo, descripcion, foto, precio, fecha
            FROM productos
            ORDER BY productos.id DESC
            LIMIT 4";

        $resultado = $this->con->prepare($sql);

        if ($resultado->execute()) {
            return $resultado->fetchAll();
        }

        return false;
    }
    function mostrarProductosPorCategoria($categoria_id)//funcion para mostrar productos por su categoria
    {
        $sql = "SELECT productos.id AS productos_id, productos.titulo, productos.descripcion, productos.foto, animes.nombre AS nombre_anime, categorias.nombre AS nombre_categoria, categorias.id, productos.precio, productos.fecha
        FROM productos
        INNER JOIN animes ON productos.anime_id = animes.id
        INNER JOIN categorias ON productos.categoria_id = categorias.id
        WHERE categorias.id = :categoria_id
        ORDER BY productos.id DESC";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":categoria_id" => $categoria_id
        );

        if ($resultado->execute($_array))
            return $resultado->fetchAll();

        return false;
    }
}