<?php

class ControladorArticulo {

    public function listar() {
        $conn = ConexionBD::conectar();
        $articuloDAO = new ArticuloDAO($conn);
        $articulos = $articuloDAO->findAll('DESC', 'fecha');

        //Generamos Token para seguridad del borrado
        $_SESSION['token'] = md5(time() + rand(0, 999));
        $token = $_SESSION['token'];

        require '../app/vistas/inicio.php';
    }

    function borrar() {
        //Comprobamos que el token recibido es igual al que tenemos en la variable de sesión para evitar ataques CSRF
        if ($_GET['t'] != $_SESSION['token']) {
            header("Location: " . RUTA);
            MensajesFlash::add_message("El token no es correcto");
            die();
        }

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
        $articulo = $articuloDAO->find($id);
        //Comprobamos el el usuario es propietario del artículo
        if ($articulo->getId_usuario() == Session::obtener()->getId()) {
            if ($articuloDAO->delete($articulo)) {
                MensajesFlash::add_message("Articulo borrado");
            } else {
                MensajesFlash::add_message("Articulo no encontrado");
            }
        } else {
            MensajesFlash::add_message("¡El artículo no es tuyo!");
        }
        header("Location: " . RUTA);
    }

    function insertar() {
        if (Session::existe() == false) {
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes añadir mensajes si no inicias sesión");
            die();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            /*             * ***************************************** */
            /*             * *** GUARDAMOS EL ARTÍCULO EN LA BBDD **** */
            /*             * ***************************************** */
            $conn = ConexionBD::conectar();
            //Insertamos el artículo en la BBDD
            $articuloDAO = new ArticuloDAO($conn);
            $articulo = new Articulo();

            //Filtramos datos de entrada
            $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_SPECIAL_CHARS);
            $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT);
            $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_SPECIAL_CHARS);

            $articulo->setDescripcion($descripcion);
            $articulo->setPrecio($precio);
            $articulo->setTitulo($titulo);
            $articulo->setId_usuario(Session::obtener()->getId());

            $articuloDAO->insert($articulo);

            for ($i = 0; $i < count($_FILES['foto']['name']); $i++) {
                $error = false;

                /*                 * ****************************************** */
                /*                 * ************ VALIDAMOS LA FOTO *********** */
                /*                 * ****************************************** */

                if ($_FILES['foto']['type'][$i] != 'image/png' &&
                        $_FILES['foto']['type'][$i] != 'image/gif' &&
                        $_FILES['foto']['type'][$i] != 'image/jpeg') {
                    MensajesFlash::add_message("El archivo seleccionado no es una foto.");
                    $error = true;
                }
                if ($_FILES['foto']['size'][$i] > 1000000) {
                    MensajesFlash::add_message("El archivo seleccionado es demasiado grande. Debe tener un tamaño inferior a 1MB");
                    $error = true;
                }

                if (!$error) {


                    /*                     * ****************************************** */
                    /*                     * ********** COPIAR LA FOTO A DISCO ******** */
                    /*                     * ****************************************** */
                    $nombre_foto = md5(time() + rand(0, 999999));
                    $extension_foto = substr($_FILES['foto']['name'][$i], strrpos($_FILES['foto']['name'][$i], '.') + 1);
                    //Limpiamos la extensión de la foto
                    $extension_foto = filter_var($extension_foto, FILTER_SANITIZE_SPECIAL_CHARS);
                    //Comprobamos que no exista ya una foto con el mismo nombre, si existe calculamos uno nuevo
                    while (file_exists("imagenes_articulos/$nombre_foto.$extension_foto")) {
                        $nombre_foto = md5(time() + rand(0, 999999));
                    }
                    //movemos la foto a la carpeta que queramos guardarla y con el nuevo nombre
                    if (!move_uploaded_file($_FILES['foto']['tmp_name'][$i], "imagenes_articulos/$nombre_foto.$extension_foto")) {
                        MensajesFlash::add_message("No se ha podido copiar la foto");
                        header("Location: inicio");
                        die();
                    }

                    /*                     * ****************************************** */
                    /*                     * ******* GUARDAMOS LA FOTO EN LA BBDD ***** */
                    /*                     * ****************************************** */
                    $id_articulo = $articulo->getId();
                    $nombre_archivo = "$nombre_foto.$extension_foto";
                    $fotoDAO = new FotoDAO($conn);
                    $foto = new Foto();
                    $foto->setId_articulo($id_articulo);
                    $foto->setNombre_archivo($nombre_archivo);
                    if (!$fotoDAO->insert($foto)) {
                        die("Error al insertar la foto en la BD");
                    }
                }//if(!$error)
            } //for

            MensajesFlash::add_message("Se ha insertado el artículo");
            header("Location: " . RUTA);
            die();
        }

        require '../app/views/articles/insert_article.php';
    }

    public function ver() {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $conn = ConexionBD::conectar();
        //Insertamos el artículo en la BBDD
        $articuloDAO = new ArticuloDAO($conn);
        $articulo = $articuloDAO->find($id);

        require '../app/vistas/ver_articulo.php';
    }

    public function mis_articulos() {
        $conn = ConexionBD::conectar();
        $articuloDAO = new ArticuloDAO($conn);
        $mis_articulos = $articuloDAO->findByUser(Session::obtener()->getId());

        //Generamos Token para seguridad del borrado
        $_SESSION['token'] = md5(time() + rand(0, 999));
        $token = $_SESSION['token'];

        require '../app/views/articles/own_articles.php';
    }

}
