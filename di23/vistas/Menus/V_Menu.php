<!DOCTYPE html>
<html>

<body>

    <div class="container text-center">
        <form class="mb-3" id="mirarMenu">
            <div class="col-md mb-2">
                <div class="col-sm-10 offset-sm-1 text-center">
                    <div style="display: inline-block;">
                        <button type="button" class="btn btn-outline-success mt-4" onclick="enviarMenu()">Mirar
                            Menu</button>
                    </div>

                    <div style="display: inline-block;">
                        <select id="roles" name="roles">
                            <option value="">Sin activar</option>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?php echo $rol['id_rol']; ?>">
                                    <?php echo $rol['rol']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select id="usuarios" name="usuarios">
                            <option value="">Sin activar</option>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario['id_Usuario']; ?>">
                                    <?php echo $usuario['nombre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="capaResultadosBusqueda" style="display: none">
        <!-- Aquí se mostrarán los resultados de la búsqueda -->
    </div>

</body>

</html>