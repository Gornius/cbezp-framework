<?php

include_once 'classes/Dependencies.php';

class Model {
    public $table_name = 'default';
    public $fields = [];

    public function __construct() {
        $this->setup_fields();
    }

    private function setup_fields() {
        foreach($this->fields as $key => $value) {
            $this->$key = $value['default'];
        }
    }

    public function reset_db() {
        $db = Dependencies::get_database();
        $db->reset_db($this);
    }

    public function get_list($where="") {
        $db = Dependencies::get_database();
        return $db->get_list($this, $where);        
    }

    public function get_record($id) {
        $db = Dependencies::get_database();
        return $db->get_record($this, $id);
    }
}
