<?php

include_once 'classes/Dependencies.php';
$deps = new Dependencies();

$ss = $deps->smarty;
$ss->assign('title', 'test');
$ss->assign('page_content', 'test');
$ss->display('home.tpl');
