<?php
ob_start();
?>
            <?php MensajesFlash::imprimir_mensajes(); ?>

            <?php foreach ($mis_articulos as $a): ?>
                <div class="articulo_listado">
                    <div class="titulo_articulo"><a href="ver_articulo/<?= $a->getId() ?>"><?= $a->getTitulo() ?></a></div>
                    <?php if(count($a->getFotos())>=1): ?>
                        <div class="fotos_articulo" style="background-image:url('<?= RUTA?>web/imagenes_articulos/<?= $a->getFotos()[0]->getNombre_archivo() ?>')"></div>
                    <?php else: ?>
                        <div class="fotos_articulo" style="background-image:url('<?= RUTA?>web/imagenes/articulo_generico.jpg')"></div>
                    <?php endif; ?>
                    <div class="descripcion_articulo"><?= substr($a->getDescripcion(), 0, 20) . "..." ?></div>
                    <div class="precio_articulo"><?= $a->getPrecio() ?> €</div>
                    <div class="contactar">CONTACTAR</div>
                    <div class="fecha_articulo"><?= $a->getFecha() ?></div>
                    <?= $a->getUsuario()->getNombre(); ?>
                    <?php if (Session::existe() && $a->getUsuario()->getId() == (Session::obtener())->getId()): ?>
                        <div class="borrar_articulo"><a href="<?= RUTA?>borrar_articulo/<?= $a->getId() ?>/<?=$token ?>"><img src="<?= RUTA?>web/iconos/trash.svg" class="papelera"></a></div>
                            <?php endif; ?>

                </div>
            <?php endforeach; ?>
 <?php
 $contenido = ob_get_clean();
 $titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
 $titulo2 = "Detalle de Articulos";
 require '../app/views/template.php';

 ?>