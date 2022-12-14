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

    public function checkUserIfExists($username) {
        return $this->db->query("SELECT COUNT(*) FROM users WHERE username = '$username'")->fetchColumn();
    }

    public function changePassword($password,$userId) {
        $hash = md5($password);
        $this->db->exec("UPDATE users SET pword = '$hash' WHERE id = $userId");
        return true;
    }

    public function fetchAllUsers() {
        return $this->db->query("SELECT * FROM users WHERE role_id != 3")->fetchAll();
    }

    public function fetchAllAccounts() {
        return $this->db->query("SELECT * FROM users WHERE role_id = 3")->fetchAll();
    }


}