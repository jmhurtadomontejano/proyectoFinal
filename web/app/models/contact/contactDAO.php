<?php

/*
 * Description of ContactDAO
 *
 *  @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class ContactDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insert($contact) {
        // Comprobamos que el parámetro sea de la clase Contact
        if (!$contact instanceof Contact) {
            return false;
        }
        $name = $contact->getName();
        $email = $contact->getEmail();
        $subject = $contact->getSubject();
        $message = $contact->getMessage();
        $created_at = $contact->getCreatedAt();

        $sql = "INSERT INTO contacts (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, ?)";
        if(!$stmt = $this->conn->prepare($sql)){
            die("Error al preparar la consulta ContactDAO->insert(\$contact): " . "<br>\n" . $sql . "<br>\n" . $this->conn->error);
        }
        $stmt->bind_param('sssss', $name, $email, $subject, $message, $created_at);
        $stmt->execute();

        // Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $contact->setId($this->conn->insert_id);
        return true;
    }

    public function update($contact) {
        // Comprobamos que el parámetro es de la clase Contact
        if (!$contact instanceof Contact) {
            return false;
        }
        $id = $contact->getId();
        $name = $contact->getName();
        $email = $contact->getEmail();
        $subject = $contact->getSubject();
        $message = $contact->getMessage();
        $created_at = $contact->getCreatedAt();

        $sql = "UPDATE contacts SET name=?, email=?, subject=?, message=?, created_at=? WHERE id=?";
        if(!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la consulta: ContactDAO->update(\$contact) " . "<br>\n" . $sql . " <br>\n" . $this->conn->error);
        }
        $stmt->bind_param("sssssi", $name, $email, $subject, $message, $created_at, $id);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Borra un registro de la tabla contacts
     * @param type $contact Objeto de la clase Contact
     * @return bool Devuelve true si se ha borrado un contacto y false en caso contrario
     */
    public function delete($contact) {
        // Comprobamos que el parámetro no es nulo y es de la clase Contact
        if ($contact == null || get_class($contact) != 'Contact') {
            return false;
        }
        $sql = "DELETE FROM contacts WHERE id = ?";
        if(!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . "<br>\n" . $sql . "<br>\n" . $this->conn->error);
        }
        $id = $contact->getId();
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Devuelve el contacto de la BD 
     * @param  $id id del contacto
     * @return \Contact contacto de la BD o null si no existe
     */
    public function find($id) {
        $sql = "SELECT * FROM contacts WHERE id=?";
        if(!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . "<br>\n" . $sql . "<br>\n" . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object('Contact');
    }

    /**
     * Devuelve todos los contactos de la BD
     * @param type $orden Tipo de orden (ASC o DESC)
     * @param type $campo Campo de la BD por el que se van a ordenar
     * @return array Array de objetos de la clase Contact
     */
    public function findAll($orden = 'ASC', $campo = 'id') {
        $sql = "SELECT * FROM contacts ORDER BY $campo $orden";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . "<br>\n" . $sql . "<br>\n" . $this->conn->error);
        }
        $array_obj_contacts = array();
        while ($contact = $result->fetch_object('Contact')) {
            $array_obj_contacts[] = $contact;
        }
        return $array_obj_contacts;
    }

    // Métodos adicionales específicos para Contact pueden agregarse aquí si es necesario

}