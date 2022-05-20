
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

    public function get_role_list($id) {
        $sql ="
        SELECT role.*
        FROM users
        LEFT JOIN users_roles on users_roles.user_id = users.id
        LEFT JOIN role on users_roles.role_id = role.id
        WHERE users.id = $id
        ";

        $db = Dependencies::get_database();
        $result = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $bare_roles = [];
        foreach($result as $row){
            if($row['id'] != NULL) {
                $bare_roles[] = $row;
            }
        }

        return $bare_roles;
    }

    public function get_permissions_list_combined($id) {
        $role_model = new Role();

        $permissions = $this->get_permissions_list($id);
        $roles = $this->get_role_list($id);

        $permissions_from_roles = [];
        foreach($roles as $role) {
            $local_permissions = $role_model->get_permissions_list($role['id']);
            foreach($local_permissions as $p) {
                $permissions_from_roles[] = $p;
            }
        }

        $permissions = array_unique(array_merge($permissions_from_roles, $permissions), SORT_REGULAR);

        return $permissions;
    }

    public function get_permission_names($id) {
        $permissions_names = [];
        $permissions = $this->get_permissions_list_combined($id);

        foreach($permissions as $permission) {
            $permissions_names[] = $permission['name'];
        }

        return $permissions_names;
    }

    /**
     * Checks if logged user has certain permission
     *
     * @param mixed $permission - name of the permission
     * 
     * @return true - if user has permission
     * @return false - if user doesn't have permission
     * 
     */
    public function check_access($id, $permission) {
        $user_model = new User();

        if (empty($user)) return false;

        $permissions = $user_model->get_permission_names($id);

        if(in_array($permission, $permissions)) {
            return true;
        }
        return false;
    }

}