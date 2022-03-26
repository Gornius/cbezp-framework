<?php

include_once 'classes/Dependencies.php';
include_once 'classes/models/Mydlo.php';

$ss = Dependencies::get_smarty();
$ss->assign('title', 'test');
$ss->assign('page_content', 'test');
$ss->display('home.tpl');

$mydelko = new Mydlo();
$mydelko->reset_db();
