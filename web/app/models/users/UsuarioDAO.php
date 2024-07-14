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
        
        $sql = "INSERT INTO usuarios (nombre, surname, dni, email, gender, birth_date, phone, postalCode, address, password, rol, department, photo, cookie_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssssssss", $nombre, $surname, $dni, $email, $gender, $birth_date, $phone, $postalCode, $address, $password, $rol, $department, $photo, $cookie_id);
        
        if (!$stmt->execute()) {
            header("Location: index.php");
            MensajesFlash::anadir_mensaje("Error en la SQL UsuarioDAO->insertUser: " . $stmt->error, MessageType::ERROR);
            echo 'console.log("Error en la SQL UsuarioDAO->insertUser: " . $stmt->error)';
            return false;
        }
        
        $usuario->setId($this->conn->insert_id);
        return true;
    }

    public function update($usuario) {
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

        $sql = "UPDATE usuarios SET nombre=?, surname=?, dni=?, gender=?, birth_date=?, email=?, phone=?, postalCode=?, address=?, rol=?, department=?, restart_password=?, restart_code=? WHERE id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssssssi", $nombre, $surname, $dni, $gender, $birth_date, $email, $phone, $postalCode, $address, $rol, $department, $restart_password, $restart_code, $usuario->getId());
        
        if (!$stmt->execute()) {
            header("Location: index.php");
            MensajesFlash::anadir_mensaje("Error en la SQL UsuarioDAO->updateUser: " . $stmt->error, MessageType::ERROR);
            echo 'console.log("Error en la SQL UsuarioDAO->updateUser: " . $stmt->error)';
            return false;
        }
        
        return $stmt->affected_rows == 1;
    }

    public function updateMyUser($usuario) {
        if (!$usuario instanceof Usuario) {
            return false;
        }
        $email = $usuario->getEmail();
        $phone =  $usuario->getPhone();
        $address = $usuario->getAddress();

        $sql = "UPDATE usuarios SET email=?, phone=?, address=? WHERE id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $email, $phone, $address, $usuario->getId());
        
        if (!$stmt->execute()) {
            header("Location: index.php");
            MensajesFlash::anadir_mensaje("Error en la SQL UsuarioDAO->updateUser: " . $stmt->error, MessageType::ERROR);
            echo 'console.log("Error en la SQL UsuarioDAO->updateUser: " . $stmt->error)';
            return false;
        }
        
        return $stmt->affected_rows == 1;
    }

    public function delete($usuario) {
        if ($usuario == null || get_class($usuario) != 'Usuario') {
            return false;
        }
        $sql = "DELETE FROM usuarios WHERE id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuario->getId());
        
        if (!$stmt->execute()) {
            die("Error en la SQL UsuarioDAO->deleteUser: " . $stmt->error);
        }
        
        return $stmt->affected_rows == 1;
    }

    public function findUserById($id) {
        $sql = "SELECT * FROM usuarios WHERE id=?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_object('Usuario');
    }

    public function findUserByIdV2($id) {
        $sql = "SELECT * FROM usuarios WHERE id=?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $result->free_result();
        return $row;
    }

    public function findUserByIdJson($id) {
        $sql = "SELECT * FROM usuarios WHERE id=?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
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
            return $usuario;
        } else {
            return null;
        }
    }

    public function findAll($orden = 'ASC', $campo = 'id') {
        $sql = "SELECT * FROM usuarios ORDER BY $campo $orden";
        
        $result = $this->conn->query($sql);
        $array_obj_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_obj_usuarios[] = $usuario;
        }
        return $array_obj_usuarios;
    }

    public function findAdmins() {
        $sql = "SELECT * FROM usuarios WHERE rol='admin'";
        
        $result = $this->conn->query($sql);
        $array_obj_admins = array();
        while ($admin = $result->fetch_object('Usuario')) {
            $array_obj_admins[] = $admin;
        }
        return $array_obj_admins;
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email=?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_object('Usuario');
    }

    public function findByDNI($dni){
        $sql = "SELECT * FROM usuarios WHERE dni=?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_object('Usuario');
    }

    public function findByCookie_id($cookie_id) {
        $sql = "SELECT * FROM usuarios WHERE cookie_id=?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $cookie_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_object('Usuario');
    }
    
    public function list_postalCodes(){
        $sql = "SELECT * from postalcodes";
        
        $result = $this->conn->query($sql);
        $array_obj_postalCodes = array();
        while ($postalCode = $result->fetch_object()) {
            $array_obj_postalCodes[] = $postalCode;
        }
        return $array_obj_postalCodes;
    }

}
?>
