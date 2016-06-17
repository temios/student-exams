<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 29.05.2016
 * Time: 1:48
 */
?>
<div class="col-md-9 sub-menu">
    <ul>
        <li><a href="/index.php?page=all_professors"><input type="submit" class="btn" value="Все преподаватели"></a></li>
        <li><a href="/index.php?page=find_professor"><input type="submit" class="btn" value="Поиск преподавателя"></a></li>
<?
if($_SESSION['login'] == 1) echo '<li><a href="/index.php?page=new_professor"><input type="submit" class="btn" value="Новый преподаватель"></a></li>'
    ?>
    </ul>
</div>