<?php

include_once 'classes/Dependencies.php';

$ss = Dependencies::get_smarty();
$ss->assign('title', 'test');
$ss->assign('page_content', 'test');
$ss->display('home.tpl');
