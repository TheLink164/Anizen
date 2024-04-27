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
    <style>
        body {
            padding-bottom: 70px;
            /* Adjust this value to prevent content from being hidden behind the footer */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 100px;
            /* Adjust this value to match the height of your footer */
            background-color: #FFA500;
            padding-top: 25px;
            padding-bottom: 25px;
        }

        .footer .logo {
            font-weight: bold;
            font-size: 24px;
        }

        .footer ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .footer ul li {
            display: inline;
            margin-right: 10px;
        }
    </style>
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
        <h1>Aviso Legal</h1>
        <p>En cumplimiento con el deber de información recogido en artículo 10 de la Ley 34/2002, de 11 de julio, de
            Servicios de la Sociedad de la Información y del Comercio Electrónico a continuación se declara Anizen como
            un sitio web personal gestionado con domicilio en la Avda Blas Infante 2-3 Entreplanta I1, 11201, Algeciras
            (Cádiz)</p>

        <h2>Responsabilidad</h2>
        <p>Toda persona que acceda a este sitio web asume el papel de usuario, comprometiéndose a la observancia y
            cumplimiento riguroso de las disposiciones aquí dispuestas, así como a cualquier otra disposición legal que
            fuera de aplicación.</p>

        <p>El prestador se exime de cualquier tipo de responsabilidad derivada de la información publicada en su sitio
            web y por la falta de disponibilidad (caídas) del sitio el cual efectuará además paradas periódicas por
            mantenimientos técnicos. Además, el prestador se reserva el derecho a modificar cualquier tipo de
            información que pudiera aparecer en el sitio web, sin que exista obligación de preavisar o poner en
            conocimiento de los usuarios dichas obligaciones, entendiéndose como suficiente con la publicación en el
            sitio web del prestador.</p>


        <p>Desde el sitio web del cliente es posible que se redirija a contenidos de terceros sitios web. Dado que el
            prestador no puede controlar siempre los contenidos introducidos por los terceros en sus sitios web, éste no
            asume ningún tipo de responsabilidad respecto a dichos contenidos. En todo caso, el prestador se compromete
            a la retirada inmediata de cualquier contenido que pudiera contravenir la legislación nacional o
            internacional, la moral o el orden público, procediendo a la retirada inmediata de la redirección a dicho
            sitio web, poniendo en conocimiento de las autoridades competentes el contenido en cuestión.</p>

        <h2>Protección de datos personales</h2>
        <p>El prestador cumple con la normativa española de protección de datos de carácter personal, y garantiza el
            cumplimiento íntegro de las obligaciones dispuestas la Ley Orgánica 15/1999, de 13 de diciembre, de
            Protección de Datos de Carácter Personal (LOPD), el Real Decreto 1720/2007, de 21 de diciembre, por el que
            se aprueba el Reglamento de desarrollo de la LOPD y demás normativa vigente en cada momento, y vela por
            garantizar un correcto uso y tratamiento de los datos personales del usuario.</p>

        <h2>Política anti-spam</h2>
        <p>El prestador se declara completamente en contra del envío de comunicaciones comerciales no solicitadas y a
            cualquier tipo de conducta o manifestación conocida como “spam”, asimismo se declara comprometido con la
            lucha contra este tipo de prácticas abusivas.</p>

        <p>Por tanto, el prestador garantiza al usuario a que bajo ningún concepto los datos personales recogidos en el
            sitio web serán cedidos, compartidos, transferidos, ni vendidos a ningún tercero.</p>

        <p>Por las mismas razones, el proceso de registro no debe ser utilizado para inscribir direcciones de correo de
            personas ajenas sin el consentimiento expreso de las personas afectadas. Anizen implementa como contramedida
            a esta prácticas una lista de correo de tipo double opt-in que necesita la confirmación explicita por parte
            del titular de la cuenta de correo electrónico indicada como dirección de suscripción, antes de recibir
            comunicaciones por correo electrónico.</p>

        <p>En el caso de que aun así un usuario reciba comunicaciones de este sitio web sin haberse registrado, o sin
            haber dado su consentimiento expreso a dicho registro, puede cancelar la suscripción desde los enlaces que
            se proporcionan en la propia comunicación.</p>

        <p>Además, el usuario puede ponerse en contacto con nosotros a través del formulario de contacto que se mantiene
            en el sitio web, tanto para comunicar lo sucedido como para solicitar la eliminación inmediata de sus datos
            de nuestro sistema.</p>

        <h2>Alojamiento de datos</h2>
        <p>Por razones técnicas y de calidad de servicio, el blog Anizen se encuentra alojado en los servidores de la
            empresa Raiola Networks (política de privacidad). Por las razones similares, la prestación del servicio de
            suscripción por correo electrónico y envío de newsletter se efectúa desde las instalaciones de la empresa
            MailChimp (política de privacidad).</p>

        <p>Tanto Godaddy como Mailchimp se encuentran adheridas a los principios de “Puerto Seguro” (Safe Harbor), de
            acuerdo con la Decisión 2000/520/CE de la Comisión de 26 de julio de 2000 lo que las convierte entidades con
            un nivel adecuado de protección a efectos de la LOPD.</p>

        <h2>Google Analytics</h2>
        <p>Google Analytics es un servicio análisis de datos estadísticas prestado por la empresa Google (política de
            privacidad). Anizen utiliza este servicio para realizar un seguimiento de las estadísticas de uso del mismo.
        </p>

        <p>Google Analytics utiliza cookies para ayudar al sitio web a analizar datos estadísticos sobre el uso del
            mismo (número de visitas totales, páginas más vistas, etc.). La información que genera la cookie (incluyendo
            su dirección IP) será directamente transmitida y archivada por Google en los servidores de Estados Unidos.
        </p>

        <p>Google usará esta información por cuenta nuestra con el propósito de generar información estadísticas sobre
            el uso de Anizen, Google no asociará su dirección IP con ningún otro dato del que disponga Google. Google
            podrá transmitir dicha información a terceros cuando así se lo requiera la legislación, o cuando dichos
            terceros procesen la información por cuenta de Google.</p>

        <p>Puede usted rechazar el tratamiento de los datos o la información rechazando el uso de cookies mediante la
            selección de la configuración apropiada de su navegador, sin embargo, de hacerlo, limitará la plena
            funcionabilidad de Anizen. Al utilizar este sitio web, da su consentimiento al tratamiento de información
            por
            Google en la forma y para los fines arriba indicados.</p>

        <h2>Consentimiento al tratamiento de los datos personales del usuario</h2>
        <p>En el marco de sus actividades, Anizen dispone de la posibilidad de registro de usuarios para el envío de
            comunicaciones electrónicas incluyendo boletines (newsletters), invitaciones a cursos online sin coste
            (webinar), nuevas entradas (posts), nuevos cursos y otras promociones.</p>

        <p>El usuario mediante los actos de suscripción al blog, la realización comentarios o el formulario de contacto
            estará dando su consentimiento expreso al tratamiento de los personales proporcionados según lo dispuesto en
            el artículo 6 de la LOPD. El usuario podrá ejercer sus derechos en los términos dispuestos por el artículo 5
            de la LOPD.</p>

        <p>Estos mismos actos implican asimismo el consentimiento expreso del usuario a la transferencia internacional
            de datos que se produce en términos de la LOPD debido a la ubicación física de las instalaciones de los
            proveedores arriba mencionados.</p>

        <p>Los datos de carácter personal solicitados en estas actividades, quedarán incorporados a un fichero cuya
            finalidad es la comunicación de novedades relativas al sitio web de Anizen, boletines (newsletters),
            invitaciones a cursos online sin coste (webinar), nuevas entradas (posts), nuevos cursos y otras
            promociones, actuando como responsable del fichero el prestador. Los campos marcados con asterisco son de
            cumplimentación obligatoria, siendo imposible realizar la finalidad expresada si no se aportan estos datos.
            Queda igualmente informado de la posibilidad de ejercitar los derechos que se indican en el apartado
            relativo a los Derechos del usuario.</p>

        <h2>Derechos del usuario</h2>
        <p>De conformidad con lo establecido en el artículo 5 de la LOPD, se informa al usuario que la finalidad
            exclusiva de la base de datos de registro es el envío de información sobre novedades relacionadas con el
            sitio web Anizen, informar de cursos y realizar promociones. Únicamente los titulares tendrán acceso a sus
            datos, y bajo ningún concepto, estos datos serán cedidos, compartidos, transferidos, ni vendidos a ningún
            tercero.</p>

        <p>De acuerdo con lo dispuesto en la LOPD, el usuario en cualquier momento podrá ejercitar sus derechos de
            acceso, rectificación, cancelación, y oposición ante el prestador.</p>

        <p>Para facilitar el ejercicio de estos derechos se facilita en todas las comunicaciones un enlace de solicitud
            de baja que redundará en la eliminación inmediata de los datos personales del usuario de nuestra base de
            datos.</p>

        <h2>Propiedad intelectual y uso de los contenidos</h2>
        <p>El sitio web Anizen, incluyendo a título enunciativo pero no limitativo su programación, edición, compilación
            y demás elementos necesarios para su funcionamiento, los diseños, logotipos, texto y/o gráficos, son
            propiedad del prestador o en su caso dispone de licencia o autorización expresa por parte de los autores.
        </p>

        <p>En cualquier caso, el prestador cuenta con la autorización expresa y previa por parte de los mismos. Se
            prohíbe cualquier uso no autorizado previamente por parte del prestador. Cualquier uso no permitido será
            debidamente perseguido por los legítimos propietarios.</p>

        <h2>Modificación de las presentes condiciones y duración</h2>
        <p>Anizen podrá modificar en cualquier momento las condiciones aquí determinadas, siendo debidamente publicadas
            como aquí aparecen.</p>

        <p>La vigencia de las citadas condiciones irá en función de su exposición y estarán vigentes hasta debidamente
            publicadas. que sean modificadas por otras debidamente publicadas.</p>

        <h2>Ley aplicable y jurisdicción</h2>
        <p>La relación entre el prestador y el usuario se regirá por la normativa española vigente y cualquier
            controversia se someterá a los Juzgados y tribunales de la ciudad de Algeciras.</p>
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