<?php

include_once 'classes/Model.php';

interface IDatabase {
    public function __construct(string $config_file);
    public function query(string $query);
    public function reset_db(Model $model);
    public function get_list(Model $model, $where);
    public function get_record(Model $model, $id);
    public function add_record(Model $model, $record);
    public function edit_record(Model $model, $id, $record);
    public function delete_record(Model $model, $id);
}