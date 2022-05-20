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
    private $id_department;
    private $id_service;
    private $id_attendUser;
    private $id_clientUser;
    //Propiedad para acceder a los datos del user al que pertenece el item
    private $user;
    private $state;
    private $date;
    private $hour;
    private $duration;
    private $result;
    //Propiedad para acceder a las photosItem del item
    private $photoItemsItem;

    public static function initValues($id, $name, $description, $location, $id_department, $id_service, $id_attendUser, $id_clientUser, $state, $date, $hour, $duration, $result) {  
        $item = new Item();
        $item->setId($id);
        $item->setName($name);
        $item->setDescription($description);
        $item->setLocation($location);
        $item->setId_department($id_department);
        $item->setId_service($id_service);
        $item->setId_attendUser($id_attendUser);
        $item->setId_clientUser($id_clientUser);
        $item->setState($state);
        $item->setDate($date);
        $item->setHour($hour);
        $item->setDuration($duration);
        $item->setResult($result);
        return $item;
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

    function getId_department() {
        return $this->id_department;
    }

    function getItemDepartment() {
        $departmentDAO = new departmentDAO(ConexionBD::conectar());
        $this->department = $departmentDAO->find($this->getId_department());
        return $this->department;
    }

    function getId_service() {
        return $this->id_service;
    }

    function getId_attendUser() {
        return $this->id_attendUser;
    }

    function getUser_attendUser(){
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            $this->usuario = $usuarioDAO->findUserById($this->getId_attendUser());
        return $this->usuario;
    }

    function getId_clientUser() {
        return $this->id_clientUser;
    }

    function getUser_clientUser(){
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            $this->usuario = $usuarioDAO->findUserById($this->getId_clientUser());
        return $this->usuario;
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

    function getDate() {
        return $this->date;
    }

    function getHour() {
        return $this->hour;
    }

    function getDuration() {
        return $this->duration;
    }

    function getResult() {
        return $this->result;
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

    function setId_department($id_department): void {
        $this->id_department = $id_department;
    }

    function setId_service($id_service): void {
        $this->id_service = $id_service;
    }

    function setId_attendUser($id_attendUser): void {
        $this->id_attendUser = $id_attendUser;
    }

    function setId_clientUser($id_clientUser): void {
        $this->id_clientUser = $id_clientUser;
    }

    function setId_user($id_user): void {
        $this->id_user = $id_user;
    }

    function setState($state): void{
        $this->state = $state;
    }

    function setDate($date): void {
        $this->date = $date;
    }

    function setHour($hour): void {
        $this->hour = $hour;
    }

    function setDuration($duration): void {
        $this->duration = $duration;
    }

    function setResult($result): void {
        $this->result = $result;
    }

    function setPhotosItem($photoItem): void {
        $this->photo = $photoItem;
    }
}