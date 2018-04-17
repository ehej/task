<?php
require 'db.php';

class Model
{
    /*
      Модель обычно включает методы выборки данных, это могут быть:
      > методы нативных библиотек pgsql или mysql;
      > методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
      > методы ORM;
      > методы для работы с NoSQL;
      > и др.
     */

    public $db;

    public function __construct()
    {
        global $config;
        $this->db = (new db($config['db']))->getConnect();
    }

    // метод выборки данных
    public function get_data()
    {
        // todo
    }

}