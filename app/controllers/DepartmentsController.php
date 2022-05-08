<?php

class DepartmentsController {
    function insert(){
        if (Session::existe() == true) {
            $conn = ConexionBD::conectar();
            $usuDAO = new UsuarioDAO($conn);
            $itemDAO = new ItemDAO($conn);
            $usuario = $usuDAO->findUserById(Session::obtener()->getId());
            /*if user is admin o superadmin can watch, if not, no */
            if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') {
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
                    $phone = filter_var($_POST['inputPhone'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $emailDepartment = filter_var($_POST['inputEmail'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $iconDepartment = filter_var($_POST['inputIcon']);
                    //if name and description is not empty
                    if ($name!= "" && $description!= "") {
                        $department->setName($name);
                        $department->setDescription($description);
                        $department->setPhone($phone);
                        $department->setEmailDepartment($emailDepartment);
                        $department->setIconDepartment($iconDepartment);
                        $departmentDAO->insert($department);
                        MensajesFlash::add_message("Departamento añadido");
                    } else {
                        MensajesFlash::add_message("No puedes añadir un departamento sin nombre ni descripción");
                    }
              /*header location RUTA department_list */
                header('Location: ' . RUTA . '/departments_list');
                    die();
            }
            require '../app/views/departments/insert_department.php';
            }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver departamentos si no eres Administrador");
            die();
            }
        }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver departamentos si no inicias sesión");
            die();
        }
    }

    function departments_list(){
        if (Session::existe() == true) {
            $conn = ConexionBD::conectar();
            $usuDAO = new UsuarioDAO($conn);
            $itemDAO = new ItemDAO($conn);
            $usuario = $usuDAO->findUserById(Session::obtener()->getId());
            /*if user is admin o superadmin can watch, if not, no */
            if ($usuario->getRol() == 'admin' || $usuario->getRol() =='superAdmin') {
                $departmentDAO = new DepartmentDAO($conn);
                $departments = $departmentDAO->findAll();
                require '../app/views/departments/departments_list.php';
                    
            }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver departamentos si no eres Administrador");
            die();
            }
        }else{
            header("Location: " . RUTA);
            MensajesFlash::add_message("No puedes ver departamentos si no inicias sesión");
            die();
        }
    }

    public function detailDepartment() {
        $departmentId = $_POST['department_id'];
        $department = $this->findDepartmentByIdJson($departmentId);
        echo json_encode($department);
    }

    public function findDepartmentByIdJson(){
        $conn = ConexionBD::conectar();
        $departmentDAO = new DepartmentDAO($conn);
        $department = $departmentDAO->find($_POST['department_id']);
        return $department;
    }

    public function editDepartment(){
        $departmentDAO = new DepartmentDAO(ConexionBD::conectar());

        $department = Department::initValues($_POST['id'], $_POST['name'], $_POST['description'], $_POST['phone'], $_POST['emailDepartment'], $_POST['iconDepartment']);

        $departmentDAO->update($department);
    }

    
}