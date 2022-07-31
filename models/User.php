<?php

require_once('./../utils/main.php');

class User extends main {
    
    public $table = "users";

    public function __construct() {
        parent::__construct();
    }

    public function insert($payload) {
        return $this->deleteById(22);
        $stmt = $this->db->prepare("INSERT INTO users (firstname,lastname,username,pword,role_id) VALUES (?,?,?,?,?)");
        $stmt->execute($payload);
        return $this->getById($this->db->lastInsertId());
    }

    public function search($query) {
        return $this->db->query("SELECT * FROM users WHERE lastname LIKE '%$query%' OR firstname LIKE '%$query%' ")->fetchAll(PDO::FETCH_OBJ);
    }

}