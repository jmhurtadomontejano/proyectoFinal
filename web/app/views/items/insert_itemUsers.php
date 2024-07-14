<?php 
$contenido = ob_get_clean();
$titulo2 = "Insertar Items";
require './app/views/template.php';
MensajesFlash::imprimir_mensajes();

if (Session::existe()) {
    $conn = ConexionBD::conectar();
    $usuDAO = new UsuarioDAO($conn);
    $usuario = $usuDAO->findUserById(Session::obtener()->getId());
}

function renderInput($id, $name, $value, $placeholder, $type = 'text', $readonly = false, $hidden = false) {
    $readonlyAttr = $readonly ? 'readonly' : '';
    $hiddenClass = $hidden ? 'd-none' : '';
    echo "<div class='form-group $hiddenClass'>
            <input type='$type' id='$id' name='$name' class='form-control' value='$value' $readonlyAttr placeholder='$placeholder'>
            <label for='$id' class='form-label'>$placeholder</label>
          </div>";
}

function renderSelect($id, $name, $options, $placeholder, $readonly = false) {
    $readonlyAttr = $readonly ? 'readonly' : '';
    echo "<div class='form-group'>
            <select id='$id' name='$name' class='form-select' $readonlyAttr>
                <option selected>$options</option>
            </select>
            <label for='$id' class='form-label'>$placeholder</label>
          </div>";
}
?>

<div class="container mt-4">
    <form class="form" action="" method="post" enctype="multipart/form-data" aria-labelledby="form-title">
        <fieldset class="form" style="border-radius: 35px">
            <legend id="form-title" class="text-center">Formulario de Registro de Items</legend>
            <div class="row g-2">
                <?php
                renderInput('inputUser', 'inputUser', Session::obtener()->getId() . " " . Session::obtener()->getNombre(), 'Usuario Registro', 'text', true);
                renderSelect('inputState', 'inputState', 'Registrada', 'Estado', true);
                renderInput('inputDate', 'inputDate', date("Y-m-d"), 'Fecha', 'date', true);
                renderInput('inputHour', 'inputHour', date("H:i"), 'Hora', 'time', true);
                renderInput('inputDuration', 'inputDuration', '', 'Duracion', 'time', false, true);
                if ($usuario->getRol() == 'admin' || $usuario->getRol() == 'superAdmin') {
                    renderInput('inputAttendUser', 'inputAttendUser', Session::obtener()->getId() . " " . Session::obtener()->getNombre(), 'Atendido por', 'text', true);
                }
                renderInput('inputClientUser', 'inputClientUser', Session::obtener()->getId() . " " . Session::obtener()->getNombre(), 'Cliente: (a partir de la 5ª cifra del DNI o NIE)', 'text', true, true);
                renderInput('inputUserHidden', 'inputUser', Session::obtener()->getId() . " " . Session::obtener()->getNombre(), 'Usuario Registro', 'text', true, true);
                renderInput('inputName', 'inputName', '', 'Titulo del Item', 'text');
                ?>
                <div class="form-group w-100">
                    <textarea id="inputDescription" name="inputDescription" class="form-control" placeholder="Descripción..." required aria-required="true"></textarea>
                    <label for="inputDescription" class="form-label">Descripción</label>
                </div>
                <div class="form-group w-100 d-none">
                    <input type="text" id="inputLocation" name="inputLocation" class="form-control" placeholder="Ubicación">
                    <label for="inputLocation" class="form-label">Ubicación</label>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <select id="inputDepartment" name="inputDepartment" class="form-control" required aria-required="true">
                        <option value="">Seleccione....</option>
                        <?php foreach ($departments as $department): ?>
                        <option value="<?php echo $department->idDepartment  ?>">
                            <?php echo $department->idDepartment, " - " ; echo $department->name; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputDepartment" class="form-label">Departamento</label>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <input type="text" id="inputService" name="inputService" class="form-control" placeholder="Selecciona el servicio" required aria-required="true">
                    <label for="inputService" class="form-label">Servicio</label>
                </div>
                <div class="form-group w-100">
                    <input type="file" id="inputPhotoItem" name="inputPhotoItem[]" class="form-control" multiple="multiple">
                    <label for="inputPhotoItem" class="form-label">Sube una foto del Item</label>
                </div>
                <div class="form-group w-100" style="/* margin-top:1em; */">
                    <button type="submit" class="btn btn-primary btn-title">Agregar Item</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>

<script src="../js/form.js"></script>
