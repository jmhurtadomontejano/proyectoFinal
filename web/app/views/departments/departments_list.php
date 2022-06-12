<?php 
 $contenido = ob_get_clean();
 /*$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";*/
 $titulo2 = "Detalle de Departamentos";
 $templateContent = '<a href="'.RUTA.'insert_department" class="btn-title">
 <i class="fa-solid fa-file-circle-plus"></i> 
 Insertar Departmanto</a>';
 require './app/views/template.php';
 MensajesFlash::imprimir_mensajes(); ?>


<input type="hidden" id="url_post" name="" value="<?= RUTA?>traer_campos_departament" >
<div class="table-responsive" id="mydatatable-container">
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Email</th>
                <th scope="col">Icono</th>
                <th scope="col">Hab/Deshab</th>
                <th scope="col">Opciones</th>
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
                <th hidden>Filter..</th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($departments as $d): ?>
            <tr>
                <th id="departmentInfo"><?= $d->getIdDepartment() ?></th>
                <th id="departmentInfo"><?= $d->getName() ?></th>
                <th id="departmentInfo"><?= $d->getDescription() ?></th>
                <th id="departmentInfo"><?= $d->getPhone() ?></th>
                <th id="departmentInfo"><?= $d->getEmailDepartment() ?></th>
                <th id="departmentInfo"><?= $d->getIconDepartment() ?></th>

                <?php if ($d->getDisable()==0): ?>
                <td id="departmentInfo">Habilitado</td>
                <?php else: ?>
                <td id="departmentInfo">DESHabilitado</td>
                <?php endif; ?>
                <th>
                    <!-- buttons bootstrap to edit the Department with call to modalEditDepartment windowsDialog Modal to edit Department with id="id="modalEditDepartment" -->
                     <button id="open_modal" type="button" class="btn btn-primary btn-table"
                        data-id="<?= $d->getIdDepartment() ?>"  data-bs-toggle="modal"
                        data-bs-target="#editDepartmentModal" >Editar <?= $d->getIdDepartment() ?></button>
                                <!-- button to open windows view_item, no modal -->
                        <a href="edit_department/<?= $d->getIdDepartment() ?>" hidden>
                            <button type="button" class="btn btn-table btn-primary m-0 p-1">Ver</button>
                        </a>
                </th>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

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


<script type="text/javascript">
$(document).on('click', '#open_modal', function(){
    let id = $(this).attr('data-id');
    let url_post = $("#url_post").val();
    console.log(id);
    $.ajax({
            type:'POST',
            data:{id},
            url:url_post,
            success:function(response){
                  console.log(response); 
                  //console.log("hola");  
                  let traer = JSON.parse(response);
                  traer.forEach((value)=>{

                $("#id").val(value.idDepartment);
                $("#inputName").val(value.name);
                $("#inputDescription").val(value.description);
                $("#inputPhone").val(value.phone);
                $("#inputEmail").val(value.emailDepartment);
                $("#inputIcon").val(value.iconDepartment);
                $("#disableDepartment").val(value.disableDepartment);
             });
            }
       });

});
</script>



<!-- Modal to edit Department -->
<div class="modal fade" id="editDepartmentModal" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDepartmentModalLabel">Editar Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <form action="" id="edit-form"> -->
                    <input type="hidden" id="url" value="<?php echo RUTA."updateDepartament"?>" name="">
                    <div class="form-group">
                        <label for="idDepartment">ID</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="inputName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <input type="text" class="form-control" id="inputDescription" name="description">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefono</label>
                        <input type="phone" class="form-control" id="inputPhone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="emailDepartment">Email</label>
                        <input type="emailDepartment" class="form-control" id="inputEmail" name="emailDepartment">
                    </div>
                    <div class="form-group">
                        <label for="iconDepartment">Icono</label>
                        <input type="text" class="form-control" id="inputIcon" name="iconDepartment">
                    </div>
                    <div class="form-group">
                        <label for="disable" class="form-label">DesHabilitado</label>
                                <select class="form-control" name="disableDepartment" id="disableDepartment">    
                                    <option value="0">Habilitado</option>
                                    <option value="1">Deshabilitado</option>
                                </select>
                    </div>
               <!--  </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdateSubmit">Editar Departamento</button>
            </div>
        </div>
    </div>
</div>
<script src="app/scripts/departments.js"></script>
