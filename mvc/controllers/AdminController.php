<?php

class AdminController extends Controller{
    public function __construct() {
        if(!$this->check_super_admin()) {
            die('This resource requires super admin!');
        }
    }

    public function list() {
        $this->reset_db();
    }

    public function users_list() {
        $view = new UsersList();
        $view->display();
    }

    public function user_permissions_list() {
        $user_id = $_GET['user'];
        $view = new UserPermissionsList();
        $view->display($user_id);
    }

    public function user_permissions_delete() {
        $user_id = $_GET['user'];
        $permission_id = $_GET['permission'];

        $users_permissions = new UsersPermissions();

        $record = $users_permissions->find_record("user_id = $user_id AND permission_id = $permission_id");

        $users_permissions->delete($record['id']);
        echo 'Permission has been deleted';

        header("Location: /index.php?model=Admin&action=user_permissions_list&user=$user_id");
    }

    public function user_permissions_add() {
        $user_id = $_GET['user'];
        $permission_id = $_POST['permission'];

        $users_permissions = new UsersPermissions();

        $record = [
            "user_id" => $user_id,
            "permission_id" => $permission_id,
        ];

        $users_permissions->save($record);
        echo 'Permission has been added to account';

        header("Location: /index.php?model=Admin&action=user_permissions_list&user=$user_id");
    }

    public function user_roles_list() {
        $user_id = $_GET['user'];
        $view = new UserRolesList();
        $view->display($user_id);
    }

    public function user_roles_delete() {
        $user_id = $_GET['user'];
        $role_id = $_GET['role'];

        $users_roles = new UsersRoles();

        $record = $users_roles->find_record("user_id = $user_id AND role_id = $role_id");

        $users_roles->delete($record['id']);
        echo 'role has been deleted';

        header("Location: /index.php?model=Admin&action=user_roles_list&user=$user_id");
    }

    public function user_roles_add() {
        $user_id = $_GET['user'];
        $role_id = $_POST['role'];

        $users_roles = new UsersRoles();

        $record = [
            "user_id" => $user_id,
            "role_id" => $role_id,
        ];

        $users_roles->save($record);
        echo 'role has been added to account';

        header("Location: /index.php?model=Admin&action=user_roles_list&user=$user_id");
    }

    public function reset_db() {
        $resetmodel_name = $_GET['resetmodel'];
        $resetmodel_path = 'mvc/models/' . $resetmodel_name . '.php';

        if (file_exists($resetmodel_path)) {
            $model = new $resetmodel_name;
            $model->reset_db();

            $model->init();

            echo "Database table '$model->table_name' has been reset!";
        }
    }
}