<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php
session_start();

if (!isset($_SESSION['usuario_info']) or empty($_SESSION['usuario_info']))
  header('Location: ../index.php');
?>
<?php

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

  <div class="container" id="main">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <?php
          require '../../../vendor/autoload.php';
          $id = $_GET['id'];
          $pedido = new Anizen\Pedido;

          $info_pedido = $pedido->mostrarPedidoPorId($id);

          $info_detalle_pedido = $pedido->mostrarDetallePorIdPedido($id);
          ?>
          <legend>Información de la Compra</legend>
          <div class="form-group">
            <label>Nombre</label>
            <input value="<?php print $info_pedido['nombre_usuario'] ?>" type="text" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input value="<?php print $info_pedido['email'] ?>" type="text" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Fecha</label>
            <input value="<?php print $info_pedido['fecha'] ?>" type="text" class="form-control" readonly>
          </div>
          <hr>
          Productos Comprados
          <hr>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Titulo</th>
                <th>Foto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>
                  Total
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $cantidad = count($info_detalle_pedido);
              if ($cantidad > 0) {
                $c = 0;
                for ($x = 0; $x < $cantidad; $x++) {
                  $c++;
                  $item = $info_detalle_pedido[$x];
                  $total = $item['precio'] * $item['cantidad'];
                  ?>
                  <tr>
                    <td>
                      <?php print $c ?>
                    </td>
                    <td>
                      <?php print $item['titulo'] ?>
                    </td>
                    <td>
                      <?php
                      $foto = '../../../assets/upload/' . $item['foto'];
                      if (file_exists($foto)) {
                        ?>
                        <img src="<?php print $foto; ?>" width="35">
                      <?php } else { ?>
                        SIN FOTO
                      <?php } ?>
                    </td>
                    <td>
                      <?php print $item['precio'] ?>€
                    </td>
                    <td>
                      <?php print $item['cantidad'] ?>
                    </td>
                    <td>
                      <?php print $total ?>
                    </td>
                  </tr>
                  <?php
                }
              } else {
                ?>
                <tr>
                  <td colspan="6">NO HAY REGISTROS</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="col-md-3">
            <div class="form-group">
              <label>Total Compra</label>
              <input value="<?php print $info_pedido['total'] ?>" type="text" class="form-control" readonly>
            </div>
          </div>
        </fieldset>
        <div class="pull-left">
          <a href="../usuario/usuario.php" class="btn btn-default hidden-print">Cancelar</a>
        </div>
        <div class="pull-right">
          <a href="javascript:;" id="btnImprimir" class="btn btn-danger hidden-print">Imprimir</a>
        </div>
      </div>
    </div>
  </div> <!-- /container -->

  <footer class="footer hidden-print">
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
    $('#btnImprimir').on('click', function () {

      window.print();

      return false;

    })

  </script>
</body>

</html>