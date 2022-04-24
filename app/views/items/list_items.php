<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>
<!-- create button to call function download_csv_file(evt) -->
<button type="button" class="btn btn-primary" onclick="download_csv_file()">Descargar CSV</button>
<div class="table-responsive" id="mydatatable-container">
    <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Locaclización</th>
                <th scope="col">Departamento</th>
                <th scope="col">Servicio</th>
                <th scope="col">Atendido por:</th>
                <th scope="col">Foto</th>
                <th scope="col">Estado</th>
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
                <th>Filter..</th>ç
                <th>Filter..</th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($items as $i): ?>
            <tr>
                <th id="userInfo"><?= $i->getName() ?></th>
                <th id="userInfo"><?= $i->getDescription() ?></th>
                <th id="userInfo"><?= $i->getLocation() ?></th>
                <th id="userInfo"><?= $i->getId_department() ?></th>
                <th id="userInfo"><?= $i->getId_service() ?></th>
                <th id="userInfo"><?= $i->getId_attendUser() ?></th>
                <th> <?php if ($i->getPhotosItem() != null): ?>
                    <!-- we check the photo exists in the gallery -->
                    <?php if(count($i->getPhotosItem())>=1): ?>
                    <div class="photos_articulo" style="background-image:url('<?= RUTA?>web/images/items/<?= $i->getPhotosItem()[0]->getFile_name() ?>');
                        background-size: contain;
                        background-position: center;
                        background-repeat: no-repeat;
                        height:100px;">
                    </div>
                    <?php else: ?>
                    <div class="photos_articulo"
                        style="background-image:url('<?= RUTA?>web/images/items/item_generico.jpg')"></div>
                    <?php endif; ?>
                    <?php endif; ?>
                </th>
                <th id="userInfo"><?= $i->getState() ?></th>
                <th>
                    <!--buttons bootstrap to edit the user with call to modalEditUser windowsDialog Modal to edit user with id="id="modalEditUser" -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editItemModal"
                        onclick="findByUserId($i->getUserId())">Editar <?= $i->getId() ?></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#deleteUserModal">Eliminar <?= $i->getId() ?></button>
                </th>
            </tr>
            <?php endforeach; ?>
            <!-- include modal windows to edit or delete user -->
        </tbody>
    </table>
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

var buttonCommon = {
        exportOptions: {
            format: {
                body: function ( data, row, column, node ) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                        data.replace( /[$,]/g, '' ) :
                        data;
                }
            }
        }
    };
 
    $('#example').DataTable( {
        ajax: '../../../../examples/ajax/data/objects.txt',
        columns: [
            { data: 'name' },
            { data: 'position' },
            { data: 'office' },
            { data: 'extn' },
            { data: 'start_date' },
            { data: 'salary' }
        ],
        dom: 'Bfrtip',
        buttons: [
            $.extend( true, {}, buttonCommon, {
                extend: 'copyHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'pdfHtml5'
            } )
        ]
    } );
</script>



<!-- Modal to edit Item -->
<div class="modal fade" id="editItemModal" tabindex="1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Editar Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= RUTA?>update_user/<?= $i->getId() ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="<?= $i->getNombre() ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                            value="<?= $i->getSurname() ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $i->getEmail() ?>">
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select class="form-control" id="rol" name="rol">

                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Editar Usuario</button>
            </div>
        </div>
    </div>
</div>
