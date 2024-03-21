<?php

$roles = $datos['listaMenuRoles'];

$rol = $datos['id_usuario'];

var_dump($rol);



var_dump($datos);

// Display the role
foreach ($roles as $rol) {
    if ($rol['id_Usuarios'] == null) {
        echo "<input type='checkbox' onchange='setRolUsuarioInsertDelete(" . $rol['id_rol'] . ", " .
            $datos['id_usuario'] . ", true)' value='" . $rol['id_rol'] . "'> " . $rol['rol'] . "<br>";
    } else {
        echo "<input type='checkbox' onchange='setRolUsuarioInsertDelete(" . $rol['id_rol'] . ", "
            . $datos['id_usuario'] . ", false)' checked value='" . $rol['id_rol'] . "'> " . $rol['rol'] . "<br>";
    }
}

?>