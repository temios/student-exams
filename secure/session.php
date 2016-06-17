<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 04.03.2016
 * Time: 13:41
 */

session_start();
if(!isset($_SESSION['login'])){
    header("Location: http://".$_SERVER['HTTP_HOST']."/login.php?ref=".$_SERVER['REQUEST_URI']);
    exit;
}