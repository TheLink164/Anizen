<?php
session_start();
require '../productos/funciones.php';

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
  <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../assets/css/estilos.css">
</head>

<body>

  <header>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <!-- Logo -->
          <a href="../../../index.php">
            <img alt="Brand" src="../../../assets/imagenes/logo.png" height="75px" width="100px">
          </a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <!-- Apartados -->
            <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) {
              if ($_SESSION['usuario_info']['admin'] == "1") { ?>
                <li><a href="../../../panel/index.php">Panel</a></li>
              <?php }
            } ?>
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Anime
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <!-- Agrega la clase "dropdown-menu-right" aquí -->
                <li><a href="../animes/blog.php">Blog</a></li>
                <li><a href="../animes/calendario.php">Calendario</a></li>
              </ul>
            </li>
            <li><a href="../contacto/contacto.php">Contacto</a></li>
            <li><a href="../anizen/conocenos.php">Conocenos</a></li>
            <li><a href="../productos/tienda.php">Tienda</a></li>
            <li class="dropdown">
              <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">
                  <?php print $_SESSION['usuario_info']['nombre_usuario'] ?>
                  <span class="caret"></span>
                </a>
              <?php } else { ?>
                <a href="#" class="glyphicon glyphicon-user dropdown-toggle" data-toggle="dropdown" role="button"
                  aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
              <?php } ?>
              <ul class="dropdown-menu">
                <li><a href="formlogin.php">Iniciar sesión</a></li>
                <li><a href="formregister.php">Registrarse</a></li>
                <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                  <li><a href="usuario.php">Mi cuenta</a></li>
                  <li><a href="logout.php">Salir</a></li>
                <?php } ?>
              </ul>
            </li>
            <li>
              <a href="../carrito/carrito.php" class="glyphicon glyphicon-shopping-cart"> <span class="badge">
                  <?php if (!isset($_SESSION['usuario_info']) or empty($_SESSION['usuario_info'])) {

                  } else {
                    print cantidadProductos();
                  }
                  ?>
                </span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="container" id="main"><!-- formulario de inicio de sesion-->
    <div class="main-login">
      <form action="login.php" method="post">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="text-center">Iniciar sesion</h3>
          </div>
          <div class="panel-body">
            <p class="text-center">
              <img src="../../../assets/imagenes/logo.png" alt="" height="150" width="150">
            </p>
            <div class="form-group">
              <label>Usuario</label>
              <input type="text" class="form-control" name="nombre_usuario" placeholder="Usuario" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="clave" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
            <p class="text-center">No tienes una cuenta? <a href="formregister.php">Regístrate</a></p>
          </div>
        </div>
      </form>
    </div> <!-- /container -->
  </div>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <a href="../../../index.php">
            <img alt="Brand" src="../../../assets/imagenes/logo.png" height="75px" width="100px">
          </a>
          <span class="logo"></span>
        </div>
        <div class="col-sm-6">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../anizen/politica.php">Politica de privacidad</a></li>
            <li><a href="../anizen/avisolegal.php">Aviso legal</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>



  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../../../assets/js/jquery.min.js"></script>
  <script src="../../../assets/js/bootstrap.min.js"></script>

</body>

</html>