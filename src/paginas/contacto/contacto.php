<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'C:/xampp/htdocs/TFG/Anizen1/assets/includes/head.php'; ?>
</head>

<body>
    <header>
        <?php include_once 'C:/xampp/htdocs/TFG/Anizen1/assets/includes/header.php'; ?>
    </header>
    <div class="container"> <!-- Formulario de contacto-->
        <div class="text-center">
            <h2>Contacto</h2>
        </div>
        <form action="envioCorreo.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email">
            </div>
            <div class="form-group">
                <label for="Asunto">Asunto:</label>
                <textarea class="form-control" id="asunto" name="asunto" placeholder="Ingrese el asunto"></textarea>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea class="form-control" id="mensaje" name="mensaje" placeholder="Ingrese su mensaje"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
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