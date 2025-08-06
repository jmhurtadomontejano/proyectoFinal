<?php
class Usuario extends Conectar {
    public function get_login($usu_correo, $usu_pass) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "select * from tm_usuario where usu_correo=? and usu_pass=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_correo);
        $sql->bindValue(2, $usu_pass);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_login_social($usu_correo) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "select * from tm_usuario where usu_correo=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_correo);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function register_usuario($usu_nom, $usu_correo, $usu_pass) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `tm_usuario` (usu_id, usu_nom, usu_correo, usu_pass, est) VALUES (NULL, ?, ?, ?, '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_correo);
        $sql->bindValue(3, $usu_pass);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_correo($usu_correo) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `tm_usuario` WHERE usu_correo = ? AND est='1'";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_correo);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function generateRecoveryCode($email) {
        $conectar = parent::conexion();
        parent::set_names();

        // Verifica si el usuario existe
        $sql = "SELECT * FROM tm_usuario WHERE usu_correo=?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $usuario = $stmt->fetch();

        if ($usuario) {
            $code = bin2hex(random_bytes(16)); // Genera un código de recuperación único
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Establece una hora de caducidad

            $sql = "UPDATE tm_usuario SET restart_code=?, restart_expiry=? WHERE usu_correo=?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $code);
            $stmt->bindValue(2, $expiry);
            $stmt->bindValue(3, $email);
            $stmt->execute();

            // Envía el código de recuperación al correo electrónico del usuario
            mail($email, "Recuperación de Contraseña", "Su código de recuperación es: $code");

            return true;
        } else {
            return false;
        }
    }

    public function verifyRecoveryCode($email, $code) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT * FROM tm_usuario WHERE usu_correo=? AND restart_code=? AND restart_expiry > NOW()";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, $code);
        $stmt->execute();
        $usuario = $stmt->fetch();
    
        return $usuario ? true : false;
    }

    public function changePassword($email, $newPassword) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
        $sql = "UPDATE tm_usuario SET usu_pass=?, restart_code=NULL, restart_expiry=NULL WHERE usu_correo=?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $hashedPassword);
        $stmt->bindValue(2, $email);
        $stmt->execute();
    
        return $stmt->rowCount() > 0;
    }
    
    
}
?>
