<?php

class UsersPermissions extends Model {
    public $table_name = 'users_permissions';
    public $fields = [
        'user_id' => [
            'db_type' => 'int',
            'relationship' => [
                'table' => 'users',
                'foreign_key' => 'id',
            ]
        ],
        'permission_id' => [
            'db_type' => 'int',
            'relationship' => [
                'table' => 'permission',
                'foreign_key' => 'id',
            ],
        ],
    ];
}
