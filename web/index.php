<?php
declare(strict_types=1);

// Habilitar reporte de errores en desarrollo
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
/*
 * controller Frontal
 */

session_start();

//Requires
// Autoload de Composer
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die('Autoload file not found. Please run "composer install" to install dependencies.');
}
// Cargar las clases necesarias
// Asegúrate de que la ruta es correcta según tu estructura de directorios  
require __DIR__ . '/../vendor/autoload.php';

$requiredFiles = [
    './app/models/ConexionBD.php',
    './app/models/articles/Article.php',
    './app/models/articles/ArticleDAO.php',
    './app/models/departments/Department.php',
    './app/models/departments/DepartmentDAO.php',
    './app/models/items/Item.php',
    './app/models/items/ItemDAO.php',
    './app/models/photo/Photo.php',
    './app/models/photo/PhotoDAO.php',
    './app/models/photo/PhotoItem.php',
    './app/models/photo/PhotoItemDAO.php',
    './app/models/MensajesFlash.php',
    './app/models/Session.php',
    './app/models/users/Usuario.php',
    './app/models/users/UsuarioDAO.php',
    './app/models/MessageType.php',
    './app/controllers/ArticlesController.php',
    './app/controllers/DepartmentsController.php',
    './app/controllers/ItemsController.php',
    './app/controllers/UsersController.php',
    './config.php'
];

foreach ($requiredFiles as $file) {
    if (!file_exists($file)) {
        // Log the error for developers
        error_log("Required file not found: $file");
        // Show a generic message to users if not in development
        if (getenv('APP_ENV') === 'development') {
            echo "<div style='color:red;'>Required file not found: $file</div>";
        }
        // Continue to next file instead of stopping execution
        continue;
    }
    require $file;
}


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
        header("Location: /proyectoFinal/web/index.php?accion=inicio");
        exit();
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
        header('Location: /proyectoFinal/web/index.php?accion=inicio');
        exit();
    }
}


//Ejecución del controller
$controllerName = $mapa[$accion]['controller'];
$method = $mapa[$accion]['method'];

if (!class_exists($controllerName)) {
    die("Controller class '$controllerName' not found.");
}

$controller = new $controllerName();

if (!method_exists($controller, $method)) {
    die("Method '$method' not found in controller '$controllerName'.");
}

try {
    $controller->$method();
} catch (Throwable $e) {
    MensajesFlash::add_message("Ha ocurrido un error interno: " . $e->getMessage(), MessageType::ERROR);
    header('Location: /proyectoFinal/web/index.php?accion=inicio');
    exit();
}