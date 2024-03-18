<?php session_start();
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != '') {
    //esta logeado
} else {
    session_unset();
    session_destroy();
    //header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    </link>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/menu.css">
    <script src="js/app.js"></script>
    <script src="js/Usuarios.js"></script>
    <script src="..\di23\js\Menu.js"></script>
</head>

<body onload="cargarMenu()">
    <section id="secEncabezadoPagina" class="container-fluid">
        <div class="row">
            <div class="divLogotipo col-lg-2 col-md-2 col-sm-10">
                <img src="imagenes/img.png" class="img-fluid" alt="Logo">
            </div>
            <div class="divTituloApp col-lg-2 col-md-2">Jaime Vijuesca Fraca.</div>
            <div class="divLog col-lg-2 col-md-2 col-sm-2">
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo '<a href="logout.php" title="Salir">';
                    echo '<img src="imagenes\logout.png" alt="Logout">';
                    echo '</a>';
                } else {
                    echo '<a href="login.php" title="Entrar">';
                    echo '<img src="imagenes\person-circle.svg" alt="Login">';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
    </section>
    <section id="newMenu">

    </section>
    <section id="secContenidoPagina" class="container-fluid">

    </section>





    <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>