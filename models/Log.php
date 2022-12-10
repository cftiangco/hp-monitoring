<?php

require_once(dirname(__FILE__,2) . '/utils/main.php');

class Log extends main {
    
    public $table = "user_logs";

    public function __construct() {
        parent::__construct();
    }

    public function addLog($id,$description) {
        return $this->create([
            'user_id' => $id,
            'description' => $description
        ]);
    }

    
    public function fetchLogs() {
        return $this->db->query("SELECT CONCAT(u.lastname,', ',u.firstname) AS `fullname`,ul.* FROM user_logs ul
        INNER JOIN users u ON u.id = ul.user_id ORDER BY ul.tstamp DESC")->fetchAll();
    }

    public function fetchByUserId($id) {
        return $this->db->query("SELECT l.* FROM users u 
        INNER JOIN surveys s ON s.user_id = u.id 
        INNER JOIN user_logs l ON l.user_id = s.id 
        WHERE u.id = $id;")->fetchAll();
    }

}