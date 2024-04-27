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
        <h1>Política de privacidad</h1>

        <h2>PRIMERA: PROTECCIÓN DE DATOS</h2>
        <p>En relación con los datos de carácter personal facilitados por el cliente con ocasión de la solicitud de un
            pedido a través de la Web, Anizen S.L. cumple
            estrictamente la normativa vigente establecida en la Ley 15/1999 de Protección de datos de carácter personal
            y demás legislación que la desarrolla, e informa al cliente que los referidos datos serán incluidos dentro
            de un fichero para su tratamiento automatizado, prestando el cliente consentimiento mediante la aceptación
            de estas condiciones generales a dicho tratamiento, para la tramitación del pedido, para el envío de
            publicidad y para la solicitud de información sobre productos y servicios y elevar la calidad del servicio.
            Anizen asegura
            la absoluta confidencialidad y privacidad de los datos personales recogidos. Sin embargo, no puede
            garantizar plenamente la invulnerabilidad absoluta de sus sistemas de seguridad puesto que ninguna medida de
            seguridad que se instale puede ser en la actualidad inquebrantable, por tanto Anizen no será responsable en
            ningún caso de las incidencias que puedan surgir en torno a los datos personales cuando se deriven bien de
            un ataque o acceso no autorizado a nuestros sistemas, de tal forma que sea imposible detectarlo por sus
            sistemas de seguridad.</p>

        <h2>SEGUNDA: DIRECCIONES IP</h2>
        <p>Anizen registra las direcciones IP (que todo visitante tiene en el momento del acceso al website) para fines
            exclusivamente internos, tales como estadísticas de acceso y segmentación de mercado. Anizen no asocia
            direcciones IP con información identificable personalmente, pudiendo facilitar a terceros extractos
            informativos del tráfico a este website que no afectan al anonimato del usuario, con datos sobre el número
            de visitas a una determinada sección del sitio, flujos y tendencias del tráfico, etc.</p>
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