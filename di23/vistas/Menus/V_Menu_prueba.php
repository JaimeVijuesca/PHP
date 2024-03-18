<?php
$menu = $datos['menu'][0];
?>

<div class="container">
    <form class="form-horizontal" style="margin-top: -20px;">
        <div class="form-group">
            <h2 class="text-center">Editar</h2>
            <label for="id_menu" class="col-sm-2 col-form-label">ID de Menú</label>
            <div class="col-sm-10">
                <input type="text" style="width:10%;" class="form-control" id="id_menu" name="id_menu" value="<?php echo $menu['id_menu']; ?>" style="width: 100%;">
            </div>
        </div>
        <div class="form-group">
            <label for="titulo" class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="titulo" value="<?php echo $menu['titulo']; ?>" style="width: 100%;">
            </div>
        </div>
        <div class="form-group">
            <label for="id_padre" class="col-sm-2 col-form-label">ID Padre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id_padre" value="<?php echo $menu['id_padre']; ?>" style="width: 100%;">
            </div>
        </div>
        <div class="form-group">
            <label for="accion" class="col-sm-2 col-form-label">Acción</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="accion" value="<?php echo $menu['accion']; ?>" style="width: 100%;">
            </div>
        </div>
        <div class="form-group">
            <label for="orden" class="col-sm-2 col-form-label">Orden</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="orden" value="<?php echo $menu['orden']; ?>" style="width: 100%;">
            </div>
        </div>
        <div class="form-group">
            <label for="privado" class="col-sm-2 col-form-label">Privado</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="privado" value="<?php echo $menu['privado']; ?>" style="width: 100%;">
            </div>
        </div>
        <div class="form-group">
    <br>
    <div class="offset-sm-2 col-sm-10 d-flex justify-content-center" style="position: relative; left:-50px;">
        <button type="button" class="btn btn-primary" onclick="actualizarMenu()">Enviar</button>
    </div>
</div>
    </form>
</div>

