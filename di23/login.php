<?php session_start();
$usuario = '';
$pass = '';
$mensa = '';
extract($_POST);
if ($usuario == '' || $pass == '') {
    $mensa = 'Debes completar los campos';
} else {
    require_once 'controladores/C_Usuarios.php';
    $objUsuarios = new C_Usuarios();
    $datos['usuario'] = $usuario;
    $datos['pass'] = $pass;
    $resultado = $objUsuarios->validarUsuario(
        array(
            'usuario' => $usuario,
            'pass' => $pass
        )
    );


    if ($resultado == 'S') {
        header('Location: index.php');
    } else {
        $mensa = 'Datos incorrectos';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    </script>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    </link>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>LOGIN</h1>
                <form method="post" id="formularioLogin" name="formularioLogin" method="post" action="login.php"
                    class="bg-light p-4 rounded">
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" class="form-control"
                            value="<?php echo $usuario; ?>">
                    </div>

                    <div class="form-group">
                        <label for="pass">Contraseña:</label>
                        <input type="password" id="pass" name="pass" class="form-control" value="<?php echo $pass; ?>">
                    </div>

                    <div class="mb-3">
                        <span id="msj" class="text-danger">
                            <?php echo $mensa; ?>
                        </span>
                    </div>
                    <button type="submit" id="aceptar" class="btn btn-primary">Aceptar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="js\Usuarios.js"></script>

</body>

</html>