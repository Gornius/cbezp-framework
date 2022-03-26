<?php

include_once 'classes/Model.php';

class Mydlo extends Model {
    public $table_name = 'mydlo';
    public $fields = [
        'mydlo1' => [
            'default' => '1',
            'db_type' => 'varchar(35)',
        ],
        'mydlo2' => [
            'default' => '1',
            'db_type' => 'varchar(35)',
        ],
        'mydlo3' => [
            'default' => '1',
            'db_type' => 'varchar(35)',
        ],
    ];
}