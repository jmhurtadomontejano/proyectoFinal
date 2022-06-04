<?php
$contenido = ob_get_clean();
/*$titulo = "Web Registro Trabajos Ayto. Argamasilla de Alba";*/
/*$titulo2 = "INICIO";*/
require './app/views/template.php';
MensajesFlash::imprimir_mensajes();
?>

<div class="body d-flex align-items-center justify-content-center bg-br-primary ht-100v">
    <?php if (!Session::existe()): ?>

            <!-- OWN LOGIN -->
            <div>
                <h1>Inicia Sesión</h1>
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
                        href="<?=RUTA."../app/views/users/registerSocialMedia.php"?>"
                        class="tx-info">Registrarse Redes
                        Sociales</a></div>

                <div class="mg-t-60 tx-center">¿Todavía no esta registrado? <a href="<?= RUTA?>registrar">Registrarse
                        Original</a>
                </div>
            </div>
        </div>

        <script src="public/lib/jquery/jquery.js"></script>
        <!-- 2508  <script src="public/lib/popperjs/popper.js"></script> 
        <script src="public/lib/bootstrap/bootstrap.js"></script>

        <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-auth.js"></script>
        <script src="app/scripts/index.js"></script>
        -->
        </body>
        <!-- END SOCIAL MEDIA SECTION -->

        <?php endif; ?>
    </div>
    <section class="d-flex justify-content-around flex-wrap">

        <!-- ADMIN MENU -->
        <?php if (Session::existe()) { ?>
        <button type="button"
            class="btn btnIndexBootstrap btn-secondary col-12 col-md-3 col-xl-2 d-flex align-items-center justify-content-center"
            style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em" href="<?= RUTA?>my_user">Mis Datos
            </a>
            <div class="userInfoIndex">
                <div class="photo_user"
                    style="background-image: url(<?= RUTA?>images/users/<?= Session::obtener()->getPhoto() ?>)">
                </div>
                <div class="d-flex-wrap"><?= Session::obtener()->getNombre() ?>
                    <?= Session::obtener()->getSurname() ?> </div>
                    <br>
                <div class="d-flex-wrap">
                    <a href="logout" style="color:white">cerrar sesión</a>
                </div>
            </div>
        </button>
        <button type="button" class="btn btnIndexBootstrap btn-primary col-12 col-md-3 col-xl-2" style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em" href="<?= RUTA?>insert_item">Insertar
                item
                <!-- image of item-->
                <i class="fa-solid fa-file-circle-plus" aria-hidden="true" style="size:20px"></i>
            </a>
        </button>
        <?php
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO($conn);
        $usuario = $usuDAO->findUserById(Session::obtener()->getId());
        ?>
        <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') { ?>
        <button type="button" class="btn btnIndexBootstrap btn-info col-12 col-md-3 col-xl-2" style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em"
                href="<?= RUTA?>own_itemsDaylyAdmins">Mis Items
                Diarios
                <i class="fa-solid fa-list-check"></i></a>
        </button>
        <button type="button" class="btn btnIndexBootstrap btn-info col-12 col-md-3 col-xl-2" style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em" href="<?= RUTA?>own_itemsUsers">Mis
                Items Cliente
                <i class="fa-solid fa-id-badge"></i></a>
        </button>
        <?php if ($usuario->getRol() == 'admin') { ?>
        <button type="button" class="btn btnIndexBootstrap btn-success col-12 col-md-3 col-xl-2" style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em" href="<?= RUTA?>usersList">Usuarios
                <i class="fa-solid fa-users"></i>
            </a>
        </button>
        <?php } ?>
        <?php if($usuario->getRol() =='superAdmin') { ?>
        <button type="button" class="btn btnIndexBootstrap btn-success col-12 col-md-3 col-xl-2" style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em"
                href="<?= RUTA?>usersListAdmins">Usuarios SUPER
                <i class="fa-solid fa-users"></i>
            </a>
        </button>
        <?php } ?>
        <?php } else{?>
        <button type="button" class="btn btnIndexBootstrap btn-info col-12 col-md-3 col-xl-2" style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em" href="<?= RUTA?>own_itemsUsers">Mis
                Items
                <i class="fa-solid fa-id-badge"></i></i></a>
        </button>
        <?php }?>

        <!-- END ADMIN MENU -->

        <!-- SUPERADMIN MENU -->
        <?php if ($usuario->getRol() == 'superAdmin') { ?>
        <button type="button" class="btn btnIndexBootstrap btn-warning col-12 col-md-3 col-xl-2" style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em"
                href="<?= RUTA?>departments_list">Departamentos
                <i class="fa-solid fa-building-user"></i>
            </a>
        </button>
        <button type="button" class="btn btnIndexBootstrap btn-danger col-12 col-md-3 col-xl-2" style="margin:10px">
            <a class="nav-link index-options" style="color:white; font-size:2em" href="<?= RUTA?>items_list">Todos los
                items
                <i class="fa-solid fa-sitemap"></i>
            </a>
        </button>
        <?php } ?>
        <?php } ?>
    </section>
</div>
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