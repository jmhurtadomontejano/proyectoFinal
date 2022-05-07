<?php ob_start() ?>

<div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
   
        <section class="">
            <?php if (Session::existe()): ?>
            <div id="userInfo" hidden>
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
  
</div>


    <section class="d-flex justify-content-around flex-wrap">

        <!-- ADMIN MENU -->
        <?php if (Session::existe()) { ?>
        <button type="button" class="btn btn-secondary col-md-3 col-12 d-flex align-items-center justify-content-center" style="margin:10px">
            <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>my_user">Mis Datos
            </a>
            <div id="userInfo">
                <div id="photo_usuario" class="align-items-center justify-content-center"
                    style="background-image: url(<?= RUTA?>web/images/users/<?= Session::obtener()->getPhoto() ?>)">
                </div>
                <form id="formulario_actualizar_photo" action="subir_photo" method="post" enctype="multipart/form-data">
                    <input type="file" name="photo" id="input_photo">
                    <input type="submit">
                </form>
                <div id="userInfo"><?= Session::obtener()->getNombre() ?>
                    <?= Session::obtener()->getSurname() ?>
                    <br>
                    <a href="logout" style="color:black; width:bold">cerrar sesión</a>
                </div>
            </div>
        </button>
        <button type="button" class="btn btn-primary col-md-3 col-12" style="margin:10px">
            <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>insert_item">Insertar item
                <!-- image of item-->
                <i class="fa fa-list-alt fa-5x" aria-hidden="true" style="size:20px"></i>
            </a>
        </button>
        <?php
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO($conn);
        $usuario = $usuDAO->findUserById(Session::obtener()->getId());
        ?>
        <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
        <button type="button" class="btn btn-info col-md-3 col-12" style="margin:10px">
            <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>own_itemsDaylyAdmins">Mis Items Diarios
                <i class="fa-solid fa-list-check fa-5x"></i></a>
        </button>
        </li>
        <?php } ?>

        <!-- SUPERADMIN MENU -->
        <?php if ($usuario->getRol() == 'superAdmin') { ?>
        <button type="button" class="btn btn-success col-md-3 col-12" style="margin:10px">
            <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>usersList">Usuarios
                <i class="fa-solid fa-users fa-5x"></i>
            </a>
        </button>
        <button type="button" class="btn btn-warning col-md-3 col-12" style="margin:10px">
            <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>departments_list">Departamentos
                <i class="fa-solid fa-building-user fa-5x"></i>
            </a>
        </button>
        <button type="button" class="btn btn-danger col-md-3 col-12" style="margin:10px">
            <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>items_list">Listar todos los items
                <i class="fa-solid fa-sitemap fa-5x"></i>
            </a>
        </button>
        <?php } ?>
        <?php } ?>
    </section>


<?php
$contenido = ob_get_clean();
$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";
$titulo2 = "INICIO";
require '../app/views/template.php';
?>