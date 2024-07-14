<?php

require_once 'app/controllers/UsuarioController.php';

$router = new Router();

$router->addRoute('forgot_password', 'UsuarioController@showForgotPasswordForm');
$router->addRoute('send_recovery_code', 'UsuarioController@sendRecoveryCode');

// Otros enrutamientos...

$router->route();

?>
