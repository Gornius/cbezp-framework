<?php

class UsersRoles extends Model {
    public $table_name = 'users_roles';
    public $fields = [
        'user_id' => [
            'db_type' => 'int',
            'relationship' => [
                'table' => 'users',
                'foreign_key' => 'id',
            ]
        ],
        'role_id' => [
            'db_type' => 'int',
            'relationship' => [
                'table' => 'role',
                'foreign_key' => 'id',
            ],
        ],
    ];
}
