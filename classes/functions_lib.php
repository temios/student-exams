<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 22.02.2016
 * Time: 22:06
 */


//
function myVarDump($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

//Открытие соединения

//Приведение к целому положительному
function clearInt($int)
{
    return abs((int)$int);
}

//Приведение к строке без тэгов, пробелов в начале
function clearStr($str)
{
    return mb_strtolower(trim(strip_tags($str)), 'UTF-8');  //strtolower ломает русскую кодировку
}


//Отрисовка меню из передаваемого массива
function draw_menu($menu, $vertical = true)
{
    global $menuTemp;
    if ($vertical) {
        $menuStyle = 'display:block';
    } else $menuStyle = 'display:inline-block';
    $menuTemp = "<ul class='main-menu clearfix'>";
    if (is_array($menu)) {
        foreach ($menu as $menuEl) {
            $menuTemp .= "<li style=" . $menuStyle . "><a href=" . $menuEl['href'] . " class=\"a-main-menu\">" . $menuEl['link'] . "</a></li>";
        }
    } else $menuTemp .= "Что-то пошло не так";
    $menuTemp .= "</ul>";
    echo $menuTemp;

    function mb_ucfirst($word)
    {
        return mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr(mb_convert_case($word, MB_CASE_LOWER, 'UTF-8'), 1, mb_strlen($word), 'UTF-8');
    }
}

function pushToSearch($element, $name, &$query_str, &$query_arr, &$count)
{

    if ($element) {
        if ($count != 0) {
            $query_str .= " AND ";
        }
        if(is_string($element)) {
            $query_str .= "`$name` LIKE ?";
        }else $query_str .= "`$name` = ?";
        array_push($query_arr, $element);
        $count++;
    }
}