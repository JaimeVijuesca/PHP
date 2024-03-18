<?php
$usuarios = $datos['usuarios'];
$totalResultados = $datos['totalResultados'];
$totalPaginas = $datos['totalPaginas'];

if ($usuarios != null && $totalResultados > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped mx-auto">';
    echo '<thead>';
    echo '<p>Número total de resultados: ' . $totalResultados . '</p>';
    // Genera los enlaces de paginación
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo "<a href='#' onclick='pasarPagina($i)' class='btn btn-primary pagina' data-pagina='" . $i . "'>" . $i . "</a> ";
    }
    echo '<tr>';
    echo '<th>Nombre:</th>';
    echo '<th>Apellido 1:</th>';
    echo '<th>Apellido 2:</th>';
    echo '<th>Sexo:</th>';
    echo '<th>Mail:</th>';
    echo '<th>Movil:</th>';
    echo '<th>Login:</th>';
    if (isset ($_SESSION['permisosUsuarios'])) {
        foreach ($_SESSION['permisosUsuarios'] as $permisoUsuario) {
            if ($permisoUsuario['rol'] == 'Administrador') {
                echo '<th>Acciones:</th>';
                break;
            }
        }
    }
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($usuarios as $fila) {
        echo '<tr>';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo '<td>' . $fila['apellido_1'] . '</td>';
        echo '<td>' . $fila['apellido_2'] . '</td>';
        echo '<td>' . $fila['sexo'] . '</td>';
        echo '<td>' . $fila['mail'] . '</td>';
        echo '<td>' . $fila['movil'] . '</td>';
        echo '<td>' . $fila['login'] . '</td>';
        if (isset ($_SESSION['permisosUsuarios'])) {
            foreach ($_SESSION['permisosUsuarios'] as $permisoUsuario) {
                if ($permisoUsuario['rol'] == 'Administrador' || $permisoUsuario['']) {
                    echo '<td>';
                    echo "<img src='..\di23\imagenes\lapiz.png' style='width:64px' onclick='enseñarformulario(),cargarDatosFormulario(" . $fila['id_Usuario'] . ", \"" . $fila['nombre'] . "\", \"" . $fila['apellido_1'] . "\", \"" . $fila['apellido_2'] . "\", \"" . $fila['sexo'] . "\", \"" . $fila['mail'] . "\", \"" . $fila['movil'] . "\", \"" . $fila['login'] . "\", \"" . $fila['activo'] . "\")'> ";
                    echo '</td>';
                    break;
                }
            }
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    // No hay resultados
    echo '<p>No se encontraron resultados.</p>';
}
?>