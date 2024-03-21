<?php
//var_dump($datos);
$roles = $datos['listaMenuRolesUsuarios'];
$usuarios = $datos['rolesUsuario'];

// Bootstrap CSS




// Display the role
if (isset($usuarios[0]['rol'])) {
    echo '<h2 class="mb-4">Role: ' . $usuarios[0]['rol'] . '</h2>';
} else {
    echo '<h2 class="mb-4 text-danger">No tiene un rol asignado</h2>';
}

foreach ($roles as $rol) {
    if ($rol['id_usuario'] == null) {
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="checkbox" onchange="setPermisoUsuario(' . $rol['id_permiso'] . ', ' . $datos['id_usuario'] . ', true)" value="' . $rol['id_permiso'] . '">';
        echo '<label class="form-check-label">' . $rol['codigos'] . '</label>';
        echo '</div>';
    } else {
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="checkbox" onchange="setPermisoUsuario(' . $rol['id_permiso'] . ', ' . $datos['id_usuario'] . ', false)" checked value="' . $rol['id_permiso'] . '">';
        echo '<label class="form-check-label">' . $rol['codigos'] . '</label>';
        echo '</div>';
    }
}


?>