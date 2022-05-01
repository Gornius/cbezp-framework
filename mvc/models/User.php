
<?php

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
        ],
        'super_admin' => [
            'db_type' => 'bool',
        ],
    ];

    // Override save method se we store hash instead of plain text
    public function save($record) {
        $record['password'] = password_hash($record['password'], PASSWORD_BCRYPT);
        parent::save($record);
    }

    public function get_permissions_list($id) {
        $sql ="
        SELECT permission.*
        FROM users
        LEFT JOIN users_permissions on users_permissions.user_id = users.id
        LEFT JOIN permission on users_permissions.permission_id = permission.id
        WHERE users.id = $id
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