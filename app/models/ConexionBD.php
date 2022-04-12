<?php
/**
 * Description of ConexionBD
 *
 * @author DAW2
 */
class ConexionBD {
    public static function conectar(): mysqli{
        $conn = new mysqli('localhost','root','','segunda_mano');
	#	$conn = new mysqli('localhost','id18038807_user_segundamano',
	#	                   'y5>I1YiVZc5Nv@DR','id18038807_segundamano');
        if($conn->connect_error){
            die("Error al conectar con MySQL: " . $conn->error);
        }
        return $conn;
    }
}

