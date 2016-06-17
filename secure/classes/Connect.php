<?php

/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 28.05.2016
 * Time: 21:01
 */

class Connect
{
    static private $_instance = null;
    private $link = null;

    private function __construct(){
        try{
            $this->link = new PDO('mysql:host=localhost;dbname=session', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){

        }
    }

    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new Connect();
        }
        return self::$_instance;
    }

    public function getLink(){
        return $this->link;
    }
}