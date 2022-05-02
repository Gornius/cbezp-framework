<?php

class Role extends Model {
    public $table_name = 'role';
    public $fields = [
        'name' => [
            'db_type' => 'varchar(255)',
        ],
    ];

    public function init() {
        $hardcoded_roles = [
            'admin',
            'user',
        ];

        foreach($hardcoded_roles as $role) {
            $record = [
                "name" => $role,
            ];
            $this->save($record);
        }
    }
}
