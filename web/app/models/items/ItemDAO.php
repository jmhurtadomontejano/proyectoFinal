<?php

//echo $_POST['id'];

/*
 * Description of ItemDAO
 *
 *  @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class ItemDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }


    public function insert($item) {
        //Comprobamos que el parámetro sea de la clase Usuario
        if (!$item instanceof item) {
            return false;
        }
        $name = $item->getname();
        $description = $item->getDescription();
        $location = $item->getLocation();
        $id_department = $item->getId_department();
        $id_service = $item->getId_service();
        $id_attendUser = $item->getId_attendUser();
        $id_clientUser = $item->getId_clientUser();
        $id_user = $item->getId_user();
        $state = $item->getState();
        $date = $item->getDate();
        $hour = $item->getHour();
        $duration = $item->getDuration();
        $sql = "INSERT INTO items (name, description, location, id_department, id_service, id_attendUser, id_clientUser, id_user, state, date, hour, duration) VALUES "
                . "(?,?,?,?,?,?,?,?,?,?,?,?)";
        if(!$stmt = $this->conn->prepare($sql)){
            die("Error al preparar la consulta ItemDAO->isert($item): " ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        
        $stmt->bind_param('sssdiiiissss',$name, $description, $location, $id_department, $id_service, $id_attendUser, $id_clientUser, $id_user, $state, $date, $hour, $duration);
        $stmt->execute();
        $result = $stmt->get_result();
        
        //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $item->setId($this->conn->insert_id);
        return true;
    }

    public function update($item) {
        //Comprobamos que el parámetro es de la clase Usuario
        if (!$item instanceof Item) {
            return false;
        }
        $name = $item->getname();
        $description = $item->getDescription();
        $location = $item->getlocation();
        $id_department = $item->getId_department();
        $id_service = $item->getId_service();
        $id_attendUser = $item->getId_attendUser();
        $id_clientUser = $item->getId_clientUser();
        $id = $item->getId();
        $state = $item->getState();
        $date = $item->getDate();
        $hour = $item->getHour();
        $duration = $item->getDuration();
        $result = $item->getResult();
        $sql = "UPDATE items SET"
                . " name=?, description=?,location=?, id_department=?, id_service=?, id_attendUser=?, id_clientUser=?, state=?, date=?, hour=?, duration=?, result=?"
                . " WHERE id = ?";
        if(!$stmt = $this->conn->prepare($sql))
        {
            die("Error al preparar la consulta: ItemDAO->update($item) " ."<br>"/n . $sql ." <br>"/n/n. $this->conn->error);
        }
        $stmt->bind_param("sssiiiisssssi",$name, $description, $location, $id_department, $id_service, $id_attendUser, $id_clientUser, $state, $date, $hour, $duration, $result, $id);
        $stmt->execute();
        $result = $stmt->get_result();
                
        if ($stmt->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Borra un registro de la tabla Usuarios
     * @param type $usuario Objeto de la clase usuario
     * @return bool Devuelve true si se ha borrado un usuario y false en caso contrario
     */
    public function delete($item) {
        //Comprobamos que el parámetro no es nulo y es de la clase Usuario
        if ($item == null || get_class($item) != 'item') {
            return false;
        }
        $sql = "DELETE FROM items WHERE id = " . $item->getId();
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Devuelve el item de la BD 
     * @param  $id id del usuario
     * @return \ item de la BD o null si no existe
     */
    public function find($id) { //: Usuario especifica el tipo de datos que va a devolver pero no es obligatorio ponerlo
        $sql = "SELECT * FROM items WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        return $result->fetch_object('item');
        /* También se podría sustituir el fetch_object por lo siguiente:
         * 
         * if ($fila = $result->fetch_assoc()) {
          $usuario = new Usuario();
          $usuario->setEmail($fila['email']);
          $usuario->setPassword($fila['password']);
          $usuario->setId($fila['id']);
          $usuario->setFoto($fila['foto']);
          $usuario->setNombre($fila['nombre']);

          return $usuario;
          } else {
          return null;
          } */
    }

    
    public function findByItemId($id) { //: Usuario especifica el tipo de datos que va a devolver pero no es obligatorio ponerlo
        $sql = "SELECT * FROM items WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        return $result->fetch_object('item');
     
    }

    

    /**
     * Devuelve todos los usuarios de la BD
     * @param type $orden Tipo de orden (ASC o DESC)
     * @param type $campo Campo de la BD por el que se van a ordenar
     * @return array Array de objetos de la clase Usuario
     */
    public function findAll($orden = 'ASC', $campo = 'id') {
        $sql = "SELECT *,date_format(date,'%e/%c/%Y') as date FROM items ORDER BY $campo $orden";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        $array_obj_items = array();
        while ($item = $result->fetch_object('item')) {
            $array_obj_items[] = $item;
        }
        return $array_obj_items;
    }

    public function findItemsByUser($id_user) {
        $sql = "SELECT *,date_format(date,'%e/%c/%Y') as date FROM items WHERE id_attendUser=? ORDER BY id DESC";
        if(!$stmt = $this->conn->prepare($sql)){
            die("Error en la consulta $sql:" ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        
        $stmt instanceof mysqli_stmt;
        
        $stmt->bind_param('i', $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        
        
        $array_obj_items = array();
        while ($item = $result->fetch_object('Item')) {
            $array_obj_items[] = $item;
        }
        return $array_obj_items;
    }
    
    public function findItemsByUserFilters($id_user, $byDate, $byDepart) {
        $where = "WHERE (id_attendUser=? OR id_attendUser=0) ";

        if($byDate) $where = $where."AND date=? ";
        if($byDepart) $where = $where."AND id_department=? ";

        $sql = "SELECT *,date_format(date,'%e/%c/%Y') as date FROM items ".$where." ORDER BY id DESC";

        if(!$stmt = $this->conn->prepare($sql)){
            die("Error en la consulta $sql:" ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        
        $stmt instanceof mysqli_stmt;
        

        if($byDate && $byDepart) $stmt->bind_param('iss', $id_user, $byDate, $byDepart);
        else if($byDate) $stmt->bind_param('is', $id_user, $byDate);
        else if($byDepart) $stmt->bind_param('is', $id_user, $byDepart);
        else $stmt->bind_param('i', $id_user);

        $stmt->execute();
        $result = $stmt->get_result();
        
        
        $array_obj_items = array();
        while ($item = $result->fetch_object('Item')) {
            $array_obj_items[] = $item;
        }
        return $array_obj_items;
    }

    public function findItemsPendingByUserFilters($byDate, $byDepart) {
        $where = "WHERE id_attendUser='0' ";

        
        if($byDate) $where = $where."AND date=? ";
        if($byDepart) $where = $where."AND id_department=? ";

        $sql = "SELECT *,date_format(date,'%e/%c/%Y') as date FROM items ".$where." ORDER BY id DESC";

        if(!$stmt = $this->conn->prepare($sql)){
            die("Error en la consulta $sql:" ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        
        $stmt instanceof mysqli_stmt;
        

        if($byDate && $byDepart) $stmt->bind_param('ss', $byDate, $byDepart);
        else if($byDate) $stmt->bind_param('s', $byDate);
        else if($byDepart) $stmt->bind_param('s', $byDepart);
        else $stmt->bind_param('i', '0');

        $stmt->execute();
        $result = $stmt->get_result();
        
        
        $array_obj_items = array();
        while ($item = $result->fetch_object('Item')) {
            $array_obj_items[] = $item;
        }
        return $array_obj_items;
    }

    public function findItemsByClientUser($id_user) {
        $sql = "SELECT *,date_format(date,'%e/%c/%Y') as date FROM items WHERE id_clientUser=? ORDER BY id DESC";
        if(!$stmt = $this->conn->prepare($sql)){
            die("Error en la consulta $sql:" ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        
        $stmt instanceof mysqli_stmt;
        
        $stmt->bind_param('i', $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        
        
        $array_obj_items = array();
        while ($item = $result->fetch_object('Item')) {
            $array_obj_items[] = $item;
        }
        return $array_obj_items;
    }
    

    public function listar_departamentos() { //: 
        $sql = "SELECT *  FROM departments";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL ItemDAO->listar_departamentos(): "."<br>"/n . $sql ."<br>"/n."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        $array_obj_departament = array();
        while ($department = $result->fetch_object()) {
            $array_obj_departament[] = $department;
        }
       // $var1 = json_encode($array_obj_departament);
        return $array_obj_departament;
    }

    public function list_users() { //: 
        $sql = "SELECT *  FROM usuarios order by nombre";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL ItemDAO->list_users(): " ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        $array_obj_users = array();
        while ($user = $result->fetch_object()) {
            $array_obj_users[] = $user;
        }
        return $array_obj_users;
    }

    public function list_admins(){
        $sql = "SELECT *  FROM usuarios WHERE rol='admin' or rol='superadmin' order by nombre";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL ItemDAO->list_admins(): " ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        $array_obj_admins = array();
        while ($user = $result->fetch_object()) {
            $array_obj_admins[] = $user;
        }
        return $array_obj_admins;
    }

    public function list_postal_codes() { //: 
        $sql = "SELECT *  FROM postal_codes";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL ItemDAO->list_postal_codes(): " ."<br>"/n . $sql ."<br>"/n. $this->conn->error);
        }
        $array_obj_postal_codes = array();
        while ($postal_code = $result->fetch_object()) {
            $array_obj_postal_codes[] = $postal_code;
        }
        return $array_obj_postal_codes;
    }
}