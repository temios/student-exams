<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 25.02.2016
 * Time: 13:34
 */
session_start();
ob_start();
require_once "secure/session.php";
require_once "secure/secure.php";
require_once "classes/Page.php";
require_once "classes/Connect.php";
require_once "classes/constants.php";
require_once "classes/functions_lib.php";


$auth = new Auth();
if(isset($_GET['logout'])) $auth->logOut();
$get_page = $_GET['page'];
$query_page = new Page;
$page = $query_page->pageset($get_page);
setlocale(LC_ALL, 'ru_RU.utf8');
Header("Content-Type: text/html;charset=UTF-8");

include "include/header.php";
include "include/menu.php";
include "include/".$page;
include "include/footer.php";