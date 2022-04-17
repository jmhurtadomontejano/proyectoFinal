<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>


<div class="table-responsive" id="mydatatable-container">
    <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Locaclización</th>
                <th scope="col">Departamento</th>
                <th scope="col">Foto</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tfoot style="display: table-header-group !important">
            <tr>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>

            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($items as $i): ?>
            <tr>
                <th id="userInfo"><?= $i->getName() ?></th>
                <th id="userInfo"><?= $i->getDescription() ?></th>
                <th id="userInfo"><?= $i->getLocation() ?></th>
                <th id="userInfo"><?= $i->getId_departament() ?></th>
                <th> <?php if ($i->getPhotosItem() != null): ?>
                    <!-- we check the photo exists in the gallery -->

                    <img id="photo_usuario"
                        style="background-image: url(<?= RUTA?>web/images/items/<?= $i->getPhotosItem() ?>)"
                        class="img-thumbnail" alt="" width="100" height="100">
                    <?php else: ?>
                    <img style="background-image: url(<?= RUTA?>web/images/items/item_generico.png)"
                        class="img-thumbnail" alt="" width="100" height="100">
                    <?php endif; ?>
                </th>
                <th>
                    <!--buttons bootstrap to edit the user with call to modalEditUser windowsDialog Modal to edit user with id="id="modalEditUser" -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                        onclick="findByUserId($i->getUserId())">Editar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#deleteUserModal">Eliminar</button>

                </th>
            </tr>

            <?php endforeach; ?>
            <!-- include modal windows to edit or delete user -->
        </tbody>
    </table>
</div>

<script type="text/javascript">
$('#myTable').DataTable( {
    buttons: [
        {
            extend: 'excelHtml5',
            text: 'Save as Excel',
            customize: function( xlsx ) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                var lastCol = sheet.getElementsByTagName('col').length - 1;
                var colRange = createCellPos( lastCol ) + '1';
                //Has to be done this way to avoid creation of unwanted namespace atributes.
                var afSerializer = new XMLSerializer();
                var xmlString = afSerializer.serializeToString(sheet);
                var parser = new DOMParser();
                var xmlDoc = parser.parseFromString(xmlString,'text/xml');
                var xlsxFilter = xmlDoc.createElementNS('http://schemas.openxmlformats.org/spreadsheetml/2006/main','autoFilter');
                var filterAttr = xmlDoc.createAttribute('ref');
                filterAttr.value = 'A1:' + colRange;
                xlsxFilter.setAttributeNode(filterAttr);
                sheet.getElementsByTagName('worksheet')[0].appendChild(xlsxFilter);
            }
        }
    ]
} );
 
function createCellPos( n ){
    var ordA = 'A'.charCodeAt(0);
    var ordZ = 'Z'.charCodeAt(0);
    var len = ordZ - ordA + 1;
    var s = "";
 
    while( n >= 0 ) {
        s = String.fromCharCode(n % len + ordA) + s;
        n = Math.floor(n / len) - 1;
    }
 
    return s;
}
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

<?php
 $contenido = ob_get_clean();
 $titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
 $titulo2 = "Detalle de Items";
 require '../app/views/template.php';
 ?>

<!-- Modal to edit Item -->
<div class="modal fade" id="editUserModal" tabindex="1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Item</h5>
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


