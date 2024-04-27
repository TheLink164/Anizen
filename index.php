<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once 'C:/xampp/htdocs/TFG/Anizen1/assets/includes/head.php'; ?>
</head>

<body>
  <header>
    <?php include_once 'C:/xampp/htdocs/TFG/Anizen1/assets/includes/header.php'; ?>
  </header>
  <div class="container" id="main"> <!-- Codigo para mostrar ultimos productos-->
    <h2 class="text-center mb-4">Novedades: Últimos productos</h2>
    <div class="row">
      <div class="col-md-12">
        &nbsp; <!-- Agregar un espacio vacío -->
      </div>
    </div>
    <div class="row">
      <?php
      require 'vendor/autoload.php';
      $producto = new Anizen\Producto;
      $info_producto = $producto->mostrarUltimos();
      $cantidad = count($info_producto);
      if ($cantidad > 0) {
        for ($x = 0; $x < $cantidad; $x++) {
          $item = $info_producto[$x];
      ?>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading" id="cabecera-producto">
                <h1 class="text-center titulo-Producto">
                  <?php print $item['titulo'] ?>
                </h1>
              </div>
              <div class="panel-body">
                <?php
                $foto = 'assets/upload/' . $item['foto'];
                if (file_exists($foto)) {
                ?>
                  <img src="<?php print $foto; ?>" class="img-responsive" style="width: 300px; height: 300px;">
                <?php } else { ?>
                  <img src="assets/imagenes/not-found.jpg" class="img-responsive" style="width: 300px; height: 300px;">
                <?php } ?>

              </div>
              <div class="panel-footer">
                <a href="src/paginas/carrito/carrito.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block">
                  <span class="glyphicon glyphicon-shopping-cart"></span>
                  <?php print $item['precio'] ?> € Comprar
                </a>
                <a href="src/paginas/productos/producto.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block">
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
    <div class="row">
      <div class="col-md-12">
        &nbsp; <!-- Agregar un espacio vacío -->
      </div>
    </div>
    <div class="row"><!-- Codigo enlaces directos a figuras y merchandising-->
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="text-center titulo-Producto">
              Figuras
            </h1>
          </div>
          <div class="panel-body">
            <a href="src/paginas/productos/figuras.php">
              <img src="assets/imagenes/figuras.png" class="img-responsive" style="width: 100%; height: 300px;">
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="text-center titulo-Producto">
              Merchandising
            </h1>
          </div>
          <div class="panel-body">
            <a href="src/paginas/productos/merchandising.php">
              <img src="assets/imagenes/Merchandising.png" class="img-responsive" style="width: 100%; height: 300px;">
            </a>
          </div>
        </div>
      </div>
    </div>
    <h2 class="text-center mb-4">Novedades: Últimos artículos</h2> <!-- Mostrar ultimos articulos-->
    <div class="row">
      <div class="col-md-12">
        &nbsp; <!-- Agregar un espacio vacío -->
      </div>
    </div>
    <div class="row">
      <?php
      $articulo = new Anizen\Articulo;
      $info_articulo = $articulo->mostrarUltimosArticulos();
      $cantidad_articulo = count($info_articulo);
      if ($cantidad_articulo > 0) {
        for ($x = 0; $x < $cantidad_articulo; $x++) {
          $item_articulo = $info_articulo[$x];
          $descripcion = $item_articulo['descripcion'];
          $descripcionLimitada = strlen($descripcion) > 300 ? substr($descripcion, 0, 300) . '...' : $descripcion;
      ?>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading" id="titulo-Articulo">
                <h2 class="text-center titulo-Articulo">

                  <?php
                  $titulo = $item_articulo['titulo'];
                  $tituloLimitado = strlen($titulo) > 100 ? substr($titulo, 0, 100) . '...' : $titulo;
                  print $tituloLimitado;
                  ?>
                </h2>
              </div>
              <div class="panel-body">
                <?php print $descripcionLimitada ?>
              </div>
              <div class="panel-footer">
                <a href="src/paginas/animes/articulo.php?id=<?php print $item_articulo['id'] ?>" class="btn btn-success btn-block">
                  <span class="glyphicon glyphicon-eye-open"></span> Leer artículo
                </a>
              </div>
            </div>
          </div>
        <?php
        }
      } else { ?>
        <h4>No hay artículos disponibles</h4>
      <?php } ?>
    </div>
  </div>

  <footer class="footer">
    <?php include_once 'assets/includes/footer.php' ?>
  </footer>

  <?php include_once 'assets/includes/js.php' ?>

</body>

</html>