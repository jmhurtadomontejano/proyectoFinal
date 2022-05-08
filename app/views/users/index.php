<?php ob_start() ?>
<!-- scripts to change Userphoto-->
<script type="text/javascript">
$('#photo_usuario').click(function() {
    $('#input_photo').click();
});

$('#input_photo').change(function() {
    $('#formulario_actualizar_photo').submit();
})
</script>


<div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">


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
        <button  class="btn btn-secondary col-md-6 col-12 align-items-center justify-content-center">
            <h1>Inicia Sesión</h1>

            <form id="login" action="login" method="post">
                <input type="text" placeholder="email" name="email" class="form-control">
                <input type="password" placeholder="password" name="password" class="form-control">
                <br>
                <section class="d-flex justify-content-evenly flex-wrap">
                    <input type="submit" value="login" class="btn btn-primary" style="padding:10px">
                    <input type="button" value="registrar" onclick="location.href = '<?= RUTA?>registrar'"
                        class="btn btn-info">
                </section>
            </form>
        </button>
        <?php endif; ?>
 
</div>


<section class="d-flex justify-content-around flex-wrap">

    <!-- ADMIN MENU -->
    <?php if (Session::existe()) { ?>
    <button type="button" class="d-flex btn btnIndex btn-secondary col-md-3 col-12 d-flex align-items-center justify-content-center"
        style="margin:10px">
        <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>my_user">Mis Datos
        </a>
        <div id="userInfo" class="photo_user_index">
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
    <button type="button" class="btn btnIndex btn-primary col-md-3 col-12" style="margin:10px">
        <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>insert_item">Insertar item
            <!-- image of item-->
            <i class="fa-solid fa-list-alt" aria-hidden="true" style="size:20px"></i>
        </a>
    </button>
    <?php
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO($conn);
        $usuario = $usuDAO->findUserById(Session::obtener()->getId());
        ?>
    <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
    <button type="button" class="btn btnIndex btn-info col-md-3 col-12" style="margin:10px">
        <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>own_itemsDaylyAdmins">Mis Items Diarios
            <i class="fa-solid fa-list-check"></i></a>
    </button>
    </li>
    <?php } else{?>
    <button type="button" class="btn btnIndex btn-info col-md-3 col-12" style="margin:10px">
        <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>own_itemsUsers">Mis Items
            <i class="fa-solid fa-list-check"></i></a>
    </button>
    </li>
    <?php }?>

    <!-- END ADMIN MENU -->

    <!-- SUPERADMIN MENU -->
    <?php if ($usuario->getRol() == 'superAdmin') { ?>
    <button type="button" class="btn btnIndex btn-success col-md-3 col-12" style="margin:10px">
        <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>usersList">Usuarios
            <i class="fa-solid fa-users"></i>
        </a>
    </button>
    <button type="button" class="btn btnIndex btn-warning col-md-3 col-12" style="margin:10px">
        <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>departments_list">Departamentos
            <i class="fa-solid fa-building-user"></i>
        </a>
    </button>
    <button type="button" class="btn btnIndex btn-danger col-md-3 col-12" style="margin:10px">
        <a class="nav-link" style="color:white; font-size:2em" href="<?= RUTA?>items_list">Todos los items
            <i class="fa-solid fa-sitemap"></i>
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

