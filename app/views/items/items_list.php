<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<div class="col-sm-12">
    <div class="table-responsive" id="mydatatable-container">
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Atendido por:</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Duracion</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tfoot style="display: table-header-group !important">
                <tr>
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
                <?php foreach ($items as $i): ?>
                <tr>
                <td id="id"><a href="ver_item/<?= $i->getId() ?>"><?= $i->getName() ?></a></td>
                    <td id="descriptionInfo"><?= $i->getDescription() ?></td>
                    <td id="departmentInfo">
                        <?= $i->getItemDepartment()->getIdDepartment() ," - ", $i->getItemDepartment()->getName() ?>
                    </td>
                    <td id="id_serviceInfo"><?= $i->getId_service() ?></td>
                    <td id="attendUserInfo">
                        <?= $i->getId_attendUser() ," - ",$i->getUser_attendUser()->getNombre()," ", $i->getUser_attendUser()->getSurname(); ?>
                    </td>
                    <td id="clientUserInfo">
                        <?= $i->getId_clientUser() ," - ",$i->getUser_clientUser()->getNombre()," ", $i->getUser_clientUser()->getSurname()?>
                    </td>
                    <td id="stateInfo"><?= $i->getState() ?></td>
                    <td id="dateInfo"><?= $i->getDate() ?></td>
                    <td id="hourInfo"><?= substr($i->getHour(),0,5) ?></td>
                    <td id="durationInfo"><?= substr($i->getDuration(),0,5) ?></td>
                    <th>
                        <!--buttons bootstrap to edit the user with call to modalEditUser windowsDialog Modal to edit user with id="id="modalEditUser" -->
                        <button type="button" class="btn btn-primary m-0 p-1" data-bs-toggle="modal"
                            data-bs-target="#editItemModal" data-id="<?= $i->getId()?>"
                            id="boton_editar">Editar</button>
                        <button type="button" class="btn btn-danger m-0 p-1" data-toggle="modal"
                            data-target="#deleteItemModal" data-id="<?= $i->getId()?>">Eliminar </button>
                    </th>
                </tr>
                <?php endforeach; ?>
                <!-- include modal windows to edit or delete user -->
            </tbody>
        </table>
    </div>
</div>

<?php
 $contenido = ob_get_clean();
 $titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
 $titulo2 = "Detalle de Items";
 require '../app/views/template.php';
 ?>

<!-- Modal to edit Item -->
<div class="modal fade" id="editItemModal" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Editar Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editItemForm" action="<?= RUTA."items/edit_item"?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Id" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value=""
                            required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Descripción" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Ubicación</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Ubicación"
                            value="" required>
                    </div>
                    <div class="form-group">
                        <label for="id_department">Departamento</label>
                        <select class="form-control" id="id_department" name="id_department" required>
                            <option value="">Seleccione....</option>
                            <?php foreach ($departments as $department): ?>
                            <option value="<?php echo $department->idDepartment  ?>">
                                <?php echo $department->idDepartment, " - " ; echo $department->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_service">Servicio</label>
                        <input type="text" class="form-control" id="id_service" name="id_service" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdateSubmit">Editar Item</button>
            </div>
        </div>
    </div>
</div>

<script src="app/scripts/items.js"></script>

<script type="text/javascript">
$(document).on('click', '#boton_editar', function() {

    let id = $(this).attr('data-id');

    //Enviamos la informacion por ajax 
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
            });

        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#mydatatable tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Filtrar.." />');
    });

    var table = $('#mydatatable').DataTable({
        "dom": 'B<"float-left"i><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
        "responsive": false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        "order": [
            [0, "desc"]
        ],
        "initComplete": function() {
            this.api().columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            })
        }
    });
});
</script>