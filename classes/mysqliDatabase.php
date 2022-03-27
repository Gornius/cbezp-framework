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

    public function reset_db(Model $model) {
        $db = $this->mysqli_instance;
        $sql = "DROP TABLE IF EXISTS $model->table_name CASCADE";
        $db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS $model->table_name (
            id INT NOT NULL AUTO_INCREMENT";
        foreach ($model->fields as $key => $value) {
            $sql .= ", $key " . $value['db_type'];
        }
        $sql .= ", PRIMARY KEY (id))";
        
        $db->query($sql);
    }

    public function get_list($model, $where="") {
        $db = $this->mysqli_instance;
        $sql = "SELECT * FROM $model->table_name";
        $rows = [];
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }
}