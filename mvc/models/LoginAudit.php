<?php

class LoginAudit extends Model {
    public $table_name = 'login_audit';
    public $fields = [
        'user' => [
            'db_type' => 'varchar(255)',
        ],
        'type' => [
            'db_type' => 'varchar(255)' // Can be log in/log out
        ],
        'time' => [
            'db_type' => 'datetime',
        ],
        'ip_addr' => [
            'db_type' => 'varchar(255)',
        ],
    ];

    public static function log($event_type) {
        if (!empty($_SESSION['user'])) {
            $user = new User();
            $user = $user->get_record($_SESSION['user']);
        }
        else {
            $user = [];
            $user['name'] = "NOT_LOGGED";
        }

        $login_audit = new LoginAudit();
        $login_audit->save([
            'user' => $user['name'],
            'type' => $event_type,
            'time' => date("Y-m-d H:i:s"),
            'ip_addr' => CommonHelper::getUserIP(),
        ]);
    }
}
