<?php

namespace Anizen; //le asignamos el namespace de Anizen para poder usar correctamente el composer y sea mas claro

class Anime{
    //definimos la conexion a la base de datos y las variables para la misma
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
    public function registrar($_params) //funcion para registrar un producto
    {
        $sql = "INSERT INTO `animes`(`nombre`, `trama`, `dia`) VALUES (:nombre, :trama, :dia)";
        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":nombre" => $_params['nombre'],
            ":trama" => $_params['trama'],
            ":dia" => $_params['dia'],
        );

        if ($resultado->execute($_array))
            return true;

        return false;

    }

    public function actualizar($_params) //funcion para actualizar un producto
    {
        $sql = "UPDATE `animes` SET `nombre`=:nombre,`trama`=:trama,`dia`=:dia, WHERE `id`=:id";
        ;

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":nombre" => $_params['nombre'],
            ":trama" => $_params['trama'],
            ":dia" => $_params['dia'],
        
        );

        if ($resultado->execute($_array))
            return true;

        return false;
    }
    public function mostrarAnimes(){ // creamos el metodo mostrarAnimes para mostrar todos los animes
        $sql = "SELECT * FROM animes";
        
        $resultado = $this->con->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }
    public function mostrarPorId($id){ //creamos el metodo mostrarPorId para mostrar solo el anime de esa id
        
        $sql = "SELECT * FROM animes WHERE `id`=:id ";
        
        $resultado = $this->con->prepare($sql);
        
        $_array = array(
            ":id" => $id
        );

        if($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
}