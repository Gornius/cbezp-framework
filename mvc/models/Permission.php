<?php

include_once 'classes/Model.php';

class Permission extends Model {
    public $table_name = 'permission';
    public $fields = [
        'name' => [
            'db_type' => 'varchar(255)',
        ],
    ];
}
