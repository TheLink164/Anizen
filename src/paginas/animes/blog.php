<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once 'C:/xampp/htdocs/TFG/Anizen1/assets/includes/head.php'; ?>
</head>

<body>
  <header>
    <?php include_once 'C:/xampp/htdocs/TFG/Anizen1/assets/includes/header.php'; ?>
  </header>

  <div class="container">
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
    <div class="row">
      <div class="col-md-12">
        &nbsp; <!-- Agregar un espacio vacío -->
      </div>
    </div>
  </div>


  <div class="container">
    <div class="row">
      <?php
      require '../../../vendor/autoload.php';
      $articulo = new Anizen\Articulo;
      $info_articulo = $articulo->mostrarArticulos();
      $cantidad_articulo = count($info_articulo);

      // Verificar si se ha enviado el formulario de búsqueda
      if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];

        // Filtrar los resultados según el término de búsqueda
        $info_articulo = array_filter($info_articulo, function ($item) use ($searchTerm) {
          return stripos($item['titulo'], $searchTerm) !== false || stripos($item['descripcion'], $searchTerm) !== false;
        });


      } ?>
      <?php
      if (count($info_articulo) > 0) {
        foreach ($info_articulo as $item_articulo) {
          ?>
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading" id="cabecera-producto">
                <h1 class="text-center titulo-Producto">
                  <?php print $item_articulo['titulo'] ?>
                </h1>
              </div>
              <div class="panel-body">
                <?php print $item_articulo['descripcion'] ?>
              </div>
              <div class="panel-footer">
                <a href="articulo.php?id=<?php print $item_articulo['id'] ?>" class="btn btn-success btn-block">
                  <span class="glyphicon glyphicon-eye-open"></span> Leer artículo
                </a>
              </div>

            </div>
          </div>
          <?php
        }
      } else {
        ?>
        <h4>No se encontraron artículos con el término de búsqueda proporcionado.</h4>
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