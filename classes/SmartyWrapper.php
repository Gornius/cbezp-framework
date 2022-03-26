<?php

include_once('vendor/autoload.php');

class SmartyWrapper extends Smarty {
    public function __construct() {
        parent::__construct();
        $this->setCacheDir('./cache');
        $this->setCompileDir('./cache');
        $this->setTemplateDir('./templates');
    }
}