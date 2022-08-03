<?php
require('../func/helpers.php');
require('../models/User.php');

if(isset($_GET['action']) && $_GET['action'] == "create") {
    $post = extractPayload();
    $user = new User();

    $userExists = $user->checkUserIfExists($post['username']);

    if(!$userExists) {
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
        exit();
    } else {
        echo json_encode([
            'status' => 409,
            'data' => $userExists
        ]);
    }
    
}

if(isset($_GET['action']) && $_GET['action'] == "update") {
    $post = extractPayload();
    $user = new User();
    $result = $user->update([
        'lastname' => $post['lastname'],
        'firstname' => $post['firstname'],
        'username' => $post['username'],
        'role_id' => (int)$post['role_id'],
        'id' => (int)$post['id'],
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

if(isset($_GET['action']) && $_GET['action'] == "delete") {
    $user = new User();
    $user->deleteById($_GET['id']);
    echo json_encode([
        'status' => 200,
        'data' => 'sample'
    ]);
}


