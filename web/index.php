<?php

/*
 * controller Frontal
 */

session_start();

//Requires
require './app/models/ConexionBD.php';
require './app/models/articles/Article.php';
require './app/models/articles/ArticleDAO.php';
require './app/models/departments/Department.php';
require './app/models/departments/DepartmentDAO.php';
require './app/models/items/Item.php';
require './app/models/items/ItemDAO.php';
require './app/models/photo/Photo.php';
require './app/models/photo/PhotoDAO.php';
require './app/models/photo/PhotoItem.php';
require './app/models/photo/PhotoItemDAO.php';
require './app/models/MensajesFlash.php';
require './app/models/Session.php';
require './app/models/users/Usuario.php';
require './app/models/users/UsuarioDAO.php';
require './app/controllers/ArticlesController.php';
require './app/controllers/DepartmentsController.php';
require './app/controllers/ItemsController.php';
require './app/controllers/UsersController.php';
require './config.php';


//Enrutamiento
$mapa = array(
    //articlesController
    'listar_articulos' => array('controller' => 'ArticlesController', 'method' => 'listar', 'publica' => true),
    'borrar_articulo' => array('controller' => 'ArticlesController', 'method' => 'borrar', 'publica' => false),
    'insertar_articulo' => array('controller' => 'ArticlesController', 'method' => 'insertar', 'publica' => false),
    'ver_articulo' => array('controller' => 'ArticlesController', 'method' => 'ver', 'publica' => true),
    'mis_articulos' => array('controller' => 'ArticlesController', 'method' => 'mis_articulos', 'publica' => false),

    //departmentsController
    'insert_department' => array('controller' => 'DepartmentsController', 'method' => 'insert', 'publica' => false),
    'departments_list' => array('controller' => 'DepartmentsController', 'method' => 'departments_list', 'publica' => true),
    'departments_listResponsive' => array('controller' => 'DepartmentsController', 'method' => 'departments_listResponsive', 'publica' => true),
    'edit_department' => array('controller' => 'DepartmentsController', 'method' => 'editDepartment', 'publica' => true),
    'detail_department' => array('controller' => 'DepartmentsController', 'method' => 'detailDepartment', 'publica' => true),
    'update_departament' => array('controller' => 'DepartmentsController', 'method' => 'updateDepartament', 'publica' => true),
    'updateDepartament' => array('controller' => 'DepartmentsController', 'method' => 'updateDepartament', 'publica' => true),
    'traer_campos_departament' => array('controller' => 'DepartmentsController', 'method' => 'traer_campos_departament', 'publica' => true),
     
    //ItemsController
     'items_list' => array('controller' => 'ItemsController', 'method' => 'toList', 'publica' => true),
     'own_items' => array('controller' => 'ItemsController', 'method' => 'ownItems', 'publica' => false),
     'own_itemsUsers' => array('controller' => 'ItemsController', 'method' => 'ownItemsUsers', 'publica' => false),
     'own_itemsDaylyAdmins' => array('controller' => 'ItemsController', 'method' => 'ownItemsDaylyAdmins', 'publica' => false),
     'own_itemsDaylyAdminsWithoutAttendat'  => array('controller' => 'ItemsController', 'method' => 'ownItemsDaylyAdminsWithoutAttendat', 'publica' => false),
     'itemsByUserToAdmin' => array('controller' => 'ItemsController', 'method' => 'itemsByUserToAdmin', 'publica' => false),
     'delete_item' => array('controller' => 'ItemsController', 'method' => 'delete', 'publica' => false),
     'insert_item' => array('controller' => 'ItemsController', 'method' => 'insert', 'publica' => false),
     'insert_itemUsers' => array('controller' => 'ItemsController', 'method' => 'insert', 'publica' => false),
     'ver_item' => array('controller' => 'ItemsController', 'method' => 'viewItem', 'publica' => true),
     'mis_items' => array('controller' => 'ItemsController', 'method' => 'findItemsByUser', 'publica' => false),
     'update_item' => array('controller' => 'ItemsController', 'method' => 'update_item', 'publica' => false),
     'edit_item' => array('controller' => 'ItemsController', 'method' => 'editItem', 'publica' => true),
     'findByIdItem' => array('controller' => 'ItemsController', 'method' => 'findByIdItem', 'publica' => true),
    'download_csv_file' => array('controller' => 'ItemsController', 'method' => 'download_csv_file', 'publica' => false),
    'pb' => array('controller' => 'ItemsController', 'method' => 'pb', 'publica' => false),

    //userController
    'inicio' => array('controller' => 'UsersController', 'method' => 'index', 'publica' => true),
    'indexBootstrap' => array('controller' => 'UsersController', 'method' => 'indexBootstrap', 'publica' => true),
    'registrar' => array('controller' => 'UsersController', 'method' => 'registrar', 'publica' => true),
    'add_user' => array('controller' => 'UsersController', 'method' => 'add_user', 'publica' => false),
    'subir_photo' => array('controller' => 'UsersController', 'method' => 'subir_photo', 'publica' => false),
    'login' => array('controller' => 'UsersController', 'method' => 'login', 'publica' => true),
    'logout' => array('controller' => 'UsersController', 'method' => 'logout', 'publica' => false),
    'usersList' => array('controller' => 'UsersController', 'method' => 'usersList', 'publica' => true),
    'usersListAdmins' => array('controller' => 'UsersController', 'method' => 'usersListAdmins', 'publica' => true),
    'findByUserId' => array('controller' => 'UsersController', 'method' => 'findByUserId', 'publica' => true),
    'findUserByIdJson' => array('controller' => 'UsersController', 'method' => 'findUserByIdJson', 'publica' => true),
    'update_user' => array('controller' => 'UsersController', 'method' => 'update', 'publica' => false),
    'delete_user' => array('controller' => 'UsersController', 'method' => 'deleteUser', 'publica' => false),
    'detail_user' => array('controller' => 'UsersController', 'method' => 'detailUser', 'publica' => true),
    'edit_user' => array('controller' => 'UsersController', 'method' => 'editUser', 'publica' => true),
    'my_user' => array('controller' => 'UsersController', 'method' => 'myUser', 'publica' => false),
    
);

//Parseo de la ruta
if (!empty($_GET['accion'])) {
    if (isset($mapa[$_GET['accion']])) {  //Si existe en el mapa
        $accion = $_GET['accion'];
    } else { //Si no existe en el mapa
        MensajesFlash::add_message("La página que buscas no existe.", MessageType::ERROR);
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
        MensajesFlash::add_message("Debes iniciar sesión para acceder a esta página", MessageType::ERROR);
        header('Location: inicio');
        die();
    }
}


//Ejecución del controller
$controller = $mapa[$accion]['controller'];
$method = $mapa[$accion]['method'];

$controller = new $controller();
$controller->$method();