<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            <th scope="col">Foto</th>
            <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usersList as $u): ?>
        <tr>
        <th id="userInfo"><?= $u->getNombre() ?></th>
        <th id="userInfo"><?= $u->getSurname() ?></th>
        <th id="userInfo"><?= $u->getEmail() ?></th>
        <th id="userInfo"><?= $u->getRol() ?></th>
            <th id="photo_usuario" style="background-image: url(<?= RUTA?>web/images/users/<?= $u->getPhoto() ?>)">
            </th>
        </tr>
        
            <?php endforeach; ?>
</table>

<?php
 $contenido = ob_get_clean();
 $titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
 $titulo2 = "Detalle de Articulos";
 require '../app/views/template.php';
 ?>