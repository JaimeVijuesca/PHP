<?php
$data = $datos;
$permiso = $data['permiso'][0];
?>

<div class="container">
    <form class="form-horizontal">
        <div class="form-group">
            <h2 class="text-center">Editar</h2>
            <label for="codigos" class="col-sm-2 col-form-label">Código</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="codigos" name="codigos"
                    value="<?php echo $permiso['codigos']; ?>" style="width: 20%;" required>
            </div>
        </div>
        <div class="form-group">
            <label for="permiso" class="col-sm-2 col-form-label">Permiso</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="permiso" name="permiso"
                    value="<?php echo $permiso['permiso']; ?>" style="width: 20%;" required>
            </div>
        </div>
        <div class="form-group">
            <br>
            <div class="offset-sm-2 col-sm-10">
                <button type="button" class="btn btn-primary" onclick="validarFormulario()">Enviar</button>
            </div>
        </div>
    </form>
</div>

