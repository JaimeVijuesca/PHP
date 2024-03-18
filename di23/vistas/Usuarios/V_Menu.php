<?php
$resultados = $datos['menu'];
$menu = $resultados['menu'];
$permisos = $_SESSION['permisosUsuarios'] ?? [];

$arr = [];
foreach ($menu as $res) {
    if ($res['id_padre'] == 0) {
        $arr[$res['id_menu']] = $res;
    } else {
        $arr[$res['id_padre']]['hijos'][] = $res;
    }
}

$isAdmin = array_search('Administrador', array_column($permisos, 'rol')) !== false;
?>

<section id="secMenuPagina" class="container-fluid">
    <nav id="navbarcss" class="navbar navbar-expand-sm navbar-light" aria-label="Fourth navbar example">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04"
                aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <?php
                    foreach ($arr as $res) {
                        if ($isAdmin || $res['titulo'] != 'Menu Seguridad') {
                            $hasChildren = isset($res['hijos']);
                            echo '<li class="nav-item', $hasChildren ? ' dropdown' : '', '">';
                            echo '<a class="nav-link', $hasChildren ? ' dropdown-toggle' : '', '" href="#"', $hasChildren ? ' id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false"' : '', '>', $res['titulo'], '</a>';
                            if ($hasChildren) {
                                echo '<ul class="dropdown-menu" aria-labelledby="dropdown04">';
                                foreach ($res['hijos'] as $hijo) {
                                    echo '<li><a class="dropdown-item" onclick="', $hijo['accion'], '" href="#">', $hijo['titulo'], '</a></li>';
                                }
                                echo '</ul>';
                            }
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</section>