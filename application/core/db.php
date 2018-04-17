<?php

class db
{
    public $db = 'mysql:host=localhost;dbname=yii2_basic';
    public $user = 'root';
    public $password = '';
    private $_connect = false;

    public function __construct($config = null)
    {
        $this->db = isset($config['host']) && isset($config['dbname'])
            ? "mysql:host=" . $config['host'] . ";" . 'dbname=' . $config['dbname']
            : $this->db;
        $this->user = isset($user) ? $user : $this->user;
        $this->password = isset($password) ? $password : $this->password;
    }

    public function getConnect()
    {
        try {
             return new PDO($this->db, $this->user, $this->password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}