<?php ob_start() ?>
<link href="<?= RUTA?>web/js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?= RUTA?>web/js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>


<script type="text/javascript">
$(function() {
    $("#descripcion").jqte();
});
</script>
<form class="row g-3" action="" method="post" enctype="multipart/form-data">
    <div class="col-md-6">
        <label for="inputName" class="form-label">Titulo</label>
        <input type="text" name="inputName" class="form-control" placeholder="Titulo del Item">
    </div>

    <div class="col-12">
        <label for="inputDescription" class="form-label">Descripcion</label>
        <textarea type="textarea" class="form-control" name="inputDescription" id="description" placeholder="Descripción..."></textarea>
    </div>
    <div class="col-12">
        <label for="inputLocation" class="form-label">Localización</label>
        <input type="text" class="form-control" id="inputLocation" placeholder="Ubicación">
    </div>
    <div class="col-12">
        <label for="id_department" class="form-label">Departamento</label>
        <select type="text" class="form-control" id="id_department" placeholder="Departamento">
            <?php foreach ($departamentos as $departamento) { ?>
                <option value="<?= $departamento->getId() ?>"><?= $departamento->getName() ?></option>
            <?php } ?>
            </select>
    </div>
    <div class="col-12">
        <label for="inputLocation" class="form-label">Sube una foto del Item</label>
        <input type="file" class="form-control"  name="photoItem[]" id="photoItem" multiple="multiple">
    </div>
    <div class="col-md-6">
        <label for="inputUser" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="inputUser" readonly>
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">Estado</label>
        <select id="inputState" class="form-select">
            <option selected>Registrada</option>
            <option>Iniciada</option>
            <option>En Proceso</option>
            <option>Finalizada</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="inputZip" class="form-label">Fecha</label>
        <input type="text" class="form-control" id="inputZip">
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Check me out
            </label>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Agregar Item</button>
    </div>
</form>
<?php
$contenido = ob_get_clean();
$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
$titulo2 = "Insertar Items";
require '../app/views/template.php';
?>