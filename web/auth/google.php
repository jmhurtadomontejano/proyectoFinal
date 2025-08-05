<?php
require_once __DIR__ . '/../../app/core/Session.php';
$contenido = ob_get_clean();

if (!Session::existe()){
    $titulo2 = "Inicia Sesión";
}
require './app/views/template.php';
MensajesFlash::imprimir_mensajes();
?>

<div class="body d-flex align-items-center justify-content-center bg-br-primary ht-100v">
    <?php if (!Session::existe()): ?>

    <!-- OWN LOGIN -->
    <div class="login-container" style="max-width: 400px; margin: auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.12); padding: 2rem;">
        <div class="tx-center mg-b-60" style="font-size: 1.5rem; font-weight: bold; color: #222;">Ingrese usuario y contraseña</div>
        <form action="login" method="post" aria-label="Formulario de inicio de sesión">
            <div class="form-group mb-3">
                <label for="email" style="font-weight: 600; color: #222;">Correo electrónico</label>
                <input type="email" placeholder="ejemplo@correo.com" name="email" id="email" class="form-control" required aria-required="true" aria-label="Correo electrónico" style="font-size: 1.1rem; background: #f9f9f9; border: 2px solid #007bff; border-radius: 8px;">
            </div>
            <div class="form-group mb-4">
                <label for="password" style="font-weight: 600; color: #222;">Contraseña</label>
                <input type="password" placeholder="Contraseña" name="password" id="password" class="form-control" required aria-required="true" aria-label="Contraseña" style="font-size: 1.1rem; background: #f9f9f9; border: 2px solid #007bff; border-radius: 8px;">
            </div>
            <section class="d-flex justify-content-center flex-wrap">
                <button type="submit" id="btnlogin" class="btn btn-info btn-block col-12" style="font-size: 1.2rem; padding: 0.75rem; border-radius: 8px; background: #007bff; color: #fff; border: none; font-weight: bold;" aria-label="Iniciar sesión">
                    <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                </button>
            </section>
        </form>
        <!-- END OWN LOGIN-->
        <br>

        <!-- FORGOT PASSWORD -->
        <div class="tx-center mg-t-20">
            <a href="forgot_password" class="tx-info">He olvidado mi contraseña</a>
        </div>
        <!-- END FORGOT PASSWORD -->

        <!-- SOCIAL MEDIA BUTTONS-->
        <a href="<?= RUTA ?>auth/facebook" class="btn btn-primary btn-block btn-with-icon" id="btnloginf">
            <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-facebook"></i></span>
                <span class="pd-x-15">Login with Facebook</span>
            </div>
        </a>
        <a href="/proyectoFinal/web/auth/google.php" class="btn btn-danger btn-block btn-with-icon" id="btnloging">
            <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-google-plus"></i></span>
                <span class="pd-x-15">Login with Gmail</span>
            </div>
        </a>
        <a href="<?= RUTA ?>auth/github" class="btn btn-dark btn-block btn-with-icon" id="btnloginh">
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
<?php endif; ?>
</div>
<section class="d-flex justify-content-around flex-wrap">

    <!-- ADMIN MENU -->
    <?php if (Session::existe()) { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3" href="<?= RUTA?>my_user">
        <div class="btnIndexText">
            Mis Datos
        </div>
        <div class="userInfoIndex">
            <div class="btnIndexText-Name"><?= Session::obtener()->getNombre() ?>
                <?= Session::obtener()->getSurname() ?>
            </div>
            <div class="photo_user_index"
                style="background-image: url(<?= RUTA?>images/users/<?= Session::obtener()->getPhoto() ?>)">
            </div>
        </div>
    </a>

    <a class="nav-link index-options btnIndex col-12 col-md-3" href="<?= RUTA?>insert_item">
        <div class="btnIndexText">
            Insertar item
        </div>
        <div class="fa-container">
            <i class="fa-solid fa-file-circle-plus" aria-hidden="true"></i>
        </div>
    </a>

    <?php
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO($conn);
        $usuario = $usuDAO->findUserById(Session::obtener()->getId());
    ?>
    <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3" 
        href="<?= RUTA?>own_itemsDaylyAdmins">
        <div class="btnIndexText">
            Mis Items Diarios
        </div>
        <div class="fa-container">
            <i class="fa-solid fa-list-check"></i>
        </div>
    </a>

    <a class="nav-link index-options btnIndex col-12 col-md-3" href="<?= RUTA?>own_itemsUsers">
        <div class="btnIndexText">
            Mis Items Cliente
        </div>
        <div class="fa-container">
            <i class="fa-solid fa-id-badge"></i>
        </div>
    </a>

    <?php if ($usuario->getRol() == 'admin') { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3" href="<?= RUTA?>usersList">
        <div class="btnIndexText">
            Usuarios
        </div>
        <div class="fa-container">
            <i class="fa-solid fa-users"></i>
        </div>
    </a>
    <?php } ?>

    <?php if($usuario->getRol() =='superAdmin') { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3" href="<?= RUTA?>usersListAdmins">
        <div class="btnIndexText">
            Usuarios SUPER
        </div>
        <div class="fa-container">
            <i class="fa-solid fa-users"></i>
        </div>
    </a>
    <?php } ?>

    <?php } else { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3" href="<?= RUTA?>own_itemsUsers">
        <div class="btnIndexText">
            Mis Items
        </div>
        <div class="fa-container">
            <i class="fa-solid fa-id-badge"></i>
        </div>
    </a>
    <?php } ?>
    <!-- END ADMIN MENU -->

    <!-- SUPERADMIN MENU -->
    <?php if ($usuario->getRol() == 'superAdmin') { ?>
    <a class="nav-link index-options btnIndex col-12 col-md-3" href="<?= RUTA?>departments_list">
        <div class="btnIndexText">
            Departamentos
        </div>
        <div class="fa-container">
            <i class="fa-solid fa-building-user"></i>
        </div>
    </a>

    <a class="nav-link index-options btnIndex col-12 col-md-3" href="<?= RUTA?>items_list">
        <div class="btnIndexText">
            Todos los items
        </div>
        <div class="fa-container">
            <i class="fa-solid fa-sitemap"></i>
        </div>
    </a>
    <?php } ?>
    <?php } ?>
    <!-- END SUPERADMIN MENU -->
</section>
</div>
</body>