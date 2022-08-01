<?php

require_once(dirname(__FILE__,2) . '/utils/main.php');

class User extends main {
    
    public $table = "users";

    public function __construct() {
        parent::__construct();
    }

    public function update($payload) {
        $stmt = $this->db->prepare("UPDATE users SET firstname = :firstname,lastname=:lastname,username=:username,role_id=:role_id WHERE id = :id");
        $stmt->execute($payload);
        return true;
    }

    public function login($username,$password) {
        $user = $this->db->query("SELECT * FROM users WHERE username = '$username' ")->fetch(PDO::FETCH_OBJ);

        return $user;
    }

    public function search($query) {
        return $this->db->query("SELECT * FROM users WHERE lastname LIKE '%$query%' OR firstname LIKE '%$query%' ")->fetchAll(PDO::FETCH_OBJ);
    }

}