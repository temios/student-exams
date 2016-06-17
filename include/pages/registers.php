<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 29.05.2016
 * Time: 1:47
 */
if($_SESSION['login'] > 2) header("Location: http://".$_SERVER['HTTP_HOST']);
?>
<div class="col-md-9 sub-menu">
    <ul>
        <li><a href="/index.php?page=all_registers"><input type="submit" class="btn" value="Все ведомости"></a></li>
        <li><a href="/index.php?page=find_register"><input type="submit" class="btn" value="Поиск ведомости"></a></li>
        <li><a href="/index.php?page=new_register"><input type="submit" class="btn" value="Новая ведомость"></a></li>
        <li><a href="/index.php?page=new_mark"><input type="submit" class="btn" value="Поставить оценку"></a></li>
    </ul>
</div>