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
                    <th scope="col">Atendido por nombre:</th>
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
                <?php foreach ($mis_items as $i): ?>
                <tr>
                <td id="itemInfo"><a href="ver_item/<?= $i->getId() ?>"><?= $i->getName() ?></a></td>
                    <td id="descriptionInfo"><?= $i->getDescription() ?></td>
                    <td id="departmentInfo"><?= $i->getItemDepartment()->getIdDepartment() ," - ", $i->getItemDepartment()->getName() ?></td>
                    <td id="id_serviceInfo"><?= $i->getId_service() ?></td>
                    <td id="attendUserInfo"><?= $i->getId_attendUser() ," - ",$i->getUser_attendUser()->getNombre()," ", $i->getUser_attendUser()->getSurname(); ?></td>
                    <td id="clientUserInfo"><?= $i->getId_clientUser() ," - ",$i->getUser_clientUser()->getNombre()," ", $i->getUser_clientUser()->getSurname()?></td>
                    <td id="stateInfo"><?= $i->getState() ?></td>
                    <td id="dateInfo"><?= $i->getDate() ?></td>
                    <td id="hourInfo"><?= $i->getHour("H:i") ?></td>
                    <td id="durationInfo"><?= $i->getDuration("H:i") ?></td>
                    <th>
                        <!--buttons bootstrap to edit the user with call to modalEditUser windowsDialog Modal to edit user with id="id="modalEditUser" -->
                        <button type="button" class="btn btn-primary m-0 p-1" data-bs-toggle="modal"
                            data-bs-target="#editItemModal" data-id="<?= $i->getId()?>" id="boton_editar">Editar</button>
                        <button type="button" class="btn btn-danger m-0 p-1" data-toggle="modal" data-target="#deleteUserModal"
                            data-id="<?= $i->getId()?>">Eliminar </button>
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


