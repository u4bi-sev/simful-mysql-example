<?php

class db {

    private $DB_HOST = 'localhost';
    private $DB_USER = '';
    private $DB_PASS = '';
    private $DB_NAME = '';

    public function connect() {
        
        $mysql_connect_str = "mysql:host=$this->DB_HOST;dbname=$this->DB_NAME";
        
        $connection = new PDO($mysql_connect_str, $this->DB_USER, $this->DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $connection;
    }

}