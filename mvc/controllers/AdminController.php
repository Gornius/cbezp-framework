<?php

class AdminController {
    public function list() {
        $this->reset_db();
    }

    public function reset_db() {
        $resetmodel_name = $_GET['resetmodel'];
        $resetmodel_path = 'mvc/models/' . $resetmodel_name . '.php';

        if (file_exists($resetmodel_path)) {
            include_once $resetmodel_path;
            $model = new $resetmodel_name;
            $model->reset_db();

            $model->init();

            echo "Database table '$model->table_name' has been reset!";
        }
    }
}