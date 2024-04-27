<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
                            <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false">Anime
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <!-- Agrega la clase "dropdown-menu-right" aquí -->
                                <li><a href="../animes/blog.php">Blog</a></li>
                                <li><a href="../animes/calendario.php">Calendario</a></li>
                            </ul>
                        </li>
                        <li><a href="../contacto/contacto.php">Contacto</a></li>
                        <li><a href="conocenos.php">Conocenos</a></li>
                        <li><a href="../productos/tienda.php">Tienda</a></li>
                        <li class="dropdown">
                            <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    <?php print $_SESSION['usuario_info']['nombre_usuario'] ?>
                                    <span class="caret"></span>
                                </a>
                            <?php } else { ?>
                                <a href="#" class="glyphicon glyphicon-user dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
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
                            <a href="../carrito/carrito.php" class="glyphicon glyphicon-shopping-cart"> <span
                                    class="badge">
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
    <div class="container">
        <h1 class="text-center">¡Bienvenido a Anizen!</h1>
        <h3 class="text-center">Tu tienda online de merchandising anime</h3>
        <hr>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="text-justify">
                    En Anizen, nos apasiona el anime y queremos brindarte la mejor experiencia para que puedas encontrar
                    los productos de tus series y personajes favoritos. Somos un equipo de entusiastas del anime y
                    coleccionistas apasionados que han unido sus fuerzas para crear este espacio dedicado a los fans
                    como
                    nosotros.
                </p>
                <p class="text-justify">
                    Nuestro objetivo principal es ofrecerte una amplia selección de productos de alta calidad que
                    reflejen
                    la diversidad y la magia del mundo del anime. Desde figuras de acción hasta accesorios y
                    artículos para el hogar, nos esforzamos por proporcionarte una variedad de opciones para que puedas
                    expresar tu amor por tus series y personajes preferidos.
                </p>
                <p class="text-justify">
                    Trabajamos en estrecha colaboración con proveedores confiables y licenciatarios oficiales para
                    garantizar la autenticidad y la calidad de nuestros productos. Nos esforzamos por ofrecerte solo
                    artículos genuinos y con licencia para que puedas disfrutar de tus compras con tranquilidad y
                    confianza.
                </p>
                <p class="text-justify">
                    Además de ofrecerte productos de alta calidad, también nos dedicamos a brindarte una experiencia de
                    compra excepcional. Navegar por nuestro sitio web es fácil y rápido, y nuestro equipo de atención al
                    cliente está siempre disponible para ayudarte en cualquier consulta o duda que puedas tener. Nos
                    comprometemos a proporcionarte un servicio amigable, eficiente y confiable en cada paso del proceso
                    de compra, pudiendo ponerse en contacto con nosotros para cualquier problema con los pedidos.
                </p>
                <p class="text-justify">
                    En Anizen, valoramos a nuestros clientes y nos esforzamos por crear una comunidad en línea donde los
                    fans del anime puedan conectarse, compartir sus pasiones y descubrir nuevas series y personajes. A
                    través de nuestro blog , te mantendremos actualizado con las últimas
                    noticias
                    del mundo del anime, reseñas de productos y eventos especiales.
                </p>
                <p class="text-justify">
                    Gracias por elegir Anizen como tu tienda de merchandising anime. Nos enorgullece ser parte de la
                    comunidad del anime y esperamos ser tu destino favorito para encontrar los mejores productos que
                    representen tu amor por el mundo del anime. ¡Explora nuestra tienda y sumérgete en el apasionante
                    universo del anime!
                </p>
                <p class="text-justify">
                    ¡Que la magia del anime te acompañe siempre!
                </p>
                <p class="text-right">
                    El equipo de Anizen
                </p>
            </div>
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
                        <li><a href="politica.php">Politica de privacidad</a></li>
                        <li><a href="avisolegal.php">Aviso legal</a></li>
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