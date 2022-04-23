<?php

/**
 * Description of Item
 *
 *  @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class Item {

    private $id;
    private $name;
    private $description;
    private $location;
    //Propiedad para acceder a los datos del user al que pertenece el item
    private $id_departament;
    private $id_service;
    //Propiedad para acceder a los datos del user al que pertenece el item
    private $user;
    private $state;
    //Propiedad para acceder a las photosItem del item
    private $photoItemsItem;

    function getDate() {
        return $this->date;
    }

    function setDate($date): void {
        $this->date = $date;
    }

    function getId() {
        return $this->id;
    }

    function getItem() {
        return $this->Item;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getLocation() {
        return $this->location;
    }

    function getId_departament() {
        return $this->id_departament;
    }

    function getId_service() {
        return $this->id_service;
    }

    function getId_user() {
        return $this->id_user;
    }
    function getUser() {
        if (!isset($this->usuario)) {
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            $this->usuario = $usuarioDAO->findUserById($this->getId_user());
        }
        return $this->usuario;
    }

    function getState() {
        return $this->state;
    }

    function getPhotosItem() {
        if (!isset($this->photosItem)) {
            $photoItemDAO = new PhotoItemDAO(ConexionBD::conectar());
            $this->photosItem = $photoItemDAO->findByIdItem($this->getId());
        }
        return $this->photosItem;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setItem($item): void {
        $this->Item = $item;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setLocation($location): void {
        $this->location = $location;
    }

    function setId_departament($id_departament): void {
        $this->id_departament = $id_departament;
    }

    function setId_service($id_service): void {
        $this->id_service = $id_service;
    }

    function setId_user($id_user): void {
        $this->id_user = $id_user;
    }

    function setState($state): void{
        $this->state = $state;
    }

    function setPhotosItem($photoItem): void {
        $this->photo = $photoItem;
    }
}