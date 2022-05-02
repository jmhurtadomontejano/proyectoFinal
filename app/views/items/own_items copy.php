<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

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
<?php
 $contenido = ob_get_clean();
 $titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
 $titulo2 = "Detalle de Items";
 require '../app/views/template.php';
 ?>