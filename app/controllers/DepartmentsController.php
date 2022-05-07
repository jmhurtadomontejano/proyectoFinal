<?php

class DepartmentsController {
    function insert(){
        if (Session::existe() == false) {
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes añadir items si no inicias sesión");
            die();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            /*             * ***************************************** */
            /*             * *** GUARDAMOS EL DEPARTAMENTO EN LA BBDD  */
            /*             * ***************************************** */
            $conn = ConexionBD::conectar();
            //Insertamos el departmento en la BBDD
            $departmentDAO = new DepartmentDAO($conn);
            $department = new Department();

            //Filtramos datos de entrada
            $name = filter_var($_POST['inputName'], FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_var($_POST['inputDescription'], FILTER_SANITIZE_SPECIAL_CHARS);

            //if name and description is not empty
            if ($name!= "" && $description!= "") {
                $department->setName($name);
                $department->setDescription($description);
                $departmentDAO->insert($department);
                MensajesFlash::add_message("Departamento añadido");
            } else {
                MensajesFlash::add_message("No puedes añadir un departamento sin nombre ni descripción");
            }
        
            header("Location: " . RUTA/departments_list);
            die();
    }
    require '../app/views/departments/insert_department.php';
    }

    function departments_list(){
        if (Session::existe() == false) {
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes añadir items si no inicias sesión");
            die();
        }
        $conn = ConexionBD::conectar();
        $departmentDAO = new DepartmentDAO($conn);
        $departments = $departmentDAO->findAll();
        require '../app/views/departments/departments_list.php';
    }

    public function editDepartment(){
        $departmentDAO = new DepartmentDAO(ConexionBD::conectar());

        $department = Department::initValues($_POST['id'], $_POST['name'], $_POST['description']);

        $departmentDAO->update($department);
    }
}