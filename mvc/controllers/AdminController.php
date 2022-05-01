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
        require_once 'mvc/views/Admin/UsersList.php';
        $view = new UsersList();
        $view->display();
    }

    public function user_permissions_list() {
        $user_id = $_GET['user'];
        require_once 'mvc/views/Admin/UserPermissionsList.php';
        $view = new UserPermissionsList();
        $view->display($user_id);
    }

    public function user_permissions_delete() {
        $user_id = $_GET['user'];
        $permission_id = $_GET['permission'];

        require_once 'mvc/models/UsersPermissions.php';
        $users_permissions = new UsersPermissions();

        $record = $users_permissions->find_record("user_id = $user_id AND permission_id = $permission_id");

        $users_permissions->delete($record['id']);
        echo 'Permission has been deleted';

        header("Location: /index.php?model=Admin&action=user_permissions_list&user=$user_id");
    }

    public function user_permissions_add() {
        $user_id = $_GET['user'];
        $permission_id = $_POST['permission'];

        require_once 'mvc/models/UsersPermissions.php';
        $users_permissions = new UsersPermissions();

        $record = [
            "user_id" => $user_id,
            "permission_id" => $permission_id,
        ];

        $users_permissions->save($record);
        echo 'Permission has been added to account';

        header("Location: /index.php?model=Admin&action=user_permissions_list&user=$user_id");
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