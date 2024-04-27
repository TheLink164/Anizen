<?php
session_start();
if (!isset($_SESSION['usuario_info']) || $_SESSION['usuario_info']['admin'] != "1") { 
  header('Location: ../index.php');
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


  <div class="container" id="main">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>Datos del articulo</legend>
          <form method="POST" action="accionesArticulo.php" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Titulo</label>
                  <input type="text" class="form-control" name="titulo" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Descripción</label>
                  <textarea class="form-control" name="descripcion" id="" cols="3" required></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Anime</label>
                  <select class="form-control" name="anime_id" required>
                    <option value="">--SELECCIONE--</option>
                    <?php
                    require '../../vendor/autoload.php';
                    $anime = new Anizen\Anime;
                    $info_anime = $anime->mostrarAnimes();
                    $cantidad = count($info_anime);
                    for ($x = 0; $x < $cantidad; $x++) {
                      $item = $info_anime[$x];
                      ?>
                      <option value="<?php print $item['id'] ?>"><?php print $item['nombre'] ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
            <a href="index.php" class="btn btn-default">Cancelar</a>
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