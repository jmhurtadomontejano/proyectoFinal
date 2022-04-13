<?php

/**
 * Description of Usuario
 *
 * @author DAW2
 */
class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $photo;
    private $rol;
    private $cookie_id;
       
    //Array que va a contener los artículos de este usuario
    private $articulos;
    
    
    function getCookie_id() {
        return $this->cookie_id;
    }

    function setCookie_id($cookie_id): void {
        $this->cookie_id = $cookie_id;
    }

        function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getPhoto() {
        return $this->photo;
    }

    function getRol() {
        return $this->rol;
    }

    function getArticulos() {
        return $this->articulos;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setPhoto($photo): void {
        $this->photo = $photo;
    }

    function setArticulos($articulos): void {
        $this->articulos = $articulos;
    }

    function setRol($rol): void {
        $this->rol = $rol;
    }

}
