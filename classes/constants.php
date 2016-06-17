<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 22.02.2016
 * Time: 22:08
 */
ob_start();
session_start();
setlocale(LC_ALL, 'ru_RU.utf8');
Header("Content-Type: text/html;charset=UTF-8");


//Текущая дата
$day = strftime('%d');
$month = strftime('%m');
$year = strftime('%Y');


require_once "functions_lib.php";


//Основное меню
$main_menu= array(array("link"=>"Студенты", "href"=>"/index.php?page=students"),
    array("link"=>"Группы", "href"=>"/index.php?page=groups"),
    array("link"=>"Предметы", "href"=>"/index.php?page=subjects"),
    array("link"=>"Преподаватели", "href"=>"/index.php?page=professors"));

if ($_SESSION['login'] < 3) array_push($main_menu, array("link"=>"Ведомости", "href"=>"/index.php?page=registers"));

//Меню каталога



//Заголовок вкладки
switch($get_page){
    case 'main':
        $title = $main_menu[0]['link'];
        break;
    case 'catalog':
        $title = $main_menu[1]['link'];
        break;
    case 'tr_cash':
        $title = $main_menu[2]['link'];
        break;
    case 'contacts':
        $title = $main_menu[3]['link'];
        break;
    default: $title= "Яркий свет";
}
