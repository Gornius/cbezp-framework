<?php

include_once 'classes/Model.php';

class Permission extends Model {
    public $table_name = 'permission';
    public $fields = [
        'name' => [
            'db_type' => 'varchar(255)',
        ],
    ];

    public function init() {
        $hardcoded_permissions = [
            'add_post',
            'remove_any_post',
            'remove_own_post',
            'edit_any_post',
            'edit_own_post',
            'view_public_posts',
            'view_own_private_posts',
            'view_all_posts',
        ];

        foreach($hardcoded_permissions as $permission) {
            $record = [
                "name" => $permission,
            ];
            $this->save($record);
        }
    }
}
