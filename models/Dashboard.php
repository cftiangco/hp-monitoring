<?php

require_once(dirname(__FILE__,2) . '/utils/main.php');

class DasBoard extends main {
    
    public $table = "members";


    public function data() {
        $data = new stdClass();
        $data->students = $this->students();
        $data->surveys = $this->survey();
        $data->workers = $this->workers();
        $data->disabilities = $this->disabilities();
        $data->breastFeed = $this->breastFeed();
        $data->scholars = $this->scholars();
        return $data;
    }

    public function students() {
        return $this->db->query("SELECT COUNT(*) FROM members WHERE studying = 'y'")->fetchColumn();
    }

    public function survey() {
        return $this->db->query("SELECT COUNT(*) FROM surveys")->fetchColumn();
    }

    public function workers() {
        return $this->db->query("SELECT COUNT(*) FROM members WHERE occupation != 'Unemployed'")->fetchColumn();
    }

    public function disabilities() {
        return $this->db->query("SELECT COUNT(*) FROM members WHERE disability = 'y';")->fetchColumn();
    }

    public function breastFeed() {
        return $this->db->query("SELECT COUNT(*) FROM members WHERE breast_feeding = 'y';")->fetchColumn();
    }

    public function scholars() {
        return $this->db->query("SELECT COUNT(*) FROM members WHERE scholarship_member != 'No';")->fetchColumn();
    }

}