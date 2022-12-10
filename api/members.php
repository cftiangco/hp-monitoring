<?php
require('../func/helpers.php');
require('../models/Member.php');
require('../models/Log.php');

$log = new Log();

if(isset($_GET['action']) && $_GET['action'] == "create") {
    $post = extractPayload();

    $member = new Member();
    
    $result = $member->create([
        'survey_id' => $post['survey_id'],
        'lastname' => $post['lastname'],
        'firstname' => $post['firstname'],
        'middlename' => $post['middlename'],
        'birthday' => $post['birthday'],
        'age' => $post['age'],
        'studying' => $post['studying'],
        'grade' => $post['grade'],
        'occupation' => $post['occupation'],
        'salary' => $post['salary'] ? $post['salary'] : '0',
        'breast_feeding' => $post['breast_feeding'],
        'bottle_feeding' => $post['bottle_feeding'],
        'mix_feeding' => $post['mix_feeding'],
        'philhealth_member' => $post['philhealth_member'],
        'disability' => $post['disability'],
        'disability_type' => $post['disability_type'],
        'sex' => $post['sex'],
        'scholarship_member' => $post['scholarship_member'],
        'forps_member' => $post['forps_member'],
        'type_id' => $post['type_id'],
        'other_work' => $post['other_work'],
    ]);

    if($result) {

        $log->create([
            'user_id' => $post['survey_id'],
            'description' => "Added new member " . "'{$post['firstname']}'"
        ]);

        echo json_encode([
            'status' => 201,
            'data' => $result
        ]);
    }
    
}

if(isset($_GET['action']) && $_GET['action'] == "update") {
    $post = extractPayload();
    $member = new Member();

    $result = $member->update([
        'survey_id' => $post['survey_id'],
        'lastname' => $post['lastname'],
        'firstname' => $post['firstname'],
        'middlename' => $post['middlename'],
        'birthday' => $post['birthday'],
        'age' => (int)$post['age'],
        'studying' => $post['studying'],
        'grade' => $post['grade'],
        'occupation' => $post['occupation'],
        'salary' => $post['salary'] ?? '0',
        'breast_feeding' => $post['breast_feeding'],
        'bottle_feeding' => $post['bottle_feeding'],
        'mix_feeding' => $post['mix_feeding'],
        'philhealth_member' => $post['philhealth_member'],
        'disability' => $post['disability'],
        'disability_type' => $post['disability_type'],
        'sex' => $post['sex'],
        'scholarship_member' => $post['scholarship_member'],
        'forps_member' => $post['forps_member'],
        'type_id' => $post['type_id'],
        'other_work' => $post['other_work'],
        'id' => $post['member_id'],
    ]);

    if($result) {
        $log->create([
            'user_id' => $post['survey_id'],
            'description' => "Updated member information " . "'{$post['firstname']}'"
        ]);

        echo json_encode([
            'status' => 201,
            'data' => $result
        ]);
    }
    
}

if(isset($_GET['action']) && $_GET['action'] == "fetch") {
    $post = extractPayload();

    $member = new Member();
    
    $result = $member->fetchAllBySurveyId($_GET['survey_id']);

    if($result) {
        echo json_encode([
            'status' => 201,
            'data' => $result
        ]);
    }
    
}

if(isset($_GET['action']) && $_GET['action'] == "delete") {
    $post = extractPayload();

    $member = new Member();
    
    $result = $member->deleteById($_GET['id']);

    if($result) {
        echo json_encode([
            'status' => 201,
            'data' => $result
        ]);
    }
    
}


