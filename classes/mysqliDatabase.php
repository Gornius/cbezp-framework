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
        $sql = "DROP TABLE IF EXISTS $model->table_name CASCADE";
        $this->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS $model->table_name (
            id INT NOT NULL AUTO_INCREMENT";
        foreach ($model->fields as $key => $value) {
            $sql .= ", $key " . $value['db_type'];
        }
        $sql .= ", PRIMARY KEY (id))";
        
        $this->query($sql);
    }

    public function get_list($model, $where="") {
        $sql = "SELECT * FROM $model->table_name";
        $rows = [];
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }

    public function find_record($model, $where="") {
        $sql = "SELECT * FROM $model->table_name";
        $rows = [];
        if (!empty($where)) {
            $sql .= " WHERE $where LIMIT 1";
        }
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row;
            }
        }
    }

    public function get_record($model, $id) {
        $sql = "SELECT * FROM $model->table_name WHERE id=$id LIMIT 1";
        $result = $this->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row;
            }
        }
        echo("Record was not found!");
        return NULL;
    }

    public function add_record(Model $model, $record) {
        $sql = "INSERT INTO $model->table_name (" ;
        foreach($model->fields as $field => $params) {
            $sql .= "$field,";
        }
        $sql = rtrim($sql, ",");
        $sql .= ") VALUES (";
        foreach($model->fields as $field => $params) {
            if (!$model->validate_field($field, $record[$field])) die("Error validating $field");
            $sql .= "'$record[$field]',";
        }
        $sql = rtrim($sql, ",");
        $sql .= ")";

        $this->query($sql);
    }

    public function edit_record(Model $model, $id, $record) {
        $sql = "UPDATE $model->table_name SET ";
        foreach($model->fields as $field => $params) {
            $sql .= " $field = '$record[$field]',";
        }
        $sql = rtrim($sql, ',');

        $sql .= " WHERE id = $id";
        $this->query($sql);
    }

    public function delete_record(Model $model, $id) {
        $db = $this->mysqli_instance;
        $sql = "UPDATE $model->table_name SET deleted=1 WHERE id=$id LIMIT 1";

        return $this->query($sql);
    }
}