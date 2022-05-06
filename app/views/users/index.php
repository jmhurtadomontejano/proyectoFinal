<?php ob_start() ?>

<div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
    <button type="button">
        <section class="">
            <?php if (Session::existe()): ?>
            <div id="userInfo">
                <div id="photo_usuario"
                    style="background-image: url(<?= RUTA?>web/images/users/<?= Session::obtener()->getPhoto() ?>)">
                </div>
                <form id="formulario_actualizar_photo" action="subir_photo" method="post" enctype="multipart/form-data">
                    <input type="file" name="photo" id="input_photo">
                    <input type="submit">
                </form>
                <div id="userInfo"><?= Session::obtener()->getNombre() ?>
                    <?= Session::obtener()->getSurname() ?>
                    <br>
                    <a href="logout">cerrar sesión</a>
                </div>
            </div>

            <?php else: ?>
            <form id="login" action="login" method="post">
                <input type="text" placeholder="email" name="email">
                <input type="password" placeholder="password" name="password"><br>
                <input type="submit" value="login" class="boton_formulario">
                <input type="button" onclick="location.href = '<?= RUTA?>registrar'" value="registrar"
                    class="boton_formulario">
            </form>
        </section>
        <?php endif; ?>
    </button>
</div>

<div class="d-flex align-items-center justify-content-center bg-br-primary">
    <section class="align-items-center justify-content-center bg-br-primary">
        <!-- ADMIN MENU -->
        <?php if (Session::existe()) { ?>
        <button type="button" class="btn btn-primary col-md-3 col-12" style="margin:10px"><a class="nav-link"
                style="color:white" href="<?= RUTA?>insert_item">Insertar item</a>
            <!-- image of item-->
            <i class="fa fa-list-alt fa-10x" aria-hidden="true" style="size:20px"></i>

        </button>
        <?php
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO($conn);
        $usuario = $usuDAO->findUserById(Session::obtener()->getId());
        ?>
        <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
        <button type="button" class="btn btn-primary col-md-3 col-12" style="margin:10px"><a class="nav-link"
                style="color:white" href="<?= RUTA?>own_items">Mis Items</a>
            <i class="fa-solid fa-list-check fa-10x"></i>
        </button>
        </li>
        <?php } ?>

        <!-- SUPERADMIN MENU -->
        <?php if ($usuario->getRol() == 'superAdmin') { ?>
        <button type="button" class="btn btn-primary col-md-3 col-12" style="margin:10px"><a class="nav-link"
                style="color:white" href="<?= RUTA?>usersList">Gestion Usuarios</a>
            <i class="fa-solid fa-users fa-10x"></i>
        </button>
        <button type="button" class="btn btn-primary col-md-3 col-12" style="margin:10px"><a class="nav-link"
                style="color:white" href="<?= RUTA?>departments_list">Lista Departamentos</a>
            <i class="fa-solid fa-building-user fa-10x"></i>
        </button>
        <button type="button" class="btn btn-primary col-md-3 col-12" style="margin:10px"><a class="nav-link"
                style="color:white" href="<?= RUTA?>items_list">Listar todos los items</a>
            <i class="fa-solid fa-sitemap fa-10x"></i>
        </button>
        <?php } ?>
        <?php } ?>
    </section>
</div>

<?php
$contenido = ob_get_clean();
$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
$titulo2 = "INICIO";
require '../app/views/template.php';
?>