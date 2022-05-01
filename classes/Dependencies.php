<?php

class Dependencies {
    static function get_database() :IDatabase {
        return new mysqlPDODatabase();
    }
    static function get_smarty() :Smarty {
        return new SmartyWrapper();
    }
}