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
        <li><a href="/index.php?page=all_groups"><input type="submit" class="btn" value="Все группы"></a></li>
<?
if($_SESSION['login'] == 1) echo '<li><a href="/index.php?page=new_group"><input type="submit" class="btn" value="Новая группа"></a></li>'
    ?>
    </ul>
</div>