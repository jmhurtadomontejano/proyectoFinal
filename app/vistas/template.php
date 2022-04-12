<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <script src="https://use.fontawesome.com/2a534a9a61.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style type="text/css">
    header {
        overflow: auto;
    }

    #usuario,
    #login {
        width: 300px;
        float: right;
        position: relative;
    }

    #login input {
        margin-top: 3px;
    }


    .boton_formulario {
        border: 1px solid black;
        box-sizing: border-box;
        display: inline-block;
        padding: 3px;
        background-color: #eee;
        text-decoration: none;
        color: black;

    }

    .fotos_articulo {
        height: 100px;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
    }

    .articulo_listado {
        float: left;
        min-height: 200px;
        border: 1px solid black;
        margin: 5px;
        padding: 5px;
        position: relative;
        width: 150px;
    }

    .articulo_ver {
        border: 1px solid black;
        margin: 5px;
        padding: 5px;
        position: relative;

    }

    .papelera {
        height: 20px;
        opacity: 0.5;
    }

    .papelera:hover {
        opacity: 1;
    }

    .borrar_articulo {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
    }

    main {
        overflow: auto;
    }

    .precio_articulo {

        font-weight: bold;
        color: #f00;
        width: 100px;
        padding: 3px;
        text-align: center;
        margin: auto;
        font-family: verdana;
    }

    .contactar {
        font-size: 1em;
        font-weight: bold;
        color: #00f;
        border: 1px solid black;
        width: 120px;
        padding: 3px;
        border-radius: 50px;
        text-align: center;
        margin: 5px auto;
        font-family: verdana;
    }

    .contactar:hover {
        background-color: #aaa;
        cursor: pointer;
        transition: 0.5s all;
        width: 130px;
    }

    menu {
        overflow: auto;
        border-bottom: 1px solid black;
        border-top: 1px solid black;
        margin: 0px 5px;
        padding: 0px;
    }

    ul#menu_usuario {
        margin: 0px;
        padding: 0px;
    }

    ul#menu_usuario li {
        margin: 0px;
        padding: 5px;
        list-style-type: none;
        float: left;
        border: 1px solid white;
        cursor: pointer;
        background-color: #eee;
    }

    ul#menu_usuario li:hover {
        background-color: #aaa;
    }

    ul#menu_usuario li a {
        text-decoration: none;
        color: black;
        cursor: pointer;
    }

    #foto_usuario {
        height: 80px;
        width: 80px;
        background-size: cover;
        background-position: center;
        border-radius: 40px;
        box-shadow: 0px 0px 5px 0px #aaa;
        margin: 5px;
    }

    #datos_usuario {
        position: absolute;
        top: 40px;
        left: 100px;
    }

    #formulario_actualizar_photo {
        display: none;
    }
    </style>
</head>

<body>
    <header>
        <div id="titulo">
            <h1><?php echo $titulo ?></h1>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <div class="container-fluid">
            <img src="<?= RUTA?>web/images/icons/logo-AyuntamientoArgamasillaDeAlba.webp" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation" >
                <a class="navbar-brand" href="#" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">Menu</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= RUTA?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= RUTA?>insertar_articulo">Poner artículo a la venta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= RUTA?>mis_articulos">Mis artículos</a>
                        </li>

                        <!-- QUIERO QUE LAS INSTALACIONES SOLO LAS VEAN LOS ADMIN -->
                        <?php if (Session::existe()): ?>
                        <div id="userInfo">
                            <div id="foto_usuario"
                                style="background-image: url(<?= RUTA?>web/images/users/<?= Session::obtener()->getPhoto() ?>)">
                            </div>
                            <form id="formulario_actualizar_photo" action="subir_photo" method="post"
                                enctype="multipart/form-data">
                                <input type="file" name="photo" id="input_photo">
                                <input type="submit">
                            </form>
                            <div id="userInfo"><?= Session::obtener()->getNombre() ?> <br><a href="logout">cerrar
                                    sesión</a></div>
                        </div>
                        <?php else: ?>
                        <form id="login" action="login" method="post">
                            <input type="text" placeholder="email" name="email">
                            <input type="password" placeholder="password" name="password"><br>
                            <input type="submit" value="login" class="boton_formulario">
                            <input type="button" onclick="location.href = '<?= RUTA?>registrar'" value="registrar"
                                class="boton_formulario">
                        </form>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="titulo">
            <h3><?php echo $titulo2 ?></h3>
        </div>


        <div class="MensajesFlash"><?php mensajesFlash::imprimir_mensajes() ?></div>
        <main>
            <?= $contenido ?>
        </main>
    </header>
</body>

<script type="text/javascript">
$('#photo_usuario').click(function() {
    $('#input_photo').click();
});

$('#input_photo').change(function() {
    $('#formulario_actualizar_photo').submit();
})
</script>

</html>