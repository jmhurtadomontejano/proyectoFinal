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

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= RUTA ?>">
                    <img src="images/icons/logo-AyuntamientoArgamasillaDeAlba.webp" alt="Logo" class="logo">
                    <div class="d-inline-block align-middle ms-2">
                        <p class="font-heading mb-0">Ayuntamiento de<br>Argamasilla de Alba</p>
                        <p class="font-heading-subtitle mb-0">El lugar de La Mancha</p>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= RUTA ?>">Inicio</a>
                        </li>
                        <li class="nav-item" hidden>
                            <a class="nav-link" href="<?= RUTA ?>indexBootstrap">Index Bootstrap</a>
                        </li>
                        <li class="nav-item dropdown" hidden>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownArticles" role="button" data-bs-toggle="dropdown">
                                Articulos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= RUTA ?>insertar_articulo">Poner artículo a la venta</a></li>
                                <li><a class="dropdown-item" href="<?= RUTA ?>listar_articulos">Listar Todos Los Articulos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= RUTA ?>insert_itemUsers">Insertar item</a>
                        </li>
                        <?php if (Session::existe()) : ?>
                            <?php
                            $conn = ConexionBD::conectar();
                            $usuDAO = new UsuarioDAO($conn);
                            $usuario = $usuDAO->findUserById(Session::obtener()->getId());
                            ?>
                            <?php if ($usuario->getRol() == 'admin' || $usuario->getRol() == 'superAdmin') : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown">
                                        Administradores
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_itemsDaylyAdmins">Mis Items Diarios Admins</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_itemsDaylyAdminsWithoutAttendat">Items Pendientes</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_items">Todos Mis Items sin filtros</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>own_itemsUsers">Mis Items como Cliente</a></li>
                                        <li><a class="dropdown-item" href="<?= RUTA ?>usersList">Gestion Usuarios</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($usuario->getRol() == 'superAdmin') : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSuperAdmin" role="button" data-bs-toggle="dropdown">
                                        SuperAdministradores
                                    </a>
                                    <ul class="dropdown-menu">
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

        <div class="MensajesFlash"><?php mensajesFlash::imprimir_mensajes() ?></div>
    </header>
    <main>
        <?= $contenido ?>
    </main>

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
