<?php
//ACTIVAR LAS SESSIONES EN PHP
session_start();
if (!isset($_SESSION['usuario_info']) or empty($_SESSION['usuario_info']))
    header('Location: ../usuario/formlogin.php');
require '../productos/funciones.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    require '../../../vendor/autoload.php';
    $producto = new Anizen\Producto;
    $resultado = $producto->mostrarPorId($id);

    if (!$resultado)
        header('Location: ../../../index.php');
    if (isset($_SESSION['carrito'])) { //SI EL CARRITO EXISTE
        //SI EL Producto EXISTE EN EL CARRITO
        if (array_key_exists($id, $_SESSION['carrito'])) {
            actualizarProducto($id);
        } else {
            //  SI EL CARRITO NO EXISTE EN EL CARRITO
            agregarProducto($resultado, $id);
        }
    } else {
        //  SI EL CARRITO NO EXISTE
        agregarProducto($resultado, $id);
    }
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
                                <li><a href="../usuario/formlogin.php">Iniciar sesión</a></li>
                                <li><a href="../usuario/formregister.php">Registrarse</a></li>
                                <?php if (isset($_SESSION['usuario_info']['nombre_usuario'])) { ?>
                                    <li><a href="../usuario/usuario.php">Mi cuenta</a></li>
                                    <li><a href="../usuario/logout.php">Salir</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="carrito.php" class="glyphicon glyphicon-shopping-cart"> <span
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
    <div class="container" id="main"> <!-- Toda la informacion del carrito-->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Foto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    $c = 0;
                    foreach ($_SESSION['carrito'] as $indice => $value) {
                        $c++;
                        $total = $value['precio'] * $value['cantidad'];
                        ?>
                        <tr>
                            <form action="actualizar_carrito.php" method="post">
                                <td>
                                    <?php print $c ?>
                                </td>
                                <td>
                                    <?php print $value['titulo'] ?>
                                </td>
                                <td>
                                    <?php
                                    $foto = '../../../assets/upload/' . $value['foto'];
                                    if (file_exists($foto)) {
                                        ?>
                                        <img src="<?php print $foto; ?>" width="35">
                                    <?php } else { ?>
                                        <img src="../../../assets/imagenes/not-found.jpg" width="35">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php print $value['precio'] ?> €
                                </td>
                                <td>
                                    <input type="hidden" name="id" value="<?php print $value['id'] ?>">
                                    <input type="text" name="cantidad" class="form-control u-size-100"
                                        value="<?php print $value['cantidad'] ?>">
                                </td>
                                <td>
                                    <?php print $total ?> €
                                </td>
                                <td>

                                    <a href="../productos/producto.php?id=<?php print $value['id'] ?>"
                                        class="btn btn-success btn-xs">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>

                                    <button type="submit" class="btn btn-success btn-xs">
                                        <span class="glyphicon glyphicon-refresh"></span>
                                    </button>

                                    <a href="eliminar_carrito.php?id=<?php print $value['id'] ?>" class="btn btn-danger btn-xs">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>


                                </td>
                            </form>
                        </tr>

                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">NO HAY PRODUCTOS EN EL CARRITO</td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">Total</td>
                    <td>
                        <?php print calcularTotal(); ?> €
                    </td>
                    <td></td>
                </tr>

            </tfoot>
        </table>
        <hr>
        <?php
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            ?>
            <div class="row">
                <div class="pull-left">
                    <a href="../productos/tienda.php" class="btn btn-info">Ir a la tienda</a>
                </div>
                <div class="pull-right" id="paypal-button-container">
                </div>

            </div>

            <?php
        }
        ?>


    </div> <!-- /container -->
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
    <script
        src="https://www.paypal.com/sdk/js?client-id=Ad2zbmpouvUaxqL1Nk60lTent15wal7r5-eSm4-C0EkzRixYVhxdyY5Nov7LfNTqL0nxqMc3nNUU0A_7&currency=EUR"></script>
    <script>
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php print calcularTotal(); ?>
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (orderData) {
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    window.location.href = "../pedido/completar_pedido.php";
                });
            }
        }).render('#paypal-button-container');
    </script>

</body>

</html>