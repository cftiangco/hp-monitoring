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

}