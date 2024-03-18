<div class="container">
    <h2 class="text-center">Menú</h2>
    <?php
    $menus = $datos['listaMenu'];
    $arr = [];

    foreach ($menus as $res) {
        if ($res['id_padre'] == 0) {
            $arr[$res['id_menu']] = $res;
        } else {
            $arr[$res['id_padre']]['hijos'][] = $res;
        }
    }

    foreach ($arr as $menu) {
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo "<h5 class='card-title'>" . $menu['titulo'] . "</h5>";
        echo "<p class='card-text'>ID: " . $menu['id_menu'] . "</p>";
        echo "<p class='card-text'>ID Padre: " . $menu['id_padre'] . "</p>";
        echo "<p class='card-text'>Acción: " . $menu['accion'] . "</p>";
        echo "<p class='card-text'>Orden: " . $menu['orden'] . "</p>";
        echo "<p class='card-text'>Privado: " . $menu['privado'] . "</p>";
        echo "<button class='btn btn-primary' onclick='cargarDatosMenu(" . $menu['id_menu'] . ")'>Editar</button>";
        echo "<button class='btn btn-secondary ml-2' onclick='crearOpcionMenu(" . $menu['id_menu'] . ")'>Crear</button>";
        echo "<button class='btn btn-danger ml-2' onclick='borrarMenu(" . $menu['id_menu'] . ")'>Eliminar</button>";
        echo "<button class='btn btn-warning ml-2' onclick='permisosMenu(" . $menu['id_menu'] . ")'>Permisos</button>";
        echo '</div>';
        echo '<div id="permisos' . $menu['id_menu'] . '" >';
        echo '</div>';
        echo '<form style="margin-left: 90%; " id="formularioAyuda' . $menu['id_menu'] . '" >';
        echo '<div style="margin-top:-35%;" id="prueba' . $menu['id_menu'] . '">';
        echo '</div>';
        echo '</form>';
        echo '<form id="menuEditarPermisos">';
        echo '<div id="EditarPermisos' . $menu['id_menu'] . '"></div>';
        echo '</form>';
        echo '</div>';
        if (isset ($menu['hijos'])) {
            foreach ($menu['hijos'] as $hijo) {
                echo '<div class="card mb-3 ml-5" style="background-color: lightblue;">';
                echo '<div class="card-body">';
                echo "<h5 class='card-title'>" . $hijo['titulo'] . "</h5>";
                echo "<p class='card-text'>ID: " . $hijo['id_menu'] . "</p>";
                echo "<p class='card-text'>ID Padre: " . $hijo['id_padre'] . "</p>";
                echo "<p class='card-text'>Acción: " . $hijo['accion'] . "</p>";
                echo "<p class='card-text'>Orden: " . $hijo['orden'] . "</p>";
                echo "<p class='card-text'>Privado: " . $hijo['privado'] . "</p>";
                echo "<button class='btn btn-primary' onclick='cargarDatosMenu(" . $hijo['id_menu'] . ")'>SubMenu Editar</button>";
                echo "<button class='btn btn-secondary ml-2' onclick='crearOpcionMenu(" . $hijo['id_menu'] . ")'> SubMenu Crear</button>";
                echo "<button class='btn btn-danger ml-2' onclick='borrarMenu(" . $hijo['id_menu'] . ")'>SubMenu Eliminar</button>";
                echo "<button class='btn btn-warning ml-2' onclick='permisosMenu(" . $hijo['id_menu'] . ")'>Permisos</button>";
                echo '</div>';
                echo '<div id="permisos' . $hijo['id_menu'] . '">';
                echo '</div>';
                echo '<form style="margin-left: 50%;" id="formularioAyuda' . $hijo['id_menu'] . '" >';
                echo '<div style="margin-top:-35%;" id="prueba' . $hijo['id_menu'] . '">';
                echo '</div>';
                echo '</form>';
                echo '<form id="menuEditarPermisos">';
                echo '<div id="EditarPermisos' . $hijo['id_menu'] . '"></div>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
        }

    }
    ?>
</div>