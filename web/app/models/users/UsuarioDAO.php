<?php

/**
 * Description of UsuarioDAO
 *
 *  @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class UsuarioDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insert($usuario) {
        //Comprobamos que el parámetro sea de la clase Usuario
        if (!$usuario instanceof Usuario) {
            return false;
        }
        $nombre = $usuario->getNombre();
        $surname = $usuario->getSurname();
        $dni = $usuario->getDni();
        $email = $usuario->getEmail();
        $gender = $usuario->getGender();
        $birth_date = $usuario->getBirth_date();
        $phone =  $usuario->getPhone();
        $postalCode = $usuario->getPostalCode();
        $address = $usuario->getAddress();
        $password = $usuario->getPassword();
        if($usuario->getRol() == null){
            $rol = "user";
        }else{
            $rol = $usuario->getRol();
        }
        $department = $usuario->getDepartment();
        $photo = $usuario->getPhoto();
        $restart_password = $usuario->getRestart_password();
        $restart_code = $usuario->getRestart_code();
        $cookie_id = sha1(time() + rand());
        $sql = "INSERT INTO usuarios (nombre, surname, dni, email, gender, birth_date, phone, postalCode, address, password, rol, department, photo, cookie_id) VALUES "
                . "('$nombre','$surname','$dni','$email','$gender','$birth_date','$phone','$postalCode','$address','$password', '$rol', '$department', '$photo', '$cookie_id')";
        if (!$result = $this->conn->query($sql)) {
            header("Location: index.php");
            MensajesFlash::anadir_mensaje("Error en la SQL UsuarioDAO->insertUser: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error, MessageType::ERROR);
            die("Error en la SQL UsuarioDAO->insertUser: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $usuario->setId($this->conn->insert_id);
        return true;
    }

    public function update($usuario) {
        //Comprobamos que el parámetro es de la clase Usuario
        if (!$usuario instanceof Usuario) {
            return false;
        }
        $nombre = $usuario->getNombre();
        $surname = $usuario->getSurname();
        $dni = $usuario->getDni();
        $email = $usuario->getEmail();
        $gender = $usuario->getGender();
        $birth_date = $usuario->getBirth_date();
        $phone =  $usuario->getPhone();
        $postalCode = $usuario->getPostalCode();
        $address = $usuario->getAddress();
        $rol = $usuario->getRol();
        $department = $usuario->getDepartment();
        $restart_password = $usuario->getRestart_password();
        $restart_code = $usuario->getRestart_code();

        $sql = "UPDATE usuarios SET"
                . " nombre='$nombre', surname='$surname', dni='$dni', gender='$gender', birth_date='$birth_date', email='$email', phone='$phone', postalCode='$postalCode', address='$address', rol='$rol', department='$department', restart_password='$restart_password', restart_code='$restart_code' "
                . "WHERE id = " . $usuario->getId();
        if (!$result = $this->conn->query($sql)) {
            header("Location: index.php");
            MensajesFlash::anadir_mensaje("Error en la SQL UsuarioDAO->updateUser: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error, MessageType::ERROR);
            die("Error en la SQL UsuarioDAO->updateUser: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateMyUser($usuario) {
        //Comprobamos que el parámetro es de la clase Usuario
        if (!$usuario instanceof Usuario) {
            return false;
        }
        $email = $usuario->getEmail();
        $phone =  $usuario->getPhone();
        $address = $usuario->getAddress();

        $sql = "UPDATE usuarios SET"
            . " email='$email', phone='$phone', address='$address' "
            . "WHERE id = " . $usuario->getId();
        if (!$result = $this->conn->query($sql)) {
            header("Location: index.php");
            MensajesFlash::anadir_mensaje("Error en la SQL UsuarioDAO->updateUser: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error, MessageType::ERROR);
            die("Error en la SQL UsuarioDAO->updateMyUser: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete a user from the database
     * @param type $usuario Objeto de la clase usuario
     * @return bool Devuelve true si se ha borrado un usuario y false en caso contrario
     * nowadays, no one can delete user because it´s no logical delete user in this case, should we activate the option to cancel without delete.
     */
    public function delete($usuario) {
        //Comprobamos que el parámetro no es nulo y es de la clase Usuario
        if ($usuario == null || get_class($usuario) != 'Usuario') {
            return false;
        }
        $sql = "DELETE FROM usuarios WHERE id = " . $usuario->getId();
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->deleteUser: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Devuelve el usuario de la BD 
     * @param type $id id del usuario
     * @return \Usuario Usuario de la BD o null si no existe
     */
    public function findUserById($id) { //: Usuario especifica el tipo de datos que va a devolver pero no es obligatorio ponerlo
        $sql = "SELECT * FROM usuarios WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->findUserById : " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        return $result->fetch_object('Usuario');
    }


    public function findUserByIdV2($id) {
        $sql = "SELECT * FROM usuarios WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->findUserByIdV2: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        $row = $result->fetch_assoc();
        $result->free_result();
        return $row;
    }

    public function findUserByIdJson($id) {
        $sql = "SELECT * FROM usuarios WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->findUserByJson: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        if ($fila = $result->fetch_assoc()) {
            $usuario = new Usuario();
            $usuario->setNombre($fila['nombre']);
            $usuario->setSurname($fila['surname']);
            $usuario->setDni($fila['dni']);
            $usuario->setGender($fila['gender']);
            $usuario->setBirth_date($fila['birth_date']);
            $usuario->setEmail($fila['email']);
            $usuario->setPassword($fila['password']);
            $usuario->setId($fila['id']);
            $usuario->setPhoto($fila['photo']);
            $usuario->setPhone($fila['phone']);
            $usuario->setPostalCode($fila['postalCode']);
            $usuario->setAddress($fila['address']);
            $usuario->setRol($fila['rol']);
            $usuario->setDepartment($fila['department']);
            $usuario->setRestart_password($fila['restart_password']);
            $usuario->setRestart_code($fila['restart_code']);
            $usuario->setDisableUser($fila['disable_user']);
            console.log($usuario);
            return $usuario;
        } else {
            return null;
        }
    }

    /**
     * Devuelve todos los usuarios de la BD
     * @param type $orden Tipo de orden (ASC o DESC)
     * @param type $campo Campo de la BD por el que se van a ordenar
     * @return array Array de objetos de la clase Usuario
     */
    public function findAll($orden = 'ASC', $campo = 'id') {
        $sql = "SELECT * FROM usuarios ORDER BY $campo $orden";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->findAll: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        $array_obj_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_obj_usuarios[] = $usuario;
        }
        return $array_obj_usuarios;
    }

    public function findAdmins() {
        $sql = "SELECT * FROM usuarios WHERE rol='admin'";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->findAdmins: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        $array_obj_admins = array();
        while ($admin = $result->fetch_object('Usuario')) {
            $array_obj_admins[] = $admin;
        }
        return $array_obj_admins;
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->findByEmail: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        return $result->fetch_object('Usuario');
    }

    public function findByDNI($dni){
        $sql = "SELECT * FROM usuarios WHERE dni='$dni'";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->findByDNI: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        return $result->fetch_object('Usuario');
    }

    public function findByCookie_id($cookie_id) {
        $sql = "SELECT * FROM usuarios WHERE cookie_id='$cookie_id'";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL UsuarioDAO->findByCookie_id: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
        }
        return $result->fetch_object('Usuario');
    }
    
    public function list_postalCodes(){
        $sql = "SELECT * from postalcodes";
        if (!$result = $this->conn->query($sql)) {
                die("Error en la SQL UsuarioDAO->list_postalCodes: " ."<br>"/n . $sql ."<br>"/n . $this->conn->error);
            }
            $array_obj_postalCodes = array();
            while ($postalCode = $result->fetch_object()) {
                $array_obj_postalCodes[] = $postalCode;
            }
            return $array_obj_postalCodes;
    }

}