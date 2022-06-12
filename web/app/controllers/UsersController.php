<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorUsuario
 *
 * @author DAW2
 */

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}


class UsersController {

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Comprobamos el token
            if ($_POST['token'] != $_SESSION['token']) {
                header('Location: #');
                MensajesFlash::add_message("Token incorrecto", MessageType::ERROR);
                die();
            }

            $usuario = new Usuario();
            $error = false;
            if (empty($_POST['name'])) {
                MensajesFlash::add_message("El nombre es obligatorio.", MessageType::ERROR);
                $error = true;
            }

            if (empty($_POST['email'])) {
                MensajesFlash::add_message("El email es obligatorio.", MessageType::ERROR);
                $error = true;
            }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                MensajesFlash::add_message("El email no es correcto.", MessageType::ERROR);
                $error = true;
            }

 
          //Check the email is not registrer yet  
           $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
          $usuarioEmail = $usuarioDAO->findByEmail($_POST['email']);

          if ($usuarioEmail != null) {
              MensajesFlash::add_message("El email ya está registrado.", MessageType::ERROR);
              $error = true;
          }

          //check the dni is not registrer yet 
            $usuarioDNI = $usuarioDAO->findByDNI($_POST['dni']);
            if($usuarioDNI != null) {
                MensajesFlash::add_message("El dni ya está registrado.", MessageType::ERROR);
                $error = true;
            }
            

            if (empty($_POST['password'])) {
                MensajesFlash::add_message("El password es obligatorio.", MessageType::ERROR);
                $error = true;
            }

            if (empty($_POST['password2'])) {
                MensajesFlash::add_message(".Falta la comprobación de la contraseña", MessageType::ERROR);
                $error = true;
            }

            if ($_POST['password'] != $_POST['password2']) {
                MensajesFlash::add_message("Las contraseñas no coinciden", MessageType::ERROR);
                $error = true;
            }

            if (!$error) {
            //if photo is null or empty, set default photo
            if (empty($_FILES['photo']['name'])) {
                $usuario->setPhoto("default.jpg");
                MensajesFlash::add_message("No has añadido foto pero el usuario se intentará crear", MessageType::INFO);
            } else {
            //Validación photo
            if ($_FILES['photo']['type'] != 'image/png' &&
                    $_FILES['photo']['type'] != 'image/gif' &&
                    $_FILES['photo']['type'] != 'image/jpeg') {
                MensajesFlash::add_message("El archivo seleccionado no es una foto.", MessageType::INFO);
                $error = true;
            }
            if ($_FILES['photo']['size'] > 1000000) {
                MensajesFlash::add_message("El archivo seleccionado es demasiado grande. Debe tener un tamaño inferior a 1MB", MessageType::ERROR);
                $error = true;
            }
        }
        }

          

     /*       if(!($_POST['datesConsent'])){
                MensajesFlash::add_message("Es obligatorio marcar la casilla de las condiciones de uso para poder registrarse.");
                $tipoMensaje = "alert alert-error";
                $error = true;
            }
*/
debug_to_console("antes de if !error");
            if (!$error) {
                //Copiar photo
                //Generamos un nombre para la photo
                $nombre_photo = md5(time() + rand(0, 999999));
                $extension_photo = substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'], '.') + 1);
                $extension_photo = filter_var($extension_photo, FILTER_SANITIZE_SPECIAL_CHARS);
                //Comprobamos que no exista ya una photo con el mismo nombre, si existe calculamos uno nuevo
                while (file_exists("images/users/$nombre_photo.$extension_photo")) {
                    $nombre_photo = md5(time() + rand(0, 999999));
                }
                //movemos la photo a la carpeta que queramos guardarla y con el nombre original
                move_uploaded_file($_FILES['photo']['tmp_name'], "images/users/$nombre_photo.$extension_photo");

                //Limpiamos los datos de entrada 
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
                $surname = filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS);
                $dni = filter_var($_POST['dni'], FILTER_SANITIZE_SPECIAL_CHARS);
                $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
                $birth_date = filter_var($_POST['birth_date']);
                $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
                $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_SPECIAL_CHARS);
                $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
                //Insertamos el usuario en la BBDD
                $usuario->setEmail($email);
                $usuario->setNombre($name);
                $usuario->setSurname($surname);
                $usuario->setDni($dni);
                $usuario->setGender($gender);
                $usuario->setBirth_date($birth_date);
                $usuario->setPhone($phone);
                $usuario->setPostalCode($postalCode);
                $usuario->setAddress($address);
                $usuario->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
                $usuario->setPhoto("$nombre_photo.$extension_photo");
                $usuario->setRol("user");
                $usuDAO = new UsuarioDAO(ConexionBD::conectar());
                
                debug_to_console("antes de insert(usuario)");
                if($usuDAO->insert($usuario)){
                    MensajesFlash::add_message("Usuario creado:", MessageType::SUCCESS);
                    header('Location: inicio');
                    die();
                }else{
                    MensajesFlash::add_message("Error al crear el usuario:", MessageType::ERROR);
                    echo 'console.log("Error en la SQL UsersController->registrar: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error)';
                    header('Location: registro');
                    die();
            }
            }
        }

                //Call Conexion and ItemDao
                $conn = ConexionBD::conectar();
                $usuarioDAO = new UsuarioDAO($conn);
        //call to posatlCodes
        $list_postalCodes = $usuarioDAO->list_postalCodes();


        //Calculamos un token
        $token = md5(time() + rand(0, 999));
        $_SESSION['token'] = $token;

        require './app/views/users/userRegistrer.php';
    }

    public function add_user() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Comprobamos el token
            if ($_POST['token'] != $_SESSION['token']) {
                header('Location: #');
                MensajesFlash::add_message("Token incorrecto", MessageType::ERROR);
                die();
            }

            $usuario = new Usuario();
            $error = false;
            if (empty($_POST['name'])) {
                MensajesFlash::add_message("El nombre es obligatorio.", MessageType::ERROR);
                $error = true;
            }

            if (empty($_POST['email'])) {
                MensajesFlash::add_message("El email es obligatorio.", MessageType::ERROR);
                $error = true;
            }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                MensajesFlash::add_message("El email no es correcto.", MessageType::ERROR);
                $error = true;
            }

 
          //Check the email is not registrer yet  
           $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
          $usuarioEmail = $usuarioDAO->findByEmail($_POST['email']);

            if ($usuarioEmail != null) {
                MensajesFlash::add_message("El email ya está registrado.", MessageType::ERROR);
                $error = true;
            }

            //check the dni is not registrer yet 
            $usuarioDNI = $usuarioDAO->findByDNI($_POST['dni']);
            if($usuarioDNI != null) {
                MensajesFlash::add_message("El dni ya está registrado.", MessageType::ERROR);
                $error = true;
            }

            if (empty($_POST['password'])) {
                MensajesFlash::add_message("El password es obligatorio.", MessageType::ERROR);
                $error = true;
            }

            if (empty($_POST['password2'])) {
                MensajesFlash::add_message("No has escrito la comprobación de la contraseña", MessageType::ERROR);
                $error = true;
            }

            if ($_POST['password'] != $_POST['password2']) {
                MensajesFlash::add_message("Las contraseñas no coinciden", MessageType::ERROR);
                $error = true;
            }

            if (!$error) {
            //if photo is null or empty, set default photo
            if (empty($_FILES['photo']['name'])) {
                $usuario->setPhoto("default.jpg");
                MensajesFlash::add_message("No has añadido foto pero el usuario se ha creado igualmente", MessageType::INFO);
            } else {
            //Validación photo
            if ($_FILES['photo']['type'] != 'image/png' &&
                    $_FILES['photo']['type'] != 'image/gif' &&
                    $_FILES['photo']['type'] != 'image/jpeg') {
                MensajesFlash::add_message("El archivo seleccionado no es una foto.", MessageType::INFO);
                $error = true;
            }
            if ($_FILES['photo']['size'] > 1000000) {
                MensajesFlash::add_message("El archivo seleccionado es demasiado grande. Debe tener un tamaño inferior a 1MB", MessageType::ERROR);
                $error = true;
            }
        }
        }

     /*       if(!($_POST['datesConsent'])){
                MensajesFlash::add_message("Es obligatorio marcar la casilla de las condiciones de uso para poder registrarse.");
                $tipoMensaje = "alert alert-error";
                $error = true;
            }
*/
            if (!$error) {
                //Copiar photo
                //Generamos un nombre para la photo
                $nombre_photo = md5(time() + rand(0, 999999));
                $extension_photo = substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'], '.') + 1);
                $extension_photo = filter_var($extension_photo, FILTER_SANITIZE_SPECIAL_CHARS);
                //Comprobamos que no exista ya una photo con el mismo nombre, si existe calculamos uno nuevo
                while (file_exists("images/users/$nombre_photo.$extension_photo")) {
                    $nombre_photo = md5(time() + rand(0, 999999));
                }
                //movemos la photo a la carpeta que queramos guardarla y con el nombre original
                move_uploaded_file($_FILES['photo']['tmp_name'], "images/users/$nombre_photo.$extension_photo");

                //Limpiamos los datos de entrada 
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
                $surname = filter_var($_POST['surname'], FILTER_SANITIZE_SPECIAL_CHARS);
                $dni = filter_var($_POST['dni'], FILTER_SANITIZE_SPECIAL_CHARS);
                $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
                $birth_date = filter_var($_POST['birth_date']);
                $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
                $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_SPECIAL_CHARS);
                $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
                $rol = filter_var($_POST['rol'], FILTER_SANITIZE_SPECIAL_CHARS);
                $department = filter_var($_POST['department'], FILTER_SANITIZE_SPECIAL_CHARS);
                //Insertamos el usuario en la BBDD
                $usuario->setEmail($email);
                $usuario->setNombre($name);
                $usuario->setSurname($surname);
                $usuario->setDni($dni);
                $usuario->setGender($gender);
                $usuario->setBirth_date($birth_date);
                $usuario->setPhone($phone);
                $usuario->setPostalCode($postalCode);
                $usuario->setAddress($address);
                if($rol == null){
                    $rol = "user";
                }else{
                    $usuario->setRol($rol);
                }
                $usuario->setDepartment($department);
                $usuario->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
                $usuario->setPhoto("$nombre_photo.$extension_photo");

                $usuDAO = new UsuarioDAO(ConexionBD::conectar());
                   if($usuDAO->insert($usuario)){
                MensajesFlash::add_message("Usuario creado:", MessageType::SUCCESS);
                header('Location: inicio');
                die();
            }else{
                MensajesFlash::add_message("Error al crear el usuario:", MessageType::ERROR);
                header('Location: registro');
                die();
            }
            }
        }

                //Call Conexion and ItemDao
                $conn = ConexionBD::conectar();
                $usuarioDAO = new UsuarioDAO($conn);
                //call to posatlCodes
                $list_postalCodes = $usuarioDAO->list_postalCodes();

                 //Save in a variable the array with all departments
                 $itemDAO = new ItemDAO($conn);
                 $departments = $itemDAO->listar_departamentos();

        //Calculamos un token
        $token = md5(time() + rand(0, 999));
        $_SESSION['token'] = $token;

        require './app/views/users/add_user.php';
    }

    public function subir_photo() {
        echo("hola333");

        if (($_FILES['photo']['type'] != 'image/png' &&
                $_FILES['photo']['type'] != 'image/gif' &&
                $_FILES['photo']['type'] != 'image/jpeg')) {
            MensajesFlash::add_message('La imagen no tiene el formato adecuado', MessageType::ERROR);
            header('Location: inicio');
            die();
        }
        //Generamos un nombre para la photo
        $nombre_photo = md5(time() + rand(0, 999999));
        $extension_photo = substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'], '.') + 1);
        //Comprobamos que no exista ya una photo con el mismo nombre, si existe calculamos uno nuevo
        while (file_exists("imagenes/$nombre_photo.$extension_photo")) {
            $nombre_photo = md5(time() + rand(0, 999999));
        }
        //movemos la photo a la carpeta que queramos guardarla y con el nombre original
        move_uploaded_file($_FILES['photo']['tmp_name'], "images/users/$nombre_photo.$extension_photo");
        //Actualizamos en la BD
        $conn = ConexionBD::conectar();
        $usuarioDAO = new UsuarioDAO($conn);
        $usuario = $usuarioDAO->findUserById(Session::obtener()->getId());
        $usuario->setphoto("$nombre_photo.$extension_photo");
        $usuarioDAO->update($usuario);

        //Para que recarge en la sesión la nueva photo
        Session::iniciar($usuario);

        header("Location: " . RUTA);
    }

    public function subir_photo2() {
        alert("holaaa2");
        if (($_FILES['photo2']['type'] != 'image/png' &&
                $_FILES['photo2']['type'] != 'image/gif' &&
                $_FILES['photo2']['type'] != 'image/jpeg')) {
            MensajesFlash::add_message('La imagen no tiene el formato adecuado', MessageType::ERROR);
            header('Location: inicio');
            die();
        }
        //Generamos un nombre para la photo
        $nombre_photo = md5(time() + rand(0, 999999));
        $extension_photo = substr($_FILES['photo2']['name'], strrpos($_FILES['photo2']['name'], '.') + 1);
        //Comprobamos que no exista ya una photo con el mismo nombre, si existe calculamos uno nuevo
        while (file_exists("imagenes/$nombre_photo.$extension_photo")) {
            $nombre_photo = md5(time() + rand(0, 999999));
        }
        //movemos la photo a la carpeta que queramos guardarla y con el nombre original
        move_uploaded_file($_FILES['photo2']['tmp_name'], "images/users/$nombre_photo.$extension_photo");
        //Actualizamos en la BD
        $conn = ConexionBD::conectar();
        $usuarioDAO = new UsuarioDAO($conn);
        $usuario = $usuarioDAO->findUserById(Session::obtener()->getId());
        $usuario->setphoto("$nombre_photo.$extension_photo");
        $usuarioDAO->update($usuario);

        //Para que recarge en la sesión la nueva photo
        Session::iniciar($usuario);

        header("Location: " . RUTA);
    }

    public function login() {
        //Obtendo el usuario, si no existe vuelvo a index con un parámetro de error
        $usuDAO = new UsuarioDAO(ConexionBD::conectar());
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!$usuario = $usuDAO->findByEmail($email)) {
            //Usuario no encontrado
            MensajesFlash::add_message("Usuario o password incorrectos.", MessageType::ERROR);
            header("Location: " . RUTA);
            die();
        }
        //Compruebo la contraseña, si no existe vuelvo a index con un parámetro de error
        if (!password_verify($_POST['password'], $usuario->getPassword())) {
            //password incorrecto
            MensajesFlash::add_message("Usuario o password incorrectos.", MessageType::ERROR);
            header("Location: " . RUTA);
            die();
        }
        //Usuario y password correctos, redirijo al listado de anuncios
        MensajesFlash::add_message("LOGIN CORRECTO", MessageType::SUCCESS);
        Session::iniciar($usuario);

        //Generamos un código aleatorio sha1 y lo guardamos en la BD
        $usuario->setCookie_id(sha1(time() + rand()));
        $usuDAO->update($usuario);
        //Creamos la cookie en el navegador del cliente con el mismo código generado
        setcookie('uid', $usuario->getCookie_id(), time() + 60 * 60 * 24 * 7);
        //if user admin or superadmin send to own_itemsDaylyAdmins
        if ($usuario->getRol() == 'admin' || $usuario->getRol() == 'superAdmin') {
            header("Location: " . RUTA . "own_itemsDaylyAdmins");
        } else {
        header("Location: " . RUTA);
        }
    }

    public function usersList() {
        if (Session::existe() == true) {
            $conn = ConexionBD::conectar();
            $usuDAO = new UsuarioDAO($conn);
            $usuario = $usuDAO->findUserById(Session::obtener()->getId());
            /*if user is admin o superadmin can watch, if not, no */
            if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') {
                    $conn = ConexionBD::conectar();
                    $usuDAO = new UsuarioDAO(ConexionBD::conectar());
                    $usersList = $usuDAO->findAll();
                    $list_postalCodes = $usuDAO->list_postalCodes();
                    //Save in a variable the array with all departments
                    $itemDAO = new ItemDAO($conn);
                    $departments = $itemDAO->listar_departamentos();
                    require './app/views/users/usersList.php';
            }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver usuarios si no eres Administrador", MessageType::ERROR);
            die();
            }
        }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver usuarios si no inicias sesión", MessageType::ERROR);
            die();
        }
    }

    public function usersListAdmins() {
        if (Session::existe() == true) {
            $conn = ConexionBD::conectar();
            $usuDAO = new UsuarioDAO($conn);
            $usuario = $usuDAO->findUserById(Session::obtener()->getId());
            /*if user is admin o superadmin can watch, if not, no */
            if ($usuario->getRol() =='superAdmin') {
                    $conn = ConexionBD::conectar();
                    $usuDAO = new UsuarioDAO(ConexionBD::conectar());
                    $usersList = $usuDAO->findAll();
                    $adminsList = $usuDAO->findAdmins();
                    $list_postalCodes = $usuDAO->list_postalCodes();
                    //Save in a variable the array with all departments
                    $itemDAO = new ItemDAO($conn);
                    $departments = $itemDAO->listar_departamentos();
                    require './app/views/users/usersListAdmins.php';
            }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver usuarios si no eres SUPERAdministrador", MessageType::ERROR);
            die();
            }
        }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver usuarios si no inicias sesión", MessageType::ERROR);
            die();
        }
    }

    public function findByUserId($userId) {
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO(ConexionBD::conectar());
        $user = $usuDAO->find($userId);
        echo $user;
       /* console.log($user);*/
    }

    public function findUserByIdJson($userId) {
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO($conn);
        $user = $usuDAO->findUserByIdV2($userId);
        return $user;
    }


    public function logout() {
        Session::cerrar();
        //Borramos la cookie diciendole al navegador que está caducada
        setcookie('uid', '', time() - 5);
        header("Location: " . RUTA);
        die();
    }

    public function deleteUser(){
        if (Session::existe() == true) {
            $usuDAO = new UsuarioDAO(ConexionBD::conectar());
            $usuario = $usuDAO->findUserById(Session::obtener()->getId());
            /*if user is admin o superadmin can watch, if not, no */
            if ($usuario->getRol() =='superAdmin') {
                $user = new Usuario();
                $user->setId($_POST['id']);
                if($usuDAO->delete($user)){
                MensajesFlash::add_message("Usuario eliminado correctamente", MessageType::SUCCESS);
                }else{
                MensajesFlash::add_message("No se ha podido eliminar el usuario", MessageType::ERROR);
                }
            }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes eliminar usuarios si no eres SUPERAdministrador", MessageType::ERROR);
            die();
            }
        }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver usuarios si no inicias sesión", MessageType::ERROR);
            die();
        }
    }

    public function index() {
        require './app/views/index/index.php';
    }

    public function indexBootstrap(){
        require './app/views/index/indexBootstrap.php';
    }

    public function detailUser() {
        $userId = $_POST['employee_id'];
        $user = $this->findUserByIdJson($userId);
        echo json_encode($user);
    }

    public function editUser(){
        if (Session::existe() == true) {
            $conn = ConexionBD::conectar();
            $usuDAO = new UsuarioDAO($conn);
            $usuario = $usuDAO->findUserById(Session::obtener()->getId());
            /*if user is admin o superadmin can watch, if not, no */
            if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') {
                $usuDAO = new UsuarioDAO(ConexionBD::conectar());
                $user = Usuario::initValues($_POST['id'], $_POST['nombre'],$_POST['apellidos'], $_POST['dni'], $_POST['gender'], $_POST['birth_date'] , $_POST['email'], $_POST['phone'], $_POST['postalCode'], $_POST['address'], $_POST['rol'], $_POST['department'] );
                if($usuDAO->update($user)){
                $name= filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
                $lastName= filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING);
                MensajesFlash::add_message("Usuario ".$name ." ". $lastName." actualizado correctamente", MessageType::SUCCESS);
            } else {
                header("Location: " . RUTA);
                MensajesFlash::add_message("Fallo al editar el usuario", MessageType::ERROR);
                die();
            }
            }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes editar usuarios si no eres Administrador", MessageType::ERROR);
            die();
            }
        }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes editar usuarios si no inicias sesión", MessageType::ERROR);
            die();
        }
    }

    public function myUser(){
        if (Session::existe() == true) {
        $conn = ConexionBD::conectar();
        $usuDAO = new UsuarioDAO($conn);

        /*CAMPS THAT THE OWN USER CAN CHANGE SINCE MYUSER.PHP */
        $user = $_POST;
        if(isset($user["actualizar"]) && $user["actualizar"] === 'TRUE') {
            $updateUser = Usuario::InitValuesUpdateMyUser($user["id"],$user["address"],$user["email"],$user["phone"]);
            $usuDAO->updateMyUser($updateUser);
            MensajesFlash::add_message('Datos actualizados');

        }

        //call to posatlCodes
        $list_postalCodes = $usuDAO->list_postalCodes();
        $user = $usuDAO->findUserById(Session::obtener()->getId());
        require './app/views/users/myUser.php';
        return $user;
        }
    die();
    }
}