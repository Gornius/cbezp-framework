<?php
include_once 'interfaces/IDatabase.php';
include_once 'classes/mysqliDatabase.php';
include_once 'vendor/autoload.php';

class Dependencies {
    public IDatabase $database;
    public Smarty $smarty;

    public function __construct()
    {
        $this->database = new mysqliDatabase();

        $this->smarty = new Smarty();
        $this->smarty->setCacheDir('./cache');
        $this->smarty->setCompileDir('./cache');
        $this->smarty->setTemplateDir('./templates');
    }
}