<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once 'C:/xampp/htdocs/TFG/Anizen1/assets/includes/head.php'; ?>
</head>

<body>
  <header>
    <?php include_once 'C:/xampp/htdocs/TFG/Anizen1/assets/includes/header.php'; ?>
  </header>
  <div class="container" id="main">
    <?php
    require '../../../vendor/autoload.php';
    ?>
    <div class="row">
      <div class="text-center">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1 class="text-center titulo-Articulo">
                <?php print $resultado['nombre'] ?>
              </h1>
            </div>
            <div class="panel body">
              <div class="text center">
                <h2>Sinopsis</h2>
              </div>
              <?php print $resultado['trama'] ?>
            </div>
            <div class="panel-footer">

              <a href="calendario.php" class="btn btn-info">Volver al calendario</a>

            </div>
          </div>
        </div>
      </div>
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