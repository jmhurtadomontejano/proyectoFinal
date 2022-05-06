<?php

/**
 * Description of Usuario
 *
 * @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class Usuario {
    private $id;
    private $nombre;
    private $surname;
    private $dni;
    private $email;
    private $phone;
    private $postalCode;
    private $password;
    private $photo;
    private $rol;
    private $cookie_id;

    public function __construct()
    {
    }

    public static function initValues($id, $nombre, $surname, $email, $rol, $dni, $phone, $postalCode, $password, $photo, $cookie_id) {
        $obj = new Usuario();
        $obj->id = $id;
        $obj->nombre = $nombre;
        $obj->surname = $surname;
        $obj->email = $email;
        $obj->rol = $rol;
        $obj->dni = $dni;
        $obj->phone = $phone;
        $obj->postalCode = $postalCode;
        $obj->password = $password;
        $obj->photo = $photo;
        $obj->cookie_id = $cookie_id;
        return $obj;
    }

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

    function getSurname() {
        return $this->surname;
    }

    function getDni() {
        return $this->dni;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getPostalCode() {
        return $this->postalCode;
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

    function setSurname($surname): void {
        $this->surname = $surname;
    }

    function setDni($dni): void {
        $this->dni = $dni;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPhone($phone): void {
        $this->phone = $phone;
    }
    
    function setPostalCode($postalCode): void {
        $this->postalCode = $postalCode;
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