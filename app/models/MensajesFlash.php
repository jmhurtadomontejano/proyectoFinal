<?php

/**
 * Description of MensajesFlash
 *
 * @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class MensajesFlash {

    static public function add_message(string $mensaje, string $type = MessageType::SUCCESS) {
        $_SESSION['mensajes_flash'][] = array($mensaje, $type);
    }

    static public function imprimir_mensajes() {
        if(isset($_SESSION['mensajes_flash'])) {
            foreach($_SESSION['mensajes_flash'] as $mensaje_flash){
                $title = $mensaje_flash[1];
                if($mensaje_flash[1] == MessageType::ERROR )  $mensaje_flash[1] = 'danger';
                print '<div class="error alert alert-'.$mensaje_flash[1].'" role="alert">'
                    .'<strong style="text-transform: capitalize ">'.$title.'</strong>'.": " 
                    . $mensaje_flash[0] .
                '</div>';
            }
            unset($_SESSION['mensajes_flash']);
        }
    }
}

class MessageType {
    const WARNING = 'warning';
    const ERROR = 'error';
    const SUCCESS = 'success';
    const INFO = 'info';
}