<?php

include_once 'classes/Dependencies.php';

$model = $_GET['model'];
$action = $_GET['action'];
if (empty($action)) $action = 'list';

if (empty($model)) {
    $ss = Dependencies::get_smarty();
    $ss->assign('title', 'Homepage');
    $ss->display('home.tpl');
}

else {
    $controller_file = 'mvc/controllers/' . $model .'Controller.php';
    if(file_exists($controller_file)) {
        include_once 'mvc/controllers/' . $model .'Controller.php';

        $contoller_class = $model . 'Controller';
        $controller = new $contoller_class;

        $controller->$action();
    }
    else {
        echo 'Provided route doesn\'t exist!'; die;
    }
}