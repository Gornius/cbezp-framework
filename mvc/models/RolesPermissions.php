<?php

class RolesPermissions extends Model {
    public $table_name = 'roles_permissions';
    public $fields = [
        'role_id' => [
            'db_type' => 'int',
            'relationship' => [
                'table' => 'role',
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
