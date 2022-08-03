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
    1 => 'Children',
    2 => 'Other Member'
];

function extractPayload() {
    $json = file_get_contents('php://input',true);
    return json_decode($json,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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