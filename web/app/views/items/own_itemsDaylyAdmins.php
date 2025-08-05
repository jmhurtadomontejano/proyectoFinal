<?php
$contenido = ob_get_clean();
/*$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";*/
$titulo2 = "Detalle de Items";
$templateContent = '<a href="' . RUTA . 'insert_itemUsers" class="btn-title">
                <i class="fa-solid fa-file-circle-plus"></i> 
                Insertar Item</a>';
require './app/views/template.php';
MensajesFlash::imprimir_mensajes();
?>

<div class="options_box" style="margin:5px; padding:5px;">
    <form id="formFilter" method="post" action="<?php echo RUTA; ?>own_itemsDaylyAdmins">
        <div class="d-flex flex-row flex-wrap align-items-center gap-2" style="margin:0; justify-content:flex-end;">
            <div class="d-flex align-items-center border rounded p-2 me-2" style="min-width:220px;">
                <i class="fa-solid fa-calendar-days me-2"></i>
                <div class="d-flex flex-column flex-grow-1">
                    <label for="inputDate" class="form-label mb-1" style="font-size:0.9em;">Fecha para filtrar</label>
                    <input type="date" class="form-control form-control-sm" id="inputDate" value="<?php echo htmlspecialchars((string)($dateFilter ?? '')); ?>"
                        name="inputDate" style="min-width:120px;">
                </div>
            </div>
            <div class="d-flex align-items-center border rounded p-2" style="min-width:260px;">
                <i class="fa-solid fa-building-user me-2"></i>
                <div class="d-flex flex-column flex-grow-1">
                    <label for="inputDepartment" class="form-label mb-1" style="font-size:0.9em;">Filtro por Depart.</label>
                    <select id="inputDepartment" name="inputDepartment" class="form-select form-select-sm">
                        <option value=""><?php echo isset($departmentUser) ? htmlspecialchars($departmentUser) : ''; ?>Seleccione....</option>
                        <?php foreach ($departments as $department): ?>
                        <option <?php if(isset($idDepart) && $idDepart==$department->idDepartment) echo "selected=\"selected\""; ?>
                            value="<?php echo htmlspecialchars($department->idDepartment); ?>">
                            <?php echo htmlspecialchars($department->idDepartment . " - " . $department->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-sm-12">
    <div class="table-responsive" id="mydatatable-container">
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Atendió:</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Duracion</th>
                    <th scope="col">Resultado</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tfoot style="display: table-header-group !important">
                <tr hidden>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th hidden>Filter..</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($mis_items as $i): ?>
                <tr>
                    <td id="itemInfo"><a href="ver_item/<?= $i->getId() ?>"><?= $i->getId(). " - ". $i->getName() ?></a></td>
                    <td id="descriptionInfo"><?= htmlspecialchars(substr($i->getDescription(),0,20)) . "..." ?></td>
                    <td id="departmentInfo"><?= htmlspecialchars($i->getItemDepartment()->getIdDepartment() . " - " . $i->getItemDepartment()->getName()) ?></td>
                    <td id="id_serviceInfo"><?= htmlspecialchars($i->getId_service()) ?></td>
                    <td>
                        <?php
                            $userAttend = $i->getUser_attendUser();
                            if ($userAttend !== null) {
                                echo $i->getId_attendUser() . " - " . htmlspecialchars($userAttend->getNombre()) . " " . htmlspecialchars(substr($userAttend->getSurname(), 0, 8));
                            } else {
                                echo $i->getId_attendUser() . " - No asignado";
                            }
                        ?>
                                <?php
                                    $userClient = $i->getUser_clientUser();
                                    if ($userClient !== null) {
                                        echo $i->getId_clientUser() . " - " . htmlspecialchars($userClient->getNombre()) . " " . htmlspecialchars($userClient->getSurname());
                                    } else {
                                        echo $i->getId_clientUser() . " - No asignado";
                                    }
                                ?>
                    <?php if ($i->getId_clientUser()==0 || $i->getId_clientUser()==null): ?>
                        <td id="clientUserInfo" style="color:red">0000 - No asignado</td>
                    <?php else: ?>
                        <td id="clientUserInfo">
                            <a class="" href="<?= RUTA?>itemsByUserToAdmin?clientId=<?= $i->getId_clientUser() ?>"
                                data="<?= $i->getId_clientUser() ?>">
                                <?= $i->getId_clientUser() ," - ", htmlspecialchars($i->getUser_clientUser()->getNombre())," ", htmlspecialchars($i->getUser_clientUser()->getSurname())?>
                            </a>
                        </td>
                    <?php endif; ?>
                    <td id="stateInfo"><?= htmlspecialchars($i->getState()) ?></td>
                    <td id="dateInfo"><?= htmlspecialchars($i->getDate()) ?></td>
                    <td id="hourInfo"><?= htmlspecialchars(substr($i->getHour(),0,5)) ?></td>
                    <td id="durationInfo"><?= htmlspecialchars(substr($i->getDuration(),0,5)) ?></td>
                    <td id="resultInfo"><?= htmlspecialchars($i->getResult()) ?></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-table m-0 p-1" 
                            data-bs-toggle="modal" data-bs-target="#editItemModal" data-id="<?= $i->getId()?>"
                            id="boton_editar">Editar</button>
                        <!-- button to open windows view_item, no modal -->
                        <a href="ver_item/<?= $i->getId() ?>">
                            <button hidden type="button" class="btn btn-primary btn-table m-0 p-1">Ver</button>
                        </a>
                        <button hidden type="button" class="btn btn-danger m-0 p-1" data-toggle="modal"
                            data-target="#deleteItemModal" data-id="<?= $i->getId()?>">Eliminar </button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <!-- include modal windows to edit or delete user -->
            </tbody>
        </table>
    </div>
</div>



<script type="text/javascript">
$(document).on('click', '#boton_editar', function() {
    let id = $(this).attr('data-id');
    //Send information by ajax 
    $.ajax({
        url: 'pb',
        type: 'POST',
        data: {
            id
        },
        //Recuperamos la información 
        success: function(e) {
            //console.log(e);
            let traer = JSON.parse(e);
            //Imprimimos la información en la ventana modal 
            traer.forEach((valor) => {
                $("#id").val(valor.id);
                $("#name").val(valor.name);
                $("#description").val(valor.description);
                $("#location").val(valor.location);
                $("#id_department").val(valor.id_department);
                $("#id_service").val(valor.id_service);
                $("#id_attendUser").val(valor.id_attendUser);
                $("#id_clientUser").val(valor.id_clientUser);
                $("#state").val(valor.state);
                $("#date").val(valor.date);
                $("#hour").val(valor.hour);
                $("#duration").val(valor.duration);
                $("#result").val(valor.result);
            });
        }
    });
});
</script>

<!-- Modal to edit Item -->
<div class="modal fade" id="editItemModal" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Editar Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex">
                <form id="editItemForm" class="modal-body d-flex flex-wrap" action="<?= RUTA . "edit_item" ?>"
                    enctype="multipart/form-data" method="post">
                    <div class="form-group col-3">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" readonly>
                    </div>
                    <div class="form-group col-9">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value=""
                            style="margin-bottom:1em" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" id="description" name="description"
                            placeholder="Descripción" style="margin-bottom:1em" required></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label for="id_department">Departamento</label>
                        <select class="form-control" id="id_department" name="id_department" style="margin-bottom:1em"
                            required>
                            <option value="">Seleccione....</option>
                            <?php foreach ($departments as $department): ?>
                            <option value="<?php echo htmlspecialchars($department->idDepartment); ?>">
                                <?php echo htmlspecialchars($department->idDepartment . " - " . $department->name); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="id_attendUser">Atendió:</label>
                        <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
                        <select class="form-control" name="id_attendUser" id="id_attendUser" style="margin-bottom:1em">
                            <option value="">Seleccione....</option>
                            <?php foreach ($admins as $admin): ?>
                            <option value="<?php echo htmlspecialchars($admin->id); ?>">
                                <?php echo htmlspecialchars($admin->nombre . " " . $admin->surname); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php } elseif ($usuario->getRol() == '' || $usuario->getRol() == 'user') { ?>
                        <input class="form-control" name="inputUser"
                            value="<?php echo htmlspecialchars(Session::obtener()->getId() . " " . Session::obtener()->getNombre()); ?>"
                            readonly>
                        <?php } ?>
                    </div>
                    <div class="form-group col-12">
                        <label for="id_clientUser">Cliente</label>
                        <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() == 'superAdmin') { ?>
                        <select class="form-control" name="id_clientUser" id="id_clientUser" style="margin-bottom:1em">
                            <option value="">Seleccione....</option>
                            <?php foreach ($clients as $client): ?>
                            <option value="<?php echo htmlspecialchars($client->id); ?>">
                                <?php echo htmlspecialchars(substr($client->dni, 4, 9) . " - " . $client->nombre . " " . $client->surname); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?php } elseif ($usuario->getRol() == '' || $usuario->getRol() == 'user') { ?>
                        <input class="form-control" name="inputUser"
                            value="<?php echo htmlspecialchars(Session::obtener()->getId() . " " . Session::obtener()->getNombre()); ?>"
                            readonly>
                        <?php } ?>
                    </div>
                    <div class="form-group col-6 col-md-4">
                        <label for="hour">Hora</label>
                        <input type="time" class="form-control" id="hour" name="hour" style="margin-bottom:1em"
                            required>
                    </div>
                    <div class="form-group col-6 col-md-4">
                        <label for="duration">Duración</label>
                        <input type="time" class="form-control" id="duration" name="duration" style="margin-bottom:1em"
                            required>
                    </div>
                    <div class="form-group col-6 col-md-4">
                        <label for="state">Estado</label>
                        <select id="state" name="state" class="form-select">
                            <option selected>Registrada</option>
                            <option>Iniciada</option>
                            <option>En Proceso</option>
                            <option>Finalizada</option>
                        </select>
                    </div>
                    <div class="form-group col-6 col-md-4">
                        <label for="result">Result</label>
                        <select id="result" name="result" class="form-select">
                            <option selected>NO</option>
                            <option value="Anulada">Anulada</option>
                            <option value="No asiste">NO asiste</option>
                            <option value="Asistio">Asistió</option>
                            <option value="No responde">No responde</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnUpdateSubmit">Editar Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="app/scripts/items.js"></script>

<!-- script to call public function findItemsByUser($id_user) with the selected $i->getId_clientUser()
<script>
$(document).ready(function() {
    $('#id_clientUser').on('click', function() {
        findItemsByUser($(this).val('#id_clientUser'));
    });
});
</script>
-->