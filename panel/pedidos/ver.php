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
            <li class="active"><a href="index.php" class="btn">Pedidos</a></li>
            <li><a href="../productos/index.php" class="btn">Productos</a></li>
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

  <div class="container" id="main"> <!-- Se mostrara la informacion del pedido además de los datos del usuario que lo compro-->
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <?php
          require '../../vendor/autoload.php';
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
                      $foto = '../../assets/upload/' . $item['foto'];
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
          <a href="index.php" class="btn btn-default hidden-print">Cancelar</a>
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
          <a href="../ndex.php">
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
  <script>
    $('#btnImprimir').on('click', function () {

      window.print();

      return false;

    })

  </script>
</body>

</html>