<?php 
$contenido = ob_get_clean();
/*$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";*/
$titulo2 = "Insertar Departamentos";
require './app/views/template.php';
MensajesFlash::imprimir_mensajes();
?>
<link href="<?= RUTA?>js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?= RUTA?>js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>

</script>
<form class="form-floating" action="" method="post" enctype="multipart/form-data">
    <fieldset class="form" style="border-radius: 35px">
        <div class="row" style="paddin:10px; margin:10px">
            <legend class="text-center">Formulario de Registro de Departamentos Nuevos</legend>
            <div class="form-group col-6">
                <label for="inputName" class="form-label">Nombre</label>
                <input type="text" name="inputName" class="form-control" placeholder="Titulo del Item">
            </div>

            <div class="form-group col-6">
                <label for="inputDescription" class="form-label">Descripcion</label>
                <textarea type="textarea" class="form-control" name="inputDescription" id="description"
                    placeholder="Descripción..."></textarea>
            </div>

            <div class="form-group col-6">
                <label for="inputPhone" class="form-label">Telefono</label>
                <input type="text" name="inputPhone" class="form-control" placeholder="Telefono">
            </div>

            <div class="form-group col-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="inputEmail" class="form-control" placeholder="Email">
            </div>

            <div class="form-group col-6">
                <label for="inputIcon" class="form-label">Icono departamento</label>
                <input type="text" name="inputIcon" class="form-control"
                    placeholder="icono EJ: <i class='fa-thin fa-alicorn'>">
            </div>

            <div class="" style="justify-content:center; align-items:center padding-top:2em">
                <button type="submit" value="registrar" class="btn-title col-12" style="margin-top:2em">Registrar
                    Departamento</button>
            </div>
    </fieldset>


</form>