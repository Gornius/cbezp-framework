<?php

class RoleController extends Controller {
    public function __construct() {
        if (!$this->check_super_admin()) {
            echo 'This resource requires super admin!';
            die;
        }
    }
    
    public function list() {
        $view = new RoleList();
        $view->display();
    }

    public function edit() {
        $id = $_GET['id'];
        if (!empty($id)) {
            $role = new Role();
            $record = $role->get_record($id);
        }
        else {
            $record = [];
        }

        $view = new RoleEdit();
        $view->display($record);
    }

    public function save() {
        $role = new Role();
        $record = [];
        foreach($role->fields as $field => $params) {
            $record[$field] = $_POST[$field];
        }

        $record['id'] = $_POST['id'];
        $role->save($record);

        header('Location: /?model=Role');
    }

    public function delete() {
        $role = new Role();
        $id = $_GET['id'];

        $role->delete($id);

        header('Location: /?model=Role');
    }

    public function role_permissions_list() {
        $view = new RolePermissionsList();

        $role = $_GET['role'];
        $view->display($role);
    }

    public function role_permissions_add() {
        $role = $_GET['role'];
        $permission = $_POST['permission'];

        $record = [
            'role_id' => $role,
            'permission_id' => $permission,
        ];
        $roles_permissions = new RolesPermissions();
        $roles_permissions->save($record);

        header("Location: /?model=Role&action=role_permissions_list&role=$role");
    }

    public function role_permissions_delete() {
        $role = $_GET['role'];
        $permission = $_GET['permission'];

        $roles_permissions = new RolesPermissions();

        $record = $roles_permissions->find_record("role_id = $role AND permission_id = $permission");

        $roles_permissions->delete($record['id']);

        header("Location: /?model=Role&action=role_permissions_list&role=$role");
    }
}