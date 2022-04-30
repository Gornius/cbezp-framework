<?php

include_once 'interfaces/IDatabase.php';
include_once 'classes/mysqlPDODatabase.php';

class mysqlPDODatabase implements IDatabase {
    private \PDO $mysqlPDO_instance;

    public function __construct(string $config_file='config/mysqlPDO.php') {
        $mysqlPDO_config = include $config_file;

        $address = $mysqlPDO_config['address'];
        $user = $mysqlPDO_config['user'];
        $password = $mysqlPDO_config['password'];
        $database = $mysqlPDO_config['database'];

        return $this->mysqlPDO_instance = new PDO("mysql:host=$address;dbname=$database", $user, $password);
    }

    public function query(string $query, array $binds=[]) {
        $db = $this->mysqlPDO_instance;
        $statement = $db->prepare($query); 
        foreach ($binds as $variable => $opts) {
            $statement->bindValue($variable, $opts['value'], $opts['pdoparam']);
        }
        $statement->execute();
        return $statement;
    }
    
    public function reset_db(Model $model) {
        $sql = "SET FOREIGN_KEY_CHECKS = 0";
        $this->query($sql);

        $sql = "DROP TABLE IF EXISTS $model->table_name CASCADE";
        $this->query($sql);

        $sql = "SET FOREIGN_KEY_CHECKS = 1";
        $this->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS $model->table_name (
            id INT NOT NULL AUTO_INCREMENT";
        foreach ($model->fields as $key => $value) {
            $sql .= ", $key " . $value['db_type'];
        }

        foreach($model->fields as $field => $params) {
            if (!empty($params['relationship'])) {
                $table = $params['relationship']['table'];
                $fk = $params['relationship']['foreign_key'];
                $sql .= ", FOREIGN KEY ($field) REFERENCES $table($fk)";
            }
        }

        $sql .= ", PRIMARY KEY (id))";

        return $this->query($sql);
    }

    public function get_list(Model $model, $where) {
        $sql = "SELECT * FROM $model->table_name";
        $rows = [];
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        $result = $this->query($sql);

        foreach($result as $row) {
            $results[] = $row;
        }

        return $results;
    }
    
    public function find_record(Model $model, $where) {
        $sql = "SELECT * FROM $model->table_name";
        $rows = [];
        if (!empty($where)) {
            $sql .= " WHERE $where LIMIT 1";
        }
        $result = $this->query($sql);

        foreach($result as $row) {
            return $row;
        }
    }

    public function get_record(Model $model, $id) {
        $sql = "SELECT * FROM $model->table_name WHERE id=$id LIMIT 1";
        $result = $this->query($sql);

        foreach($result as $row) {
            return $row;
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

        return $this->query($sql);
    }

    public function edit_record(Model $model, $id, $record) {
        $sql = "UPDATE $model->table_name SET ";
        foreach($model->fields as $field => $params) {
            $sql .= " $field = '$record[$field]',";
        }
        $sql = rtrim($sql, ',');

        $sql .= " WHERE id = $id";
        return $this->query($sql);

    }

    public function delete_record(Model $model, $id) {
        $db = $this->mysqli_instance;
        $sql = "UPDATE $model->table_name SET deleted=1 WHERE id=$id LIMIT 1";

        return $this->query($sql);
    }

}