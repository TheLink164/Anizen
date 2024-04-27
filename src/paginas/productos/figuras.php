<?php
session_start();
require 'funciones.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);
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
            <li><a href="tienda.php">Tienda</a></li>
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
                <li><a href="../usuario/formlogin.php">Iniciar sesión</a></li>
                <li><a href="../usuario/formregister.php">Registrarse</a></li>
                <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                  <li><a href="../usuario/usuario.php">Mi cuenta</a></li>
                  <li><a href="../usuario/logout.php">Salir</a></li>
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

  <div class="container"> <!-- Buscador -->
    <div class="row">
      <div class="col-md-12">
        <form class="form-inline text-right" method="GET" action="">
          <div class="form-group">
            <label for="search">Buscar por título o descripción:</label>
            <input type="text" class="form-control" id="search" name="search"
              placeholder="Ingrese el término de búsqueda">
          </div>
          <button type="submit" class="btn btn-primary">Buscar</button>
          <button type="button" class="btn btn-default" id="resetBtn">Resetear</button> <!-- Botón de Resetear -->
        </form>
      </div>
    </div>

  </div>
  <div class="container" id="main"> <!-- mostrar todas las figuras -->
    <div class="row">
      <?php
      require '../../../vendor/autoload.php';
      $producto = new Anizen\Producto;
      $categoria_id = 1; // Reemplaza con el ID de categoría correcto
      $info_producto = $producto->mostrarProductosPorCategoria($categoria_id);
      $cantidad = count($info_producto);

      // Verificar si se ha enviado el formulario de búsqueda
      if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];

        // Filtrar los resultados según el término de búsqueda
        $info_producto = array_filter($info_producto, function ($item) use ($searchTerm) {
          return stripos($item['titulo'], $searchTerm) !== false || stripos($item['nombre_anime'], $searchTerm) !== false;
        });

        // Verificar si no hay resultados
        if (empty($info_producto)) {
          echo "<h4>No se encontraron resultados para la búsqueda: $searchTerm</h4>";
        }
      }

      if ($cantidad > 0) {
        foreach ($info_producto as $item_producto) {

          ?>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading" id="cabecera-producto">
                <h1 class="text-center titulo-Producto">
                  <?php print $item_producto['titulo'] ?>
                </h1>
              </div>
              <div class="panel-body">
                <?php
                $foto = '../../../assets/upload/' . $item_producto['foto'];
                if (file_exists($foto)) {
                  ?>
                  <img src="<?php print $foto; ?>" class="img-responsive" style="width: 300px; height: 300px;">
                <?php } else { ?>
                  <img src="../../../assets/imagenes/not-found.jpg" class="img-responsive"
                    style="width: 300px; height: 300px;">
                <?php } ?>
              </div>
              <div class="panel-footer">
                <a href="../carrito/carrito.php?id=<?php print $item_producto['productos_id'] ?>"
                  class="btn btn-success btn-block">
                  <span class="glyphicon glyphicon-shopping-cart"></span>
                  <?php print $item_producto['precio'] ?> € Comprar
                </a>
                <a href="producto.php?id=<?php print $item_producto['productos_id'] ?>" class="btn btn-success btn-block">
                  <span class="glyphicon glyphicon-eye-open"></span> Ver detalles
                </a>
              </div>
            </div>
          </div>
          <?php
        }
      } else { ?>
        <h4>NO HAY REGISTROS</h4>
      <?php } ?>
    </div>


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
  <script>
    $(document).ready(function () {
      // Capturar el evento de clic en el botón de reinicio
      $('#resetBtn').click(function () {
        // Limpiar el valor del campo de búsqueda
        $('#search').val('');

        // Enviar el formulario de búsqueda vacío
        $('form').submit();
      });
    });
  </script>
</body>

</html>