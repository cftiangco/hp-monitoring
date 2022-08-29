<?php

$yesNo = [
    'Y',
    'N'
];

$familTypes = [
    'A',
    'B',
    'C',
    'D'
];

$toiletTypes = [
    'Water-sealed',
    'Open pit/Antipolo',
];

$dwellingUnits = [
    'Concrete',
    'Semi-concrete',
    'Nipa/Bamboo',
    'Wood',
    'Barong-barong'
];

$waterSources = [
    'Waterworks System',
    'Artesian Well (Bomba/jetmatic)/Deep well',
    'Spring (Bukal)',
];

$gender = [
    'M',
    'F'
];

$scholarships = [
    'No',
    'Academic Scholarship Programs',
    'Athletic Scholarship Programs',
    'Talent- or Skill-Based Scholarship Program',
    'Leadership Excellence Scholarship Programs',
    'Philippine Science High School (PSHS) Scholarship',
    'Annual Nationwide Search for Young Arts Scholars (Philippine High School for the Arts)',
    'National Government Scholarship Programs',
    'Local Government Scholarship Programs',
    'SM Foundation Inc. (SMFI) Scholarship Program',
    'Megaworld Foundation Scholarship',
    'Security Bank Foundation’s Scholars for Better Communities Scholarship Program',
    'Asian Development Bank’s Japan Scholarship Program',
    'Engineering Research and Development for Technology (ERDT) Scholarship',
    'Asian Development Bank’s Japan Scholarship Program',
    'Phildev Science and Engineering Scholarship',
];

$memberTypes = [
    1 => 'Son',
    2 => 'Daughter',
    3 => 'Mother',
    4 => 'Father',
    5 => 'Grandfather',
    6 => 'Grandmother',
    7 => 'Cousin',
    8 => 'Aunt',
    9 => 'Uncle',
    10 => 'Other Member'
];

$occupations = [
   'Unemployed',
   'Part-time',
   'Full-time',
   'Other (Please specify)'
];

$salaries = [
    '< 10,000',
    '10,000 - 20,000',
    '20,001 - 35,000',
    '35,001 - 50,000',
    '50,000 >'
];

$grades = [
    'Elementary',
    'High School',
    'Senior High School',
    'College',
    'Masteral'
 ];

function extractPayload() {
    $json = file_get_contents('php://input',true);
    return json_decode($json,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

function getRelationship($id) {
    switch($id) {
        case 1:
            return 'Son';
        break;
        case 1:
            return 'Daughter';
        break;
        case 2:
            return 'Mother';
        break;
        case 3:
            return 'Father';
        break;
        case 4:
            return 'Grandfather';
        break;
        case 5:
            return 'Grandmother';
        break;
        case 6:
            return 'Cousin';
        break;
        case 7:
            return 'Aunt';
        break;
        case 8:
            return 'Uncle';
        break;
        case 9:
            return 'Other Member';
        break;
    }
}

function userSession($user) {
    $_SESSION["firstname"] = $user->firstname;
    $_SESSION["lastname"] = $user->lastname;
    $_SESSION["username"] = $user->username;
    $_SESSION["role_id"] = $user->role_id;
    $_SESSION["user_id"] = $user->id;
}

function dateFormat($date) {
    return date('m/d/Y',strtotime($date));
}

function getAge($dob){

    $dob = date("Y-m-d",strtotime($dob));

    $dobObject = new DateTime($dob);
    $nowObject = new DateTime();

    $diff = $dobObject->diff($nowObject);

    return $diff->y;
}