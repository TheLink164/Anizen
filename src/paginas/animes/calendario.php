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
    <h2>Calendario Semanal de Anime</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Anime</th>
          <th>Lunes</th>
          <th>Martes</th>
          <th>Miércoles</th>
          <th>Jueves</th>
          <th>Viernes</th>
          <th>Sábado</th>
          <th>Domingo</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require '../../../vendor/autoload.php';
        $anime = new Anizen\Anime;

        // Recorrer las IDs de anime desde 1 hasta la última ID existente
        for ($id = 11; $id <= 20; $id++) {
          $info_anime = $anime->mostrarPorId($id);
          ?>
          <tr>
            <th>
              <a href="anime.php?id=<?php echo $info_anime['id']; ?>">
                <?php echo $info_anime['nombre']; ?>
              </a>
            </th>
            <?php
            // Generar las celdas de los días de la semana
            $dias_semana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
            foreach ($dias_semana as $dia) {
              echo "<th>";
              if ($dia == $info_anime['dia']) {
                echo "X";
              }
              echo "</th>";
            }
            ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
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