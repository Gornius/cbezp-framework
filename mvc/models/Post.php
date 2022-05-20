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
        global $loaded_user;
        $user = new User();
        if (!empty($record['id']) && $loaded_user['id'] != $record['user_id'] && !$user->check_access($loaded_user['id'], 'edit_any_post')) {
            die('You don\'t have permission to edit this post!');
        }

        global $loaded_user;
        if (isset($loaded_user)) {
        $record['user_id'] = $loaded_user['id'];
        }

        parent::save($record);
    }

    // Override default save method to include author
    public function delete($record) {
        global $loaded_user;
        $user = new User();
        if (!empty($record['id']) && $loaded_user['id'] != $record['user_id'] && !$user->check_access($loaded_user['id'], 'edit_any_post')) {
            die('You don\'t have permission to edit this post!');
        }
    }
}