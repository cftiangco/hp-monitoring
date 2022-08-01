<?php

$yesNo = [
    'Yes',
    'No'
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