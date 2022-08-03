<?php
require('../func/helpers.php');
require('../models/Survey.php');


if(isset($_GET['action']) && $_GET['action'] == "delete") {
    $survey = new Survey();
    $survey->deleteById($_GET['id']);
    echo json_encode([
        'status' => 200,
        'data' => 'sample'
    ]);
}



