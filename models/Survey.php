<?php

require_once(dirname(__FILE__,2) . '/utils/main.php');

class Survey extends main {
    
    public $table = "surveys";

    public function __construct() {
        parent::__construct();
    }

    public function update($payload) {

        $stmt = $this->db->prepare("UPDATE surveys SET 
            purok = :purok,
            hh_no = :hh_no,
            family_type = :family_type,
            family_members = :family_members,
            complete_address = :complete_address,
            household_head = :household_head,
            household_head_birthday = :household_head_birthday,
            household_head_student = :household_head_student, 
            household_head_student_grade = :household_head_student_grade,
            household_head_occupation = :household_head_occupation,
            household_head_occupation_other = :household_head_occupation_other,
            household_head_salary = :household_head_salary,
            household_head_philhealth_member = :household_head_philhealth_member,
            household_head_disability = :household_head_disability,
            household_head_disability_type = :household_head_disability_type,
            household_head_gender = :household_head_gender,
            partner_name = :partner_name,
            partner_gender = :partner_gender,
            partner_birthday = :partner_birthday,
            partner_student = :partner_student,
            partner_grade = :partner_grade,
            partner_occupation = :partner_occupation,
            partner_occupation_other = :partner_occupation_other,
            partner_salary = :partner_salary,
            partner_philhealth_member = :partner_philhealth_member,
            partner_pregnant = :partner_pregnant,
            partner_age_of_gestation = :partner_age_of_gestation,
            disability = :disability,
            disability_type = :disability_type,
            lmp = :lmp,
            edc = :edc,
            breast_feeding = :breast_feeding,
            family_planning_method = :family_planning_method,
            family_planning_methodtype = :family_planning_methodtype,
            civil_status = :civil_status
            WHERE id = :id
        ");

        $stmt->execute($payload);
        return true;
    }

    public function updateAdditionalInfo($payload) {
        $stmt = $this->db->prepare("UPDATE surveys SET 
            toilet_type = :toilet_type,
            dwelling_unit = :dwelling_unit,
            water_source = :water_source,
            vagetable_garden = :vagetable_garden,
            using_iodized_salt = :using_iodized_salt,
            has_animals = :has_animals,
            type_of_animals = :type_of_animals,
            using_fortified_foods = :using_fortified_foods
            WHERE id = :id
        ");

        $stmt->execute($payload);
        return true;
    }

    public function getData($id) {
        $survey = $this->getById($id);
        $members = $this->db->query("SELECT * FROM members WHERE survey_id = $id;")->fetchAll(PDO::FETCH_OBJ);

        foreach($members as $member) {
            $survey->members[] = $member;
        }  
        
        return $survey;
    }

    public function checkIfUserHasRecord($id) {
        return $this->db->query("SELECT id FROM surveys WHERE user_id = $id")->fetchColumn() ?? 0;
    }

    public function getSurveyId($hash) {
        return $this->db->query("SELECT id FROM surveys WHERE md5(user_id) = '$hash'")->fetchColumn() ?? 0;
    }

    public function getSurveyByHashUserId($userId) {
        return $this->db->query("SELECT * FROM surveys WHERE md5(user_id) = '$userId'")->fetch(PDO::FETCH_OBJ);
    }

}