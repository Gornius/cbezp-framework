<?php

include_once 'classes/Dependencies.php';

class Model {
    public $table_name = 'default';

    /**
     * Fields can have
     * db_type - database type
     * possible_values - array of acceptable values by validator
     * default - default value
     */
    public $fields = [];

    public function __construct() {
        $this->setup_fields();
    }

    private function setup_fields() {
        foreach($this->fields as $key => $value) {
            if(!empty($value['default'])) $this->$key = $value['default'];
        }
    }

    public function validate_field($field_name, $field_value) {
        if (empty($this->fields[$field_name]['possible_values'])) return true;
        return in_array($field_value, $this->fields[$field_name]['possible_values']);
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

    public function find_record($where) {
        $db = Dependencies::get_database();
        return $db->find_record($this, $where);
    }

    public function save($record) {
        $db = Dependencies::get_database();

        if(empty($record['id'])) {
            $db->add_record($this, $record);
        }
        else {
            $db->edit_record($this, $record['id'], $record);
        }
    }

    public function delete($id) {
        $db = Dependencies::get_database();
        $db->delete_record($this, $id);
    }

    /**
     * Method meant to be overriden, runs after model is initiated in databse,
     * so for example you can use it to create default set of objects
     *
     * @return void
     * 
     */
    public function init() {
    }

}
