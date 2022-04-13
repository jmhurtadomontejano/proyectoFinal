<?php

/*
 * Controlador Frontal
 */

session_start();

//Requires
require '../app/models/ConexionBD.php';
require '../app/models/articles/Articulo.php';
require '../app/models/articles/ArticuloDAO.php';
require '../app/models/Foto.php';
require '../app/models/FotoDAO.php';
require '../app/models/MensajesFlash.php';
require '../app/models/Session.php';
require '../app/models/Usuario.php';
require '../app/models/UsuarioDAO.php';
require '../app/controllers/ArticlesController.php';
require '../app/controllers/UsersController.php';
require '../app/config.php';


//Enrutamiento
$mapa = array(
    'inicio' => array('controlador' => 'ArticlesController', 'metodo' => 'listar', 'publica' => true),
    'borrar_articulo' => array('controlador' => 'ArticlesController', 'metodo' => 'borrar', 'publica' => false),
    'insertar_articulo' => array('controlador' => 'ArticlesController', 'metodo' => 'insertar', 'publica' => false),
    'ver_articulo' => array('controlador' => 'ArticlesController', 'metodo' => 'ver', 'publica' => true),
    'registrar' => array('controlador' => 'UsersController', 'metodo' => 'registrar', 'publica' => true),
    'subir_foto' => array('controlador' => 'UsersController', 'metodo' => 'subir_foto', 'publica' => false),
    'login' => array('controlador' => 'UsersController', 'metodo' => 'login', 'publica' => true),
    'logout' => array('controlador' => 'UsersController', 'metodo' => 'logout', 'publica' => false),
    'mis_articulos' => array('controlador' => 'ArticlesController', 'metodo' => 'mis_articulos', 'publica' => false),
);

//Parseo de la ruta
if (!empty($_GET['accion'])) {
    if (isset($mapa[$_GET['accion']])) {  //Si existe en el mapa
        $accion = $_GET['accion'];
    } else { //Si no existe en el mapa
        MensajesFlash::add_message("La página que buscas no existe.");
        header("Location: inicio");
        die();
    }
} else {    //Si no me pasan parámetro acción, cargo la acción por defecto
    $accion = "inicio";
}

//Si tiene cookie y no ha iniciado sesión, iniciamos sesión automáticamente
if (isset($_COOKIE['uid']) && Session::existe() == false) { //Si existe la cookie lo identificamos
    $uid = filter_var($_COOKIE['uid'], FILTER_SANITIZE_SPECIAL_CHARS);
    $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
    $usuario = $usuarioDAO->findByCookie_id($uid);
    if ($usuario != false) {   //Si existe un usuario con la cookie iniciamos sesión
        Session::iniciar($usuario);
    }
}

//Si va a acceder a una página que no es pública y no está identificado lo echamos a index
if ($mapa[$accion]['publica'] == false) { //Debe tener la sesión iniciada
    if (!Session::existe()) {
        MensajesFlash::add_message("Debes iniciar sesión para acceder a esta página");
        header('Location: inicio');
        die();
    }
}


//Ejecución del controlador
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

$controlador = new $controlador();
$controlador->$metodo();
