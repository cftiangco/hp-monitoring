<?php

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