<?php 
ob_start();
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
    echo "<div class='col-md-6 col-sm-12 mb-3 $hiddenClass'>
            <label for='$id' class='form-label'>$placeholder</label>
            <input type='$type' id='$id' name='$name' class='form-control' value='$value' $readonlyAttr placeholder='$placeholder'>
          </div>";
}

function renderSelect($id, $name, $selectedOption, $placeholder, $readonly = false) {
    $readonlyAttr = $readonly ? 'disabled' : '';
    echo "<div class='col-md-6 col-sm-12 mb-3'>
            <label for='$id' class='form-label'>$placeholder</label>
            <select id='$id' name='$name' class='form-select' $readonlyAttr>
                <option selected>$selectedOption</option>
            </select>
          </div>";
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center rounded-top">
                    <h4 id="form-title" class="mb-0">Formulario de Registro de Items</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="" method="post" enctype="multipart/form-data" aria-labelledby="form-title" novalidate>
                        <div class="row g-3">
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
                            <div class="col-12 mb-3">
                                <label for="inputDescription" class="form-label">Descripción</label>
                                <textarea id="inputDescription" name="inputDescription" class="form-control" placeholder="Descripción..." required aria-required="true"></textarea>
                                <div class="invalid-feedback">Por favor, ingrese una descripción.</div>
                            </div>
                            <div class="col-12 mb-3 d-none">
                                <label for="inputLocation" class="form-label">Ubicación</label>
                                <input type="text" id="inputLocation" name="inputLocation" class="form-control" placeholder="Ubicación">
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="inputDepartment" class="form-label">Departamento</label>
                                <select id="inputDepartment" name="inputDepartment" class="form-select" required aria-required="true">
                                    <option value="">Seleccione....</option>
                                    <?php if (isset($departments) && is_array($departments)): ?>
                                        <?php foreach ($departments as $department): ?>
                                            <option value="<?php echo $department->idDepartment  ?>">
                                                <?php echo $department->idDepartment, " - " ; echo $department->name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback">Seleccione un departamento.</div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="inputService" class="form-label">Servicio</label>
                                <input type="text" id="inputService" name="inputService" class="form-control" placeholder="Selecciona el servicio" required aria-required="true">
                                <div class="invalid-feedback">Por favor, ingrese el servicio.</div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="inputPhotoItem" class="form-label">Sube una foto del Item</label>
                                <input type="file" id="inputPhotoItem" name="inputPhotoItem[]" class="form-control" multiple="multiple">
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-title px-5">Agregar Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/form.js"></script>
<script>
// Bootstrap validation
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
<?php
$contenido = ob_get_clean();
?>
