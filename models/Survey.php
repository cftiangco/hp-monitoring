<?php

require_once(dirname(__FILE__,2) . '/utils/main.php');

class Survey extends main {
    
    public $table = "surveys";

    public function __construct() {
        parent::__construct();
    }

}