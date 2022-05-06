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
                    <th scope="col">Atendido por ID:</th>
                    <th scope="col">Atendido por nombre:</th>
                    <th scope="col">Cliente ID</th>
                    <th scope="col">Cliente nombre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
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
                    <th>Filter..</th>
                    <th hidden>Filter..</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($mis_items as $i): ?>
                <tr>
                <td id="itemInfo"><a href="ver_item/<?= $i->getId() ?>"><?= $i->getName() ?></a></td>
                    <td id="itemInfo"><?= $i->getDescription() ?></td>
                    <td id="itemInfo"><?= $i->getId_department() ?></td>
                    <td id="itemInfo"><?= $i->getId_service() ?></td>
                    <td id="itemInfo"><?= $i->getId_attendUser() ?></td>
                    <td id="itemInfo"><?= $i->getUser()->getNombre()," ", $i->getUser()->getSurname(); ?></td>
                    <td id="itemInfo"><?= $i->getId_clientUser() ?></td>
                    <td id="itemInfo"><?= $i->getUser_clientUser() ?></td>
                    <td id="itemInfo"><?= $i->getState() ?></td>
                    <td id="dateInfo"><?= $i->getDate() ?></td>
                    <td id="hourInfo"><?= $i->getHour() ?></td>
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


<?php foreach ($mis_items as $a): ?>
<div class="item_listado">
    <div class="titulo_item"><a href="ver_item/<?= $a->getId() ?>"><?= $a->getName() ?></a></div>
    <?php if(count($a->getPhotosItem())>=1): ?>
    <div class="photos_item"
        style="background-image:url('<?= RUTA?>web/images/items/<?= $a->getPhotosItem()[0]->getNombre_archivo() ?>')">
    </div>
    <?php else: ?>
    <div class="photos_item" style="background-image:url('<?= RUTA?>web/images/item_generico.jpg')"></div>
    <?php endif; ?>
    <div class="descripcion_item"><?= substr($a->getDescription(), 0, 20) . "..." ?></div>
    <div class="precio_item"><?= $a->getId_clientUser() ?></div>
    <div class="contactar">CONTACTAR</div>
    <div class="fecha_item"><?= $a->getDate() ?></div>
    <?= $a->getUser()->getNombre(); ?>
    <?php if (Session::existe() && $a->getUser()->getId() == (Session::obtener())->getId()): ?>
    <div class="borrar_item"><a href="<?= RUTA?>borrar_item/<?= $a->getId() ?>/<?=$token ?>">Borrar Item</a></div>
    <?php endif; ?>
</div>
<?php endforeach; ?>
