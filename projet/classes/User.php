<?php
class User {
    private $name;
    private $email;

    public function __construct($name, $email) {
        $this->name  = $name;
        $this->email = $email;
    }

    public function save($db) {
        $stmt = $db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        return $stmt->execute([$this->name, $this->email]);
    }
}
