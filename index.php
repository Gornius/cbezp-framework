<?php

include_once 'classes/Dependencies.php';
include_once 'classes/mysqliDatabase.php';

$dependencies = new Dependencies();
$dependencies->database->query('select * from test');