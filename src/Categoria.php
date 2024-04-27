<?php

namespace Anizen;

class Categoria{

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
    public function mostrar(){ //creamos la funcion mostrar que muestra todas las categorias
        $sql = "SELECT * FROM categorias";
        
        $resultado = $this->con->prepare($sql);

        if($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }
}