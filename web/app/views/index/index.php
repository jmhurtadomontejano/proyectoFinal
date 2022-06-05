<?php
$contenido = ob_get_clean();
/*$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";*/
if (!Session::existe()){
    $titulo2 = "Inicia Sesión";
}
require './app/views/template.php';
MensajesFlash::imprimir_mensajes();
?>

<div class="body d-flex align-items-center justify-content-center bg-br-primary ht-100v">
    <?php if (!Session::existe()): ?>

    <!-- OWN LOGIN -->
    <div>
        <div class="tx-center mg-b-60">Ingrese usuario y contraseña</div>
        <form action="login" method="post">
            <input type="email" placeholder="email" name="email" id="email" class="form-control">
            <input type="password" placeholder="password" name="password" class="form-control">
            <section class="d-flex justify-content-evenly flex-wrap">
                <input type="submit" value="Login" id="btnlogin" class="btn btn-info btn-block col-12">
            </section>
        </form>
        <!-- END OWN LOGIN-->
        <br>

        <!-- SOCIAL MEDIA BUTTONS-->
        <a href="#" class="btn btn-primary btn-block btn-with-icon" id="btnloginf">
            <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-facebook"></i></span>
                <span class="pd-x-15">Login with Facebook</span>
            </div>
        </a>
        <a href="#" class="btn btn-danger btn-block btn-with-icon" id="btnloging">
            <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-google-plus"></i></span>
                <span class="pd-x-15">Login with Gmail</span>
            </div>
        </a>
        <a href="#" class="btn btn-dark btn-block btn-with-icon" id="btnloginh">
            <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-github"></i></span>
                <span class="pd-x-15">Login with Github</span>
            </div>
        </a>
        <!-- END SOCIAL MEDIA BUTTONS-->

        <div class="mg-t-60 tx-center">¿Todavía no esta registrado? <a
                href="/proyectoFinal/app/views/users/registerSocialMedia.php" class="tx-info">Registrarse Redes
                Sociales</a></div>

        <div class="mg-t-60 tx-center">¿Todavía no esta registrado? <a href="<?= RUTA?>registrar">Registrarse
                Original</a>
        </div>
    </div>
</div>

<script src="public/lib/jquery/jquery.js"></script>
<!--   <script src="public/lib/popperjs/popper.js"></script> -->
<!-- 
    <script src="public/lib/bootstrap/bootstrap.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-auth.js"></script>
<script src="app/scripts/index.js"></script>
-->

<!-- END SOCIAL MEDIA SECTION -->

<?php endif; ?>
</div>
<section class="d-flex justify-content-around flex-wrap">

    <!-- ADMIN MENU -->
    <?php if (Session::existe()) { ?>
    <!--   <button type="button" class="btn btnIndex col-12 col-md-3 col-xl-2 d-flex align-items-center justify-content-center"
        style="margin:10px" hidden="hidden">
        <div class="btnIndexText">
            <a class="nav-link index-options" href="<?= RUTA?>my_user">Mis Datos
            </a>
        </div>
        <div class="btnIndexText">
            Mis DATOS Cliente
        </div>
        <div class="userInfoIndex">
            <div class="photo_user"
                style="background-image: url(<?= RUTA?>images/users/<?= Session::obtener()->getPhoto() ?>)">
            </div>
            <div class="d-flex-wrap"><?= Session::obtener()->getNombre() ?>
                <?= Session::obtener()->getSurname() ?> </div>
            <div class="d-flex-wrap">
                <br>
                <a href="logout">cerrar sesión</a>
            </div>
        </div>
    </button>
    -->
    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px" href="<?= RUTA?>my_user">
        <div class="btnIndexText">
            Mis Datos
        </div>
        <div class="userInfoIndex">
            <div class="photo_user"
                style="background-image: url(<?= RUTA?>images/users/<?= Session::obtener()->getPhoto() ?>)">
            </div>
            <div class="d-flex-wrap btnIndexText-Name"><?= Session::obtener()->getNombre() ?>
                <?= Session::obtener()->getSurname() ?> </div>

        </div>
    </a>


    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px"
        href="<?= RUTA?>insert_item">
        <div class="btnIndexText">
            Insertar item
        </div>
        <div>
            <i class="fa-solid fa-file-circle-plus" aria-hidden="true" style="size:20px"></i>
        </div>
    </a>


    <?php
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO($conn);
        $usuario = $usuDAO->findUserById(Session::obtener()->getId());
        ?>
    <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px"
        href="<?= RUTA?>own_itemsDaylyAdmins">
        <div class="btnIndexText">
            Mis Items Diarios
        </div>
        <div>
            <i class="fa-solid fa-list-check"></i>
        </div>
    </a>


    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px"
        href="<?= RUTA?>own_itemsUsers">
        <div class="btnIndexText">
            Mis Items Cliente
        </div>
        <div>
            <i class="fa-solid fa-id-badge"></i>
        </div>
    </a>


    <?php if ($usuario->getRol() == 'admin') { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px" href="<?= RUTA?>usersList">
        <div class="btnIndexText">
            Usuarios
        </div>
        <div>
            <i class="fa-solid fa-users"></i>
        </div>
    </a>
    <?php } ?>

    <?php if($usuario->getRol() =='superAdmin') { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px"
        href="<?= RUTA?>usersListAdmins">
        <div class="btnIndexText">
            Usuarios SUPER
        </div>
        <div>
            <i class="fa-solid fa-users"></i>
        </div>
    </a>
    <?php } ?>

    <?php } else{?>
    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px"
        href="<?= RUTA?>own_itemsUsers">
        <div class="btnIndexText">
            Mis Items
        </div>
        <div>
            <i class="fa-solid fa-id-badge"></i></i>
        </div>
    </a>
    <?php }?>

    <!-- END ADMIN MENU -->

    <!-- SUPERADMIN MENU -->
    <?php if ($usuario->getRol() == 'superAdmin') { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px"
        href="<?= RUTA?>departments_list">
        <div class="btnIndexText">
            Departamentos
        </div>
        <div>
            <i class="fa-solid fa-building-user"></i>
        </div>
    </a>

    <a class="nav-link index-options btnIndex col-12 col-md-3 col-xl-2" style="margin:10px" href="<?= RUTA?>items_list">
        <div class="btnIndexText">
            Todos los items
        </div>
        <div>
            <i class="fa-solid fa-sitemap"></i>
        </div>
    </a>
    <?php } ?>
    <?php } ?>
    <!-- END SUPERADMIN MENU -->


    </div>
    </div>
    <!-- button on click call href="<?= RUTA?>my_user">Mis Datos -->



</section>
</div>
</body>
<!-- END MENU -->

<!-- scripts to change Userphoto-->
<!--  <script type="text/javascript">
    $('#photo_usuario').click(function() {
        $('#input_photo').click();
    });

    $('#input_photo').change(function() {
        $('#formulario_actualizar_photo').submit();
    })
    </script> -->