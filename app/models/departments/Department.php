<?php
/**
 * Description of Departament
 *
 *  @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class Department {
    private $idDepartment;
    private $name;
    private $description;
    private $phone;
    private $emailDepartment;
    private $iconDepartment; 
    
    //Va a almacenar los datos del artículo relacionado con este Departamento
    private $articulo;
    
    function getIdDepartment() {
        return $this->idDepartment;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getPhone() {
        return $this->phone;
    }

    function getEmailDepartment() {
        return $this->emailDepartment;
    }

    function getIconDepartment() {
        return $this->iconDepartment;
    }


    function setIdDepartment($id): void {
        $this->id = $idDepartment;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setPhone($phone): void {
        $this->phone = $phone;
    }

    function setEmailDepartment($emailDepartment): void {
        $this->emailDepartment = $emailDepartment;
    }

    function setIconDepartment($iconDepartment): void {
        $this->iconDepartment = $iconDepartment;
    }
    
}
