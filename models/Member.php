<?php

require_once(dirname(__FILE__,2) . '/utils/main.php');

class Member extends main {
    
    public $table = "members";

    public function __construct() {
        parent::__construct();
    }

    public function fetchAllBySurveyId($id) {
        return $this->db->query("SELECT * FROM members WHERE survey_id = $id ORDER BY type_id,created_at")->fetchAll();
    }

    public function update($payload) {
        $stmt = $this->db->prepare("UPDATE members SET 
            survey_id = :survey_id,
            lastname = :lastname,
            firstname = :firstname,
            middlename = :middlename,
            birthday = :birthday,
            age = :age,
            studying = :studying,
            grade = :grade,
            occupation = :occupation,
            salary = :salary,
            breast_feeding = :breast_feeding,
            bottle_feeding = :bottle_feeding,
            mix_feeding = :mix_feeding,
            philhealth_member = :philhealth_member,
            disability = :disability,
            disability_type = :disability_type,
            sex = :sex,
            scholarship_member = :scholarship_member,
            forps_member = :forps_member,
            type_id = :type_id
            WHERE id = :id");
        $stmt->execute($payload);
        return $this->getById($payload['id']);
    }

}