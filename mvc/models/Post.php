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
            'possible_values' => ['private', 'public'],
        ],
        'message' => [
            'db_type' => 'varchar(255)',
        ],
        'deleted' => [
            'db_type' => 'boolean',
            'possible_values' => [0, 1],
            'default' => 0,
        ]
    ];
}