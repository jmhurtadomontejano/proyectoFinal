<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>



<table class="table" id="table">
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
    <tbody>
        <?php foreach ($items as $i): ?>
        <tr>
            <th id="userInfo"><?= $i->getName() ?></th>
            <th id="userInfo"><?= $i->getDescription() ?></th>
            <th id="userInfo"><?= $i->getLocation() ?></th>
            <th id="userInfo"><?= $i->getId_departament() ?></th>
            <th> <?php if ($i->getPhotosItem() != null): ?>
                <!-- we check the photo exists in the gallery -->

                <img id="photo_usuario" style="background-image: url(<?= RUTA?>web/images/item/<?= $i->getPhotosItem() ?>)"
                    class="img-thumbnail" alt="" width="100" height="100">
                <?php else: ?>
                <img style="background-image: url(<?= RUTA?>web/images/users/user_generico.png)" class="img-thumbnail"
                    alt="" width="100" height="100">
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

<?php
 $contenido = ob_get_clean();
 $titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
 $titulo2 = "Detalle de Articulos";
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