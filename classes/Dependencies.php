<?php
include_once 'interfaces/IDatabase.php';
include_once 'classes/mysqliDatabase.php';
include_once 'classes/SmartyWrapper.php';

class Dependencies {
    static function get_database() :IDatabase {
        return new mysqliDatabase();
    }
    static function get_smarty() :Smarty {
        return new SmartyWrapper();
    }
}