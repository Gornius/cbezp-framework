<?php

interface IDatabase {
    public function __construct(string $config_file);
    public function query(string $query);
}