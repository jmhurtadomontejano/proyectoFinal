<?php

/**
 * Description of MensajesFlash
 *
 * @author DAW2
 */
class MensajesFlash {

    static public function add_message($mensaje) {
        $_SESSION['mensajes_flash'][] = $mensaje;
    }

    static public function imprimir_mensajes() {
        if(isset($_SESSION['mensajes_flash'])) {
            foreach($_SESSION['mensajes_flash'] as $mensaje_flash){
                print '<div class="error">' . $mensaje_flash . '</div>';
            }
            unset($_SESSION['mensajes_flash']);
        }
    }

}
