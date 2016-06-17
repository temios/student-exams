<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 29.05.2016
 * Time: 1:46
 */
?>

    <div class="col-md-9 sub-menu">
        <ul>
            <li><a href="/index.php?page=all_subjects"><input type="submit" class="btn" value="Все предметы"></a></li>
<?
if($_SESSION['login'] == 1) echo '<li><a href="/index.php?page=new_subject"><input type="submit" class="btn" value="Новый предмет"></a></li>'
    ?>
        </ul>
    </div>