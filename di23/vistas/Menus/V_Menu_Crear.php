<?php
$data = $datos;
$menu = $data['menu2'][0];
$nextOrden = $data['nextOrden'];
?>

<div class="container">
    <form>
        <div class="form-group ">
            <h2>Crear</h2>
            <label for="id_menu" class="col-sm-2 col-form-label">ID de Menú</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id_menu" name="id_menu" value="<?php echo $nextOrden; ?>"
                    style="width: 20%;">
            </div>
        </div>
        <div class="form-group ">
            <label for="titulo" class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="titulo" value="<?php echo $menu['titulo']; ?>"
                    style="width: 20%;">
            </div>
        </div>
        <div class="form-group ">
            <label for="id_padre" class="col-sm-2 col-form-label">ID Padre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id_padre" value="<?php echo $menu['id_padre']; ?>"
                    style="width: 20%;">
            </div>
        </div>
        <div class="form-group ">
            <label for="accion" class="col-sm-2 col-form-label">Acción</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="accion" value="<?php echo $menu['accion']; ?>"
                    style="width: 20%;">
            </div>
        </div>
        <div class="form-group ">
            <label for="orden" class="col-sm-2 col-form-label">Orden</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="orden" value="<?php echo $nextOrden; ?>"
                    style="width: 20%;">
            </div>
        </div>
        <div class="form-group ">
            <label for="privado" class="col-sm-2 col-form-label">Privado</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="privado" value="<?php echo $menu['privado']; ?>"
                    style="width: 20%;">
            </div>
        </div>
        <br>
        <div class="form-group ">
            <div class="col-sm-10">
                <button type="button" class="btn btn-primary" onclick="crearMenuNuevo()">Crear</button>
            </div>
        </div>
    </form>
</div>