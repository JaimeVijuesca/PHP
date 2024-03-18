<?php
if (is_array($datos) && !empty ($datos)) {
    foreach ($datos as $permiso) {
        if (empty ($permiso['codigos']) && empty ($permiso['permiso'])) {
            echo "<div class='alert alert-warning'>No hay permisos.</div>";
            echo "<button class='btn btn-success' onclick='crear()'>Crear</button>";
        } else {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Id permiso: " . $permiso['id_permiso'] . "</h5>";
            echo "<p class='card-text'>Codigo: " . $permiso['codigos'] . "</p>";
            echo "<p class='card-text'>Permiso: " . $permiso['permiso'] . "</p>";
            echo "<button class='btn btn-success' onclick='crear()'>Crear</button>";
            echo "<button class='btn btn-warning' onclick='editarPermisosMenu(\"" . $permiso['id_permiso'] . "\")'>Editar</button>";
            echo "<button class='btn btn-danger' onclick='eliminarPermisos(\"" . $permiso['id_permiso'] . "\")'>Eliminar</button>";
            echo "</div>";
            echo "</div>";
        }
    }
} else {
    echo "<div class='alert alert-danger'>No se proporcionaron datos.</div>";
}
?>