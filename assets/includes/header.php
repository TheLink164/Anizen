<nav class="navbar navbar-default"> <!--Le ponemos clase navbar navbar-default de bootstrap para que sea una barra de navegación, y le ponemos el navbar-default para el diseño del mismo-->
  <div class="container"><!--Lo metemos todo dentro de un container, es decir de un contenedor -->
    <div class="navbar-header"> <!-- le pasamos la clase navbar-header para que coja el estilo de una cabecera -->
      <!-- Logo -->
      <a href="http://localhost/TFG/Anizen1/index.php">
        <img alt="Brand" src="http://localhost/TFG/Anizen1/assets/imagenes/logo.png" height="75px" width="100px">
      </a>
      <!-- Le ponemos las siguientes clases para crear un menu hamburguesa para dispositivos moviles-->
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
            <li><a href="http://localhost/TFG/Anizen1/panel/index.php">Panel</a></li>
        <?php }
        } ?>
        <li class="dropdown">
          <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Anime
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="http://localhost/TFG/Anizen1/src/paginas/animes/blog.php">Blog</a></li>
            <li><a href="http://localhost/TFG/Anizen1/src/paginas/animes/calendario.php">Calendario</a></li>
          </ul>
        </li>
        <li><a href="http://localhost/TFG/Anizen1/src/paginas/contacto/contacto.php">Contacto</a></li>
        <li><a href="http://localhost/TFG/Anizen1/src/paginas/anizen/conocenos.php">Conocenos</a></li>
        <li><a href="http://localhost/TFG/Anizen1/src/paginas/productos/tienda.php">Tienda</a></li>
        <li class="dropdown">
          <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php print $_SESSION['usuario_info']['nombre_usuario'] ?>
              <span class="caret"></span>
            </a>
          <?php } else { ?>
            <a href="#" class="glyphicon glyphicon-user dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
          <?php } ?>
          <ul class="dropdown-menu">
            <li><a href="http://localhost/TFG/Anizen1/src/paginas/usuario/formlogin.php">Iniciar sesión</a></li>
            <li><a href="http://localhost/TFG/Anizen1/src/paginas/usuario/formregister.php">Registrarse</a></li>
            <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
              <li><a href="http://localhost/TFG/Anizen1/src/paginas/usuario/usuario.php">Mi cuenta</a></li>
              <li><a href="http://localhost/TFG/Anizen1/src/paginas/usuario/logout.php">Salir</a></li>
            <?php } ?>
          </ul>
        </li>
        <li>
          <a href="http://localhost/TFG/Anizen1/src/paginas/carrito/carrito.php" class="glyphicon glyphicon-shopping-cart"> <span class="badge">
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