
<?php

include_once 'classes/Model.php';

class User extends Model {
    public $table_name = 'users';
    public $fields = [
        'name' => [
            'db_type' => 'varchar(255)',
        ],
        'password' => [
            'db_type' => 'varchar(255)',
        ],
        'email' => [
            'db_type' => 'varchar(255)',
        ],
        'uses_2step' => [
            'db_type' => 'bool',
        ]
    ];

    // Override save method se we store hash instead of plain text
    public function save($record) {
        $record['password'] = password_hash($record['password'], PASSWORD_BCRYPT);
        parent::save($record);
    }
}