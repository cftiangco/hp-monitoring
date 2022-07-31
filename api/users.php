<?php
require_once('../func/helpers.php');
require_once('../models/User.php');

if(isset($_GET['action']) && $_GET['action'] == "create") {
    $post = extractPayload();
    $user = new User();
    $result = $user->create([
        'lastname' => $post['lastname'],
        'firstname' => $post['firstname'],
        'username' => $post['username'],
        'pword' => md5($post['password']),
        'role_id' => (int)$post['role_id'],
    ]);

    if($result) {
        echo json_encode([
            'status' => 201,
            'data' => $result
        ]);
    }
    
}

if(isset($_GET['action']) && $_GET['action'] == "getusers") {
    $user = new User();
    echo json_encode([
        'status' => 201,
        'data' => $user->fetchAll()
    ]);
}
if(isset($_GET['action']) && $_GET['action'] == "search") {
    $user = new User();
    echo json_encode([
        'status' => 201,
        'data' => $user->search($_GET['query'])
    ]);
}


