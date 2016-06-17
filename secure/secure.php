<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 04.03.2016
 * Time: 15:44
 */
require_once "classes/Connect.php";

class Auth{
    private $link;

    function __construct(){
        $connect = Connect::getInstance();
        $this->link = $connect->getLink();
    }
    function getHash($string, $salt, $iteration_count){
        for($i=0; $i< $iteration_count; $i++){
            $string = sha1($string.$salt);
        }
        return $string;
    }

    function saveHash($user, $hash, $salt, $iteration, $rights){
        $sql = "INSERT INTO user (login, password, salt, iterations, rights) VALUES ('$user', '$hash', '$salt', '$iteration',
'$rights')";

        if($this->link->exec($sql)){
            return true;
        }
        else {
            die(print_r($this->link->errorInfo(), true));
            return false;
        }
    }

    function userExists($login){
        if(!$this->link){
            return false;
        }
        $sql = "SELECT login, password, salt, iterations, rights FROM user WHERE login LIKE '$login'";
        $query = $this->link->query($sql, PDO::FETCH_ASSOC);
        $result = $query->fetch();
            if ($result['login'])
                return $result;
        return false;
    }

    function logOut(){
        session_destroy();
        header("Location: http://".$_SERVER['HTTP_HOST']."/login.php");
        exit;
    }
}