<?php
require_once '../system/config.php';
require_once '../system/UserDaoMysql.php';
require_once '../system/Helper.php';

$array = [
    'error' => '',
    'result' => []
];

$array['result'] = [
    'pong' => true
];



require_once 'return.php';