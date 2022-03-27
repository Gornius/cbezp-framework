<?php

include_once 'classes/Model.php';

class Post extends Model {
    public $table_name = 'post';
    public $fields = [
        'name' => [
            'db_type' => 'varchar(255)',
        ],
        'type' => [
            'db_type' => 'varchar(255)',
        ],
        'name' => [
            'db_type' => 'varchar(255)',
        ],
        'message' => [
            'db_type' => 'varchar(255)',
        ],
        'deleted' => [
            'db_type' => 'boolean',
            'default' => 0,
        ]
    ];
}