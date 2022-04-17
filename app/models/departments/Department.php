<?php
/**
 * Description of Departament
 *
 *  @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class Department {
    private $idDepartament;
    private $name;
    private $description;
    
    //Va a almacenar los datos del artículo relacionado con esta photo
    private $articulo;
    
    function getIdDepartament() {
        return $this->idDepartament;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }


    function setIdDepartament($id): void {
        $this->id = $idDepartament;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    
}
