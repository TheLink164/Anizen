<?php

session_start();
require '../productos/funciones.php';

if (!isset($_SESSION['usuario_info']) or empty($_SESSION['usuario_info']))
    header('Location: index.php');
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
                        <li><a href="../anizen/conocenos.php">Conocenos</a></li>
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
                                <li><a href="formlogin.php">Iniciar sesión</a></li>
                                <li><a href="formregister.php">Registrarse</a></li>
                                <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                                    <li><a href="usuario.php">Mi cuenta</a></li>
                                    <li><a href="logout.php">Salir</a></li>
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
        <?php
        $nombre = $_SESSION['usuario_info']['nombre_usuario'];
        $email = $_SESSION['usuario_info']['email'];
        $telefono = $_SESSION['usuario_info']['telefono'];
        $direccion = $_SESSION['usuario_info']['direccion'];
        $id = $_SESSION['usuario_info']['id'];
        ?>
        <h1>Datos del Usuario</h1>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Información del Usuario</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" value="<?php echo $nombre; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?php echo $email; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" class="form-control" value="<?php echo $telefono; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Direccion</label>
                    <input type="tel" class="form-control" value="<?php echo $direccion; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Pedidos anteriores</legend>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>N° Pedido</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../../../vendor/autoload.php';
                            $pedido = new Anizen\Pedido;
                            $info_pedido = $pedido->mostrarPedidoPorIdUsuario($id);
                            $cantidad = count($info_pedido);
                            if ($cantidad > 0) {
                                $c = 0;
                                for ($x = 0; $x < $cantidad; $x++) {
                                    $c++;
                                    $item = $info_pedido[$x];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php print $c ?>
                                        </td>
                                        <td>
                                            <?php print $item['id'] ?>
                                        </td>
                                        <td>
                                            <?php print $item['total'] ?>€
                                        </td>
                                        <td>
                                            <?php print $item['fecha'] ?>
                                        </td>

                                        <td class="text-center">
                                            <a href="../pedido/ver.php?id=<?php print $item['id'] ?>"
                                                class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-eye-open"></span>
                                            </a>
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
                </fieldset>
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