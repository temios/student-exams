<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 17.11.2015
 * Time: 17:18
 */
session_start();
ob_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-type: text/html; charset=utf-8');
header("Expires: " . date("r"));
header("HTTP/1.0 401 Unauthorized");
require_once("secure/secure.php");

include "secure/form.html";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $auth = new Auth();
    $ref = strip_tags(trim($_GET['ref']));
    $user = strip_tags(trim($_POST['login']));
    $pass = strip_tags(trim($_POST['pass']));
    if(!$ref) $ref = "http://".$_SERVER['HTTP_HOST']."/index.php";
    if($user and $pass){
        if($result = $auth->userExists($user)){
            $login = $result['login'];
            $password = $result['password'];
            $salt = $result['salt'];
            $iteration = $result['iterations'];
            $rights = intval($result['rights']);
            if($auth->getHash($pass, $salt, $iteration) == $password){
                if($rights){
                    $_SESSION['login'] = $rights;
                }
                header("Location:$ref");
                exit;
            }
            else echo "Неправильный логин или пароль!";
        }
        else echo "Неправильный логин или пароль!";
    }
    else echo "Заполните все поля!";
}
include "secure/form_end.html";



