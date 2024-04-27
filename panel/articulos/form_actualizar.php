<?php
  require '../../vendor/autoload.php'; //se llama al autoload de composer

  if(isset($_GET['id']) && is_numeric($_GET['id'])){ //se hacen validaciones conforme se coja el id 
      $id = $_GET['id']; // se coje el id
    
      $articulo = new Anizen\Articulo; // se crea el articulo
      $resultado = $articulo->mostrarArticulosPorId($id); //se mete en la variable $resultado el resultado de la funcion mostrarArticulosPorId de articulo 

      if(!$resultado) //si funciona te va a index.php
          header('Location: index.php');

  }else{ //si no funciona y no se coje la id te vuelve a index.php
    header('Location: index.php');
  }
session_start(); //se inicia la sesion

if (!isset($_SESSION['usuario_info']) || $_SESSION['usuario_info']['admin'] != "1") { //se hacen validaciones conforme hayas iniciado sesion y no seas admin, para evitar problemas de seguridad
  header('Location: ../../index.php');
  exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Anizen</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
  </head>

  <body>

  <header>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <!-- Logo -->
          <a href="../index.php">
            <img alt="Brand" src="../../assets/imagenes/logo.png" height="75px" width="100px">
          </a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <!-- Apartados -->
            <li><a href="../../index.php">Tienda</a></li>
            <li><a href="../pedidos/index.php" class="btn">Pedidos</a></li>
            <li><a href="../productos/index.php" class="btn">Productos</a></li>
            <li class="active"><a href="index.php" class="btn">Articulos</a></li>
            <li class="dropdown">
              <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">
                  <?php print $_SESSION['usuario_info']['nombre_usuario'] ?>
                  <span class="caret"></span>
                </a>
              <?php } else ?>
              <?php if (!isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                <a href="#" class="glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false"><span class="caret"></span></a>
              <?php } else ?>
              <ul class="dropdown-menu">
                <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                  <li><a href="../../src/paginas/usuario/usuario.php">Mi cuenta</a></li>
                  <li><a href="../../src/paginas/usuario/logout.php">Salir</a></li>
                <?php } else ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

    <div class="container" id="main"> <!--Se crea un div con la clase container de bootstrap -->
      <div class="row">  <!-- Se define una fila con la clase "row" -->
        <div class="col-md-12"><!-- Se ajusta el tamaño al maximo disponible (12)-->
          <fieldset>
            <legend>Datos del articulo</legend>
            <form method="POST" action="accionesArticulo.php" enctype="multipart/form-data" > <!-- Se crea el formulario-->
              <input type="hidden" name="id" value="<?php print $resultado['id'] ?>"> <!--Se coge la id -->
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Titulo</label>
                          <input value="<?php print $resultado['titulo'] ?>" type="text" class="form-control" name="titulo" required> <!-- Se coge el titulo actual -->
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Descripción</label>
                          <textarea class="form-control" name="descripcion" id="" cols="3" required><?php print $resultado['descripcion']?></textarea> <!-- Se coge la descripcion actual-->
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Anime</label> <!--Apartado de seleccion de todos los animes -->
                          <select class="form-control" name="anime_id" required>
                            <option value="">--SELECCIONE--</option>
                            <?php
                              $anime = new Anizen\Anime; //se crea un anime
                              $info_anime = $anime->mostrarAnimes(); //se mete en la variable $info_anime todos los nombres anime
                              $cantidad = count($info_anime); // se calculan cuantos animes hay
                                for($x =0; $x< $cantidad;$x++){ //se hace un bucle para mostrar todos los nombres de los animes
                                  $item = $info_anime[$x];
                                  ?>
                                  <option value="<?php print $item['id'] ?>"
                                   <?php print $resultado['anime_id']== $item['id'] ?'selected':'' ?>
                                  ><?php print $item['nombre'] ?></option>
                                <?php
  
                                  }
                                ?>
                          </select>
                      </div>
                  </div>
              </div>
              <input type="submit" class="btn btn-primary" name="accion" value="Actualizar"> <!-- Se crea el input con value "actualizar" para usarlo en el archivo accionesArticulo -->
              <a href="index.php" class="btn btn-default">Cancelar</a> <!-- Ponemos el boton de cancelar que devuelve al index.php -->
            </form>
          </fieldset>
        </div>
      </div>
    </div> <!-- /container -->
    <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <a href="../index.php">
            <img alt="Brand" src="../../assets/imagenes/logo.png" height="75px" width="100px">
          </a>
          <span class="logo"></span>
        </div>
        <div class="col-sm-6">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../../src/paginas/anizen/politica.php">Politica de privacidad</a></li>
            <li><a href="../../src/paginas/anizen/avisolegal.php">Aviso legal</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

  </body>
</html>
