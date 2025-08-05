<?php

/**
 * Description of Item
 *
 *  @author Juan Miguel Hurtado Montejano -> jmhurtadomontejano@gmail.com
 */
class Contact {

    private $id;
    private $name;
    private $email;
    private $subject;
    private $message;
    private $created_at;

    public function __construct($id = null, $name = null, $email = null, $subject = null, $message = null, $created_at = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->created_at = $created_at;
    }

    public static function initValues($id, $name, $email, $subject, $message, $created_at) {  
        $contact = new Contact();
        $contact->setId($id);
        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setSubject($subject);
        $contact->setMessage($message);
        $contact->setCreatedAt($created_at);
        return $contact;
    }


    function getId() {
        return $this->id;
    }

    // Removed unrelated getItem, getDescription, getLocation methods

    // function getId_department() {
    //     return $this->id_department;
    // }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getSubject() {
        return $this->subject;
    }

    function getMessage() {
        return $this->message;
    }

    function getCreatedAt() {
        return $this->created_at;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setSubject($subject): void {
        $this->subject = $subject;
    }

    function setMessage($message): void {
        $this->message = $message;
    }

    function setCreatedAt($created_at): void {
        $this->created_at = $created_at;
    }
}