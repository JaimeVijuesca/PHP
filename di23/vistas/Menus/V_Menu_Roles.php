<?php
$roles = $datos['listaMenuRoles'];



//var_dump($datos);

foreach ($roles as $rol) {
    if ($rol['id_rol'] == null) {
        echo "<input type='checkbox' onchange='setPermisoRol(" . $rol['id_permiso'] . ", " .
            $datos['id_rol'] . ", true)' value='" . $rol['id_permiso'] . "'> " . $rol['codigos'] . " " . $rol['titulo'] . "<br>";
    } else {
        echo "<input type='checkbox' onchange='setPermisoRol(" . $rol['id_permiso'] . ", "
            . $datos['id_rol'] . ", false)' checked value='" . $rol['id_permiso'] . "'> " . $rol['codigos'] . " " . $rol['titulo'] . "<br>";
    }
}
?>