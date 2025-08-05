<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icons/logo-AyuntamientoArgamasillaDeAlba.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Argamasilla de Alba</title>

    <!-- Google Apis -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.5/datatables.min.css" />
    <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.5/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <script src="https://use.fontawesome.com/2a534a9a61.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styleGuide.css">


    <!-- Social Media Metadata -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Bracket">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
</head>

<body class="container-fluid p-1">
    <header>
        <?php if (!empty($titulo)) : ?>
            <div id="titulo">
                <h1><?= $titulo ?></h1>
                <?php if (!empty($templateContent)) : ?>
                    <div><?= $templateContent ?></div>
                <?php endif; ?>
                <?php if (!empty($templateContentFilters)) : ?>
                    <div><?= $templateContentFilters ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- NAV -->
        <nav class="navbar navbar-light bg-light navbar-expand-lg shadow sticky-top">
            <div class="container-fluid px-3">
                <!-- LOGO -->
                <a class="navbar-brand mt-1 ms-2" href="<?= RUTA ?>">
                    <img src="images/icons/logo-AyuntamientoArgamasillaDeAlba.webp" class="me-2 logo" alt="Logo Ayuntamiento">
                    <span class="d-inline-block align-middle" style="line-height:1.1;">
                        <span class="fw-bold" style="font-size:1.1rem; color:#1a237e;">Ayuntamiento de</span><br>
                        <span class="fw-bold" style="font-size:1.1rem; color:#1a237e;">Tomelloso</span>
                    </span>
                </a>
                <!-- BOTON DESPLEGABLE -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- ENLACES -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-5">
                        <li class="nav-item ms-lg-4">
                            <a class="nav-link fs-4 <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active fs-3' : ''; ?>"
                                href="<?= RUTA ?>">Inicio</a>
                        </li>
                        <li class="nav-item" hidden>
                            <a class="nav-link fs-4" href="<?= RUTA ?>indexBootstrap">Index Bootstrap</a>
                        </li>
                        <li class="nav-item dropdown fs-4" hidden>
                            <a class="nav-link dropdown-toggle fs-4"
                                href="#" id="navbarDropdownArticles" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Articulos
                            </a>
                            <ul class="dropdown-menu fs-4" aria-labelledby="navbarDropdownArticles">
                                <li><a class="dropdown-item" href="<?= RUTA ?>insertar_articulo">Poner artículo a la venta</a></li>
                                <li><a class="dropdown-item" href="<?= RUTA ?>listar_articulos">Listar Todos Los Articulos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-4" href="<?= RUTA ?>insert_itemUsers">Insertar item</a>
                        </li>
                        <?php if (Session::existe()) : ?>
                            <?php
                            static $usuario = null;
                            if ($usuario === null) {
                                $conn = ConexionBD::conectar();
                                $usuDAO = new UsuarioDAO($conn);
                                $usuario = $usuDAO->findUserById(Session::obtener()->getId());
                                if (method_exists($conn, 'close')) {
                                    $conn->close();
                                }
                            }
                            ?>
                            <?php if ($usuario && ($usuario->getRol() == 'admin' || $usuario->getRol() == 'superAdmin')) : ?>
                                <li class="nav-item dropdown fs-4">
                                    <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Administradores
                                    </a>
                                    <ul class="dropdown-menu fs-4" aria-labelledby="navbarDropdownAdmin">
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_itemsDaylyAdmins">Mis Items Diarios Admins</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_itemsDaylyAdminsWithoutAttendat">Items Pendientes</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_items">Todos Mis Items sin filtros</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_itemsUsers">Mis Items como Cliente</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>usersList">Gestion Usuarios</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($usuario && $usuario->getRol() == 'superAdmin') : ?>
                                <li class="nav-item dropdown fs-4">
                                    <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdownSuperAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        SuperAdministradores
                                    </a>
                                    <ul class="dropdown-menu fs-4" aria-labelledby="navbarDropdownSuperAdmin">
                                        <li><a class="dropdown-item" href="<?= RUTA ?>departments_list">Lista Departamentos</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>departments_listResponsive">Lista Departamentos Responsive</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>items_list">Listar todos los items SuperAdmin</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_itemsDaylyAdminsWithoutAttendat">Items Pendientes</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>usersListAdmins">Gestion Users SuperAdmin</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                        <?php if (Session::existe()) : ?>
                            <li class="nav-item d-flex align-items-center">
                                <div class="photo_user me-2" style="background-image: url('<?= RUTA ?>images/users/<?= Session::obtener()->getPhoto() ?>');"></div>
                                <div id="userInfo">
                                    <?= Session::obtener()->getNombre() ?> <?= Session::obtener()->getSurname() ?><br>
                                    <a class="close-session" href="logout">cerrar sesión</a>
                                </div>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <button type="button" class="btn btn-secondary">
                                    <form id="login" action="login" method="post">
                                        <input type="text" placeholder="email" name="email" class="form-control mb-1">
                                        <input type="password" placeholder="password" name="password" class="form-control mb-2">
                                        <div class="d-flex justify-content-evenly">
                                            <input type="submit" value="login" class="btn btn-primary btn-sm me-1">
                                            <input type="button" value="registrar" class="btn btn-info btn-sm" onclick="location.href = '<?= RUTA ?>registrar'">
                                        </div>
                                    </form>
                                </button>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="MensajesFlash"><?php mensajesFlash::imprimir_mensajes() ?></div>
    </header>
    <div id="main-wrapper">
        <main>
        <!-- Aquí va el contenido principal -->
        </main>
        <?php if (!empty($titulo2)) : ?>
            <div id="titulo2" class="options_box p-3 my-3">
                <div class="d-flex justify-content-between">
                    <h2 class="m-0"><?= $titulo2 ?></h2>
                    <?php if (!empty($templateContent)) : ?>
                        <div><?= $templateContent ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script>
        // Ajusta el margen superior dinámicamente según la altura visible de la navbar sticky-top (incluyendo el menú expandido)
        function adjustMainMargin(animated = false) {
            var navbar = document.querySelector('.navbar.sticky-top');
            var wrapper = document.getElementById('main-wrapper');
            if (navbar && wrapper) {
                var navbarCollapse = document.getElementById('navbarSupportedContent');
                var extraHeight = 0;
                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                    extraHeight = navbarCollapse.scrollHeight;
                }
                var newMargin = (navbar.offsetHeight + extraHeight) + 'px';
                if (animated) {
                    wrapper.style.transition = 'margin-top 0.4s cubic-bezier(.4,2,.6,1)';
                } else {
                    wrapper.style.transition = '';
                }
                wrapper.style.marginTop = newMargin;
            }
        }
        window.addEventListener('load', function() { adjustMainMargin(false); });
        window.addEventListener('resize', function() { adjustMainMargin(false); });
        var navbarCollapse = document.getElementById('navbarSupportedContent');
        if (navbarCollapse) {
            navbarCollapse.addEventListener('show.bs.collapse', function() { adjustMainMargin(true); });
            navbarCollapse.addEventListener('shown.bs.collapse', function() { adjustMainMargin(true); });
            navbarCollapse.addEventListener('hide.bs.collapse', function() { adjustMainMargin(true); });
            navbarCollapse.addEventListener('hidden.bs.collapse', function() { adjustMainMargin(true); });
        }
    </script>

    <script>
        $('#photo_usuario').click(function () {
            $('#input_photo').click();
        });
        $('#input_photo').change(function () {
            $('#formulario_actualizar_photo').submit();
        });
    </script>
</body>

</html>
