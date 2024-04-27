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
            <li class="active"><a href="index.php" class="btn">Productos</a></li>
            <li><a href="../articulos/index.php" class="btn">Articulos</a></li>
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

 <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="align-items-center"style="border:1px solid black"><h2 class="text-center"style="border:1px solid red">Registrar Anime</h2></div>
            <form method="POST" action="accionesAnime.php">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="form-group">
                    <label for="trama">Trama:</label>
                    <textarea class="form-control" id="trama" name="trama" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="dia">Día:</label>
                    <input type="text" class="form-control" id="dia" name="dia">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right" name="accion" value="Registrar">Registrar</button>
                    <a href="index.php" class="btn btn-default pull-left">Cancelar</a>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>

  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-1">
          <a href="../index.php">
            <img alt="Brand" src="../../assets/imagenes/logo.png" height="75px" width="100px">
          </a>
          <span class="logo"></span>
        </div>
        <div class="col-md-10">
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