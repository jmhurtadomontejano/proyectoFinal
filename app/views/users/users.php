<?php
ob_start();
?>
            <?php MensajesFlash::imprimir_mensajes(); ?>

            <?php foreach ($user as $u): ?>
                <div class="articulo_listado">
                    <div class="titulo_articulo"><a href="ver_articulo/<?= $u->getId() ?>"><?= $u->getTitulo() ?></a></div>
                    <?php if(count($u->getFotos())>=1): ?>
                        <div class="fotos_articulo" style="background-image:url('<?= RUTA?>web/imagenes_articulos/<?= $u->getFotos()[0]->getNombre_archivo() ?>')"></div>
                    <?php else: ?>
                        <div class="fotos_articulo" style="background-image:url('<?= RUTA?>web/imagenes/articulo_generico.jpg')"></div>
                    <?php endif; ?>
                    <div class="descripcion_articulo"><?= substr($u->getDescripcion(), 0, 20) . "..." ?></div>
                    <div class="precio_articulo"><?= $u->getPrecio() ?> €</div>
                    <div class="contactar">CONTACTAR</div>
                    <div class="fecha_articulo"><?= $u->getFecha() ?></div>
                    <?= $u->getUsuario()->getNombre(); ?>
                    <?php if (Session::existe() && $u->getUsuario()->getId() == (Session::obtener())->getId()): ?>
                        <div class="borrar_articulo"><a href="<?= RUTA?>borrar_articulo/<?= $u->getId() ?>/<?=$token ?>"><img src="<?= RUTA?>web/iconos/trash.svg" class="papelera"></a></div>
                            <?php endif; ?>

                </div>
            <?php endforeach; ?>
 <?php
 $contenido = ob_get_clean();
 $titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
 $titulo2 = "Detalle de Articulos";
 require '../app/views/template.php';
 ?>