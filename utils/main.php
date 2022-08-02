<?php

class main
{

    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    public $db;
    public $table = "";

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->servername;dbname=hpmonitoring", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO $this->table (".implode(', ', array_keys($data)).") VALUES (:".implode(', :', array_keys($data)).")");
        $stmt->execute($data);
        return $this->getById($this->getInsertedID());
    }

    public function getInsertedID() {
        return $this->db->lastInsertId();
    }

    public function fetchAll($orderBy = "") {
        return $this->db->query("SELECT * FROM $this->table $orderBy")->fetchAll();
    }

    public function getById($id) {
        return $this->db->query("SELECT * FROM $this->table WHERE id = $id")->fetch(PDO::FETCH_OBJ);
    }

    public function deleteById($id) {
        $this->db->query("DELETE FROM $this->table WHERE id = $id")->fetch(PDO::FETCH_OBJ);
        return $id;
    }
    
}
