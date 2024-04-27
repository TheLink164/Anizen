<?php
namespace Anizen;
class Articulo
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
    public function registrarArticulo($_params) //creamos la funcion registrarArticulo para insertar en la base de datos un nuevo articulo
    {
        $sql = "INSERT INTO `articulos`(`titulo`, `descripcion`, `anime_id`, `fecha`) 
        VALUES (:titulo,:descripcion,:anime_id,:fecha)";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":titulo" => $_params['titulo'],
            ":descripcion" => $_params['descripcion'],
            ":anime_id" => $_params['anime_id'],
            ":fecha" => $_params['fecha'],
        );

        if ($resultado->execute($_array))
            return true;

        return false;

    }

    public function actualizarArticulo($_params) //creamos la funcion actualizarArticulo para actualizar en la base de datos un articulo
    
    {
        $sql = "UPDATE `articulos` SET `titulo`=:titulo,`descripcion`=:descripcion,`anime_id`=:anime_id,`fecha`=:fecha  WHERE `id`=:id";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":titulo" => $_params['titulo'],
            ":descripcion" => $_params['descripcion'],
            ":anime_id" => $_params['anime_id'],
            ":fecha" => $_params['fecha'],
            ":id" => $_params['id']
        );

        if ($resultado->execute($_array))
            return true;

        return false;
    }

    public function eliminarArticulo($id) //creamos la funcion eliminarArticulo para eliminar un articulo por id
    {
        $sql = "DELETE FROM `articulos` WHERE `id`=:id";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":id" => $id
        );

        if ($resultado->execute($_array))
            return true;

        return false;
    }
    public function mostrarArticulos() //creamos la funcion para mostrar todos los articulos
    {
        $sql = "SELECT articulos.id, titulo, descripcion,nombre FROM articulos 
        
        INNER JOIN animes
        ON articulos.anime_id = animes.id ORDER BY articulos.id DESC
        ";

        $resultado = $this->con->prepare($sql);

        if ($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }

    public function mostrarArticulosPorId($id) //creamos la funcion para mostrar un articulo por su id
    {

        $sql = "SELECT * FROM articulos WHERE `id`=:id ";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":id" => $id
        );

        if ($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
    public function mostrarUltimosArticulos() //creamos una funcion para mostrar los ultimos 2 articulos subidos
    {
        $sql = "SELECT * FROM articulos ORDER BY id DESC LIMIT 2";

        $resultado = $this->con->prepare($sql);

        if ($resultado->execute()) {
            return $resultado->fetchAll();
        }

        return false;
    }

}