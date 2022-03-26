<?php
include_once 'interfaces/IDatabase.php';
include_once 'classes/mysqliDatabase.php';

class Dependencies {
    public IDatabase $database;

    public function __construct()
    {
        $this->database = new mysqliDatabase();
    }
}