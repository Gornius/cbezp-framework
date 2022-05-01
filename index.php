<?php

include_once 'vendor/autoload.php';

session_start();
$expire_time = $_SESSION['expire_time'];
if (!empty($expire_time)) {
    if ($expire_time < time()) {
        session_destroy();
    }
}

$_SESSION['expire_time'] = time() + 5*60;


$model = (!empty($_GET['model'])) ? $_GET['model'] : NULL;
$action = (!empty($_GET['action'])) ? $_GET['action'] : 'list';

$page_header = Dependencies::get_smarty();
$page_header->assign('user', $_SESSION['user']);
$page_header->display('page/header.tpl');

if (empty($model)) {
    $ss = Dependencies::get_smarty();
    $ss->assign('title', 'Homepage');
    $ss->display('home.tpl');
}

else {
    $controller_file = 'mvc/controllers/' . $model .'Controller.php';
    if(file_exists($controller_file)) {
        $contoller_class = $model . 'Controller';
        $controller = new $contoller_class;

        $controller->$action();
    }
    else {
        echo 'Provided route doesn\'t exist!'; die;
    }
}

$page_header = Dependencies::get_smarty();
$page_header->display('page/footer.tpl');