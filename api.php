<?php

include_once 'classes/Dependencies.php';
include_once 'classes/APIHelper.php';

$type = $_GET['type'];
if (empty($type)) $type = 'model';

if($type == 'model') {
    $model = $_GET['model'];
    if (empty($model)) return;
    $action = $_GET['action'];
    if (empty($action)) $action = 'list';
    $where = $_GET['where'];
    if (empty($where)) $where = '';
    $id = $_GET["id"];
    if (empty($id)) $id = "0";

    echo APIHelper::handle_model_request($model, $action, $id, $where); 
}