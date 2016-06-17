<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 25.02.2016
 * Time: 16:21
 */
?>
    <div class="col-md-9 sub-menu">
        <ul>
            <li><a href="/index.php?page=all_students"><input type="submit" class="btn" value="Все студенты"></a></li>
            <li><a href="/index.php?page=find_student"><input type="submit" class="btn" value="Поиск студента"></a></li>
            <?
            if($_SESSION['login'] == 1) echo '<li><a href="/index.php?page=new_student"><input type="submit" class="btn" value="Новый студент"></a></li>'
?>
        </ul>
    </div>