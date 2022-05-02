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

    public function get_permissions_list($id) {
        $sql ="
        SELECT permission.*
        FROM role
        LEFT JOIN roles_permissions on roles_permissions.role_id = role.id
        LEFT JOIN permission on roles_permissions.permission_id = permission.id
        WHERE role.id = $id
        ";

        $db = Dependencies::get_database();
        $result = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $bare_permissions = [];
        foreach($result as $row){
            if($row['id'] != NULL) {
                $bare_permissions[] = $row;
            }
        }

        return $bare_permissions;
    }
}
