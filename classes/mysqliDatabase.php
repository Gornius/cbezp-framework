<?php

include_once 'interfaces/IDatabase.php';
include_once 'classes/mysqliDatabase.php';

class mysqliDatabase implements IDatabase {
    private $mysqli_instance;

    public function __construct($config_file = 'config/mysqli.php') { 
        $mysqli_config = include $config_file;

        $this->mysqli_instance = new mysqli(
            $mysqli_config['address'],
            $mysqli_config['user'],
            $mysqli_config['password'],
            $mysqli_config['database']
        );
    }

    public function query($query) {
        return $this->mysqli_instance->query($query);
    }
}