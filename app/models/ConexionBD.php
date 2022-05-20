<?php
/**
 * Description of ConexionBD
 *
 * @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class ConexionBD {
    public static function conectar(): mysqli{
       /*LOCAL CONFIGURATION*/
        $conn = new mysqli('localhost','root','','proyectoFinal');
        if($conn->connect_error){
            die("Error al conectar con MySQL: " . $conn->error);
        }
        return $conn;
    }

        /*SERVER CONFIGURATION*/
      /*  $conn = new mysqli('localhost','sql_jmhurtadomon','mjCGKfksF3JhHptL','sql_jmhurtadomon');
        if($conn->connect_error){
            die("Error al conectar con MySQL: " . $conn->error);
        }
        return $conn;
    
    }*/
}

