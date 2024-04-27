<?php

namespace Anizen;

class usuario
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
    public function iniciar_sesion($nombre, $clave) //funcion para iniciar sesion
    {

        $sql = "SELECT id, nombre_usuario, email, telefono, direccion, admin FROM `usuarios` WHERE nombre_usuario = :nombre AND clave = :clave ";

        $resultado = $this->con->prepare($sql);

        $_array = array(
            ":nombre" => $nombre,
            ":clave" => $clave
        );

        if ($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
    public function registrar($nombre, $clave, $email, $telefono, $direccion)
    {
        $sql = "INSERT INTO `usuarios` (nombre_usuario, clave, email, telefono, direccion) VALUES (:nombre, :clave, :email, :telefono, :direccion)";
    
        $resultado = $this->con->prepare($sql);
    
        $_array = array(
            ":nombre" => $nombre,
            ":clave" => $clave,
            ":email" => $email,
            ":telefono" => $telefono,
            ":direccion" => $direccion
        );
    
        if ($resultado->execute($_array)) {
            return true;
        }
    
        return false;
    }
}
?>