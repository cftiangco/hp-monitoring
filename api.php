<?php

require_once(dirname(__FILE__) . '/models/Survey.php');


$survey = new Survey();

echo json_encode($survey->getData(2));