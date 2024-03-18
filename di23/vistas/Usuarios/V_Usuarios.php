<div class="container mt-4">
    <h3>Buscar información</h3>
    <form id="formularioBuscar" name="formBuscar" class="mb-3 row form-inline">
        <div class="col-md mb-2">
            <label for="b_nombre" class="form-label mr-2">Nombre:</label>
            <input type="text" id="b_nombre" name="b_nombre" class="form-control mr-2" placeholder="Nombre">
        </div>
        <div class="col-md mb-2">
            <label for="b_apellido1" class="form-label mr-2">Apellido 1:</label>
            <input type="text" id="b_apellido1" name="b_apellido1" class="form-control mr-2" placeholder="Apellido 1">
        </div>
        <div class="col-md mb-2">
            <label for="b_apellido2" class="form-label mr-2">Apellido 2:</label>
            <input type="text" id="b_apellido2" name="b_apellido2" class="form-control mr-2" placeholder="Apellido 2">
        </div>
        <div class="col-md mb-2">
            <label for="b_sexo" class="form-label mr-2">Sexo:</label>
            <select id="b_sexo" name="b_sexo" class="form-control mr-2">
                <option value="">Seleccione</option>
                <option value="H">Masculino</option>
                <option value="M">Femenino</option>
            </select>
        </div>
        <div class="col-md mb-2">
            <label for="b_mail" class="form-label mr-2">Mail:</label>
            <input type="text" id="b_mail" name="b_mail" class="form-control mr-2" placeholder="Mail">
        </div>
        <div class="col-md mb-2">
            <label for="b_movil" class="form-label mr-2">Móvil:</label>
            <input type="text" id="b_movil" name="b_movil" class="form-control mr-2" placeholder="Móvil">
        </div>
        <div class="col-md mb-2">
            <label for="b_login" class="form-label mr-2">Login:</label>
            <input type="text" id="b_login" name="b_login" class="form-control mr-2" placeholder="Login">
        </div>
        <div class="col-md mb-2">
            <button type="button" class="btn btn-primary btn-sm" onclick="buscarUsuarios()">Buscar</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="buscarUsuarios2()">Todos</button>
        </div>
        <?php
if (isset($_SESSION['permisosUsuarios'])) {
    foreach ($_SESSION['permisosUsuarios'] as $permisoUsuario) {
        if ($permisoUsuario['rol'] == 'Administrador') {
            echo '<div class="col-md mb-2">';
            echo '<button type="button" class="btn btn-primary btn-sm" onclick="enseñarformulario()">Insertar/Modificar</button>';
            echo '</div>';
            break;
        }
    }
}
?>
    </form>
</div>

<!-- Segundo formulario -->
<div id="formcontenedor" class="container mt-4" style="display: none">
    <h3>Insertar Usuarios/Modificar</h3>
    <form id="formularioUsuarios" name="formUsuarios" class="mb-3 row form-inline">
        <div class="col-md mb-2">
            <label for="id_usuario" class="form-label mr-2">ID Usuario:</label>
            <input type="number" id="id_usuario" name="id_usuario" class="form-control mr-2" placeholder="ID Usuario"
                required>
        </div>
        <div class="col-md mb-2">
            <label for="nombre" class="form-label mr-2">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control mr-2" placeholder="Nombre" required>
        </div>
        <div class="col-md mb-2">
            <label for="apellido_1" class="form-label mr-2">Apellido 1:</label>
            <input type="text" id="apellido_1" name="apellido_1" class="form-control mr-2" placeholder="Apellido 1"
                required>
        </div>
        <div class="col-md mb-2">
            <label for="apellido_2" class="form-label mr-2">Apellido 2:</label>
            <input type="text" id="apellido_2" name="apellido_2" class="form-control mr-2" placeholder="Apellido 2"
                required>
        </div>
        <div class="col-md mb-2">
            <label for="sexo" class="form-label mr-2">Sexo:</label>
            <select id="sexo" name="sexo" class="form-control mr-2" required>
                <option value="">Seleccione</option>
                <option value="H">Masculino</option>
                <option value="M">Femenino</option>
            </select>
        </div>
        <div class="col-md mb-2">
            <label for="mail" class="form-label mr-2">Mail:</label>
            <input type="email" id="mail" name="mail" class="form-control mr-2" placeholder="Mail" required>
        </div>
        <div class="col-md mb-2">
            <label for="movil" class="form-label mr-2">Móvil:</label>
            <input type="tel" id="movil" name="movil" class="form-control mr-2" placeholder="Móvil" required>
        </div>
        <div class="col-md mb-2">
            <label for="login" class="form-label mr-2">Login:</label>
            <input type="text" id="login" name="login" class="form-control mr-2" placeholder="Login" required>
        </div>
        <div class="col-md mb-2">
            <label for="pass" class="form-label mr-2">Contraseña:</label>
            <input type="password" id="pass" name="pass" class="form-control mr-2" placeholder="Contraseña" required>
        </div>
        <div class="col-md mb-2">
            <label for="activo" class="form-label mr-2">Activo:</label>
            <select id="activo" name="activo" class="form-control mr-2" required>
                <option value="S">Sí</option>
                <option value="N">No</option>
            </select>
        </div>
        <div class="col-md mb-2">
            <button type="button" class="btn btn-primary btn-sm"
                onclick="InsertarActualizarUsuarios()">Actualizar</button>
        </div>
    </form>
</div>

<div id="capaResultadosBusqueda">
    <!-- Aquí se mostrarán los resultados de la búsqueda -->
</div>
</div>
