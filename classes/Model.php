<?php

use JetBrains\PhpStorm\Deprecated;

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
        $sql = "DROP TABLE IF EXISTS $this->table_name CASCADE";
        $db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name (
            id INT NOT NULL AUTO_INCREMENT";
        foreach ($this->fields as $key => $value) {
            $sql .= ", $key " . $value['db_type'];
        }
        $sql .= ", PRIMARY KEY (id))";
        
        $db->query($sql);
    }
}
