<?php 
$contenido = ob_get_clean();
/*$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";*/
$titulo2 = "Insertar Items";
require './app/views/template.php';
MensajesFlash::imprimir_mensajes();
?>

<link href="<?= RUTA?>js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?= RUTA?>js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>


<?php if (Session::existe()) { ?>
<?php
                $conn = ConexionBD::conectar();
                $usuDAO = new UsuarioDAO($conn);
                $usuario = $usuDAO->findUserById(Session::obtener()->getId());
            ?>
<?php } ?>

<form class="form-floating" action="" method="post" enctype="multipart/form-data">
    <fieldset class="form" style="border-radius: 35px">
        <div class="row" style="paddin:10px; margin:10px">
            <legend class="text-center">Formulario de Registro de Items</legend>
            <div class="form-group col-md-3 col-6">
                <label for="inputUser" class="form-label">Usuario Registro</label>
                <input class="form-control" name="inputUser"
                    value="<?php echo Session::obtener()->getId() ?><?php echo " ", Session::obtener()->getNombre() ?>"
                    readonly>
            </div>
            <div class="form-group col-md-3 col-6">
                <label for="inputState" class="form-label">Estado</label>
                <select id="inputState" name="inputState" class="form-select">
                    <option selected>Registrada</option>
                    <option>Iniciada</option>
                    <option>En Proceso</option>
                    <option>Finalizada</option>
                </select>
            </div>
            <div class="form-group col-md-2 col-4">
                <label for="inputDate" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="inputDate" value="<?php echo date("Y-m-d");?>">
            </div>
            <div class="form-group col-md-2 col-4">
                <label for="inputHour" class="form-label">Hora</label>
                <input type="time" class="form-control" name="inputHour" value="<?php echo date("H:i");?>">
            </div>
            <div class="form-group col-md-2 col-4">
                <label for="inputDuration" class="form-label">Duracion</label>
                <input type="time" class="form-control" name="inputDuration">
            </div>
            <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
            <div class="form-group col-6">
                <label for="inputAttendUser" class="form-label">Atendido por:</label>
                <input class="form-control" name="inputAttendUser"
                    value="<?php echo Session::obtener()->getId() ?><?php echo " ", Session::obtener()->getNombre() ?>"
                    readonly>
            </div>
            <?php } ?>
            <div class="form-group col-6">
                <label for="inputClientUser" class="form-label">Cliente: (por precaución no se muestra el dni entero,
                    puedes buscar a partir de la 5ª cifra del DNI o NIE)</label>
                <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
                <select class="form-control" name="inputClientUser" id="inputClientUser">
                    <option value="">Seleccione....</option>
                    <?php foreach ($clients as $client): ?>
                    <option value="<?php echo $client->id  ?>">
                        <?php echo substr($client->dni,4,9), " - " ; echo $client->nombre , " " ;  echo $client->surname; ?>
                    </option>
                    <?php endforeach; ?>
                    <?php } ?>
                    <?php if ($usuario->getRol() == '' || $usuario->getRol() =='user') { ?>
                    <input class="form-control" name="inputUser"
                        value="<?php echo Session::obtener()->getId() ?><?php echo " ", Session::obtener()->getNombre() ?>"
                        readonly>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6 w-100">
                <label for="inputName" class="form-label">Titulo</label>
                <input type="text" name="inputName" class="form-control" placeholder="Titulo del Item">
            </div>

            <div class="form-group col-md-6 w-100">
                <label for="inputDescription" class="form-label">Descripcion</label>
                <textarea type="textarea" class="form-control" name="inputDescription" id="description"
                    placeholder="Descripción..."></textarea>
            </div>
            <div class="form-group col-12" hidden>
                <label for="inputLocation" class="form-label">Localización</label>
                <input type="text" class="form-control" name="inputLocation" placeholder="Ubicación">
            </div>
            <div class="form-group col-6">
                <label for="inputDepartment" class="form-label">Departamento</label>
                <select class="form-control" id="inputDepartment" name="inputDepartment" required>
                    <option value="">Seleccione....</option>
                    <?php foreach ($departments as $department): ?>
                    <option value="<?php echo $department->idDepartment  ?>">
                        <?php echo $department->idDepartment, " - " ; echo $department->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="inputService" class="form-label">Servicio</label>
                <input type="text" class="form-control" name="inputService" placeholder="Selecciona el servicio">
            </div>

            <div class="form-group col-12">
                <label for="inputPhotoItem" class="form-label">Sube una foto del Item</label>
                <input type="file" class="form-control" name="inputPhotoItem[]" id="photoItem" multiple="multiple">
            </div>


            <div class="form-group col-12">
                <button type="submit" class="btn-title" style="margin-top:1em">Agregar Item</button>
            </div>
        </div>
</form>