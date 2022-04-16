<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<?php foreach ($items as $i): ?>
<div class="articulo_listado">
    <div class="titulo_articulo"><a href="<?= RUTA?>ver_item/<?= $i->getId() ?>"><?= $i->getName() ?></a></div>
    <?php if(count($i->getPhotosItem())>=1): ?>
    <div class="photos_articulo" style="background-image:url('<?= RUTA?>web/images/items/<?= $i->getPhotosItem()[0]->getFile_name() ?>');
                background-size: contain;
                background-position: center;
                background-repeat: no-repeat;
                height:100px;">
    </div>
    <?php else: ?>
    <div class="photos_articulo" style="background-image:url('<?= RUTA?>web/images/items/genericItem.jpg')"></div>
    <?php endif; ?>
    <div class="descripcion_articulo"><?= substr($i->getDescription(), 0, 20) . "..." ?></div>
    <div class="precio_articulo" style="font-weight: bold;
                color: #f00;
                width: 100px;
                padding: 3px;
                text-align: center;
                margin: auto;
                font-family: verdana;"><?= $i->getLocation() ?> €</div>
    <div class="contactar">CONTACTAR</div>
    <div class="fecha_articulo"><?= $i->getFecha() ?></div>
    <?= $i->getUser()->getNombre(); ?>
    <?php if (Session::existe() && $i->getUser()->getId() == (Session::obtener())->getId()): ?>
    <div class="borrar_articulo"><a href="borrar_articulo/<?= $i->getId() ?>/<?=$token ?>"><img
                src="<?= RUTA?>web/images/icons/trash.svg" class="papelera"></a></div>
    <?php endif; ?>

</div>
<?php endforeach; ?>


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
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= RUTA?>editar_usuario/<?= $i->getId() ?>" method="POST" enctype="multipart/form-data">
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