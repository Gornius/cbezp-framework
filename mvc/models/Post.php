<?php

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
        'user_id' => [
            'db_type' => 'varchar(255)',
            'nullable' => true, // Public posts don't requrie onwner
        ],
        'deleted' => [
            'db_type' => 'boolean',
            'possible_values' => [0, 1],
            'default' => 0,
        ]
    ];

    // Override default save method to include author
    public function save($record) {
        if (isset($_SESSION['user'])) {
        $record['user_id'] = $_SESSION['user']['id'];
        }

        parent::save($record);
    }
}