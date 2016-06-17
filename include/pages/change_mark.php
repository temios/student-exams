<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 03.06.2016
 * Time: 2:40
 */
if($_SESSION['login'] > 2) header("Location: http://".$_SERVER['HTTP_HOST']);
$link = Connect::getInstance()->getLink();
$register_number = (int)$_GET['register_id'];
$record_book = (int)$_GET['record_book_id'];
?>
<form method="post" id="new_row"">
<table class="new-row">
    <tr>
        <td>Номер ведомости:  </td><td><input type="text" name="register_number" value="<?=$register_number?>"><br></td>
    </tr>
    <tr>
        <td>Номер зачетки:  </td><td><input type="text" name="record_book" value="<?=$record_book?>"><br></td>
    </tr>
    <tr>
        <td>Оценка: </td><td><select size="1" name="mark">
                <option value='Отлично'>Отлично</option>
                <option value='Хорошо'>Хорошо</option>
                <option value='Удовлетворительно'>Удовлетворительно</option>
                <option value='Неудовлетворительно'>Неудовлетворительно</option>
                <option value='Зачет'>Зачет</option>
                <option value='Не зачет'>Не зачет</option>
            </select><br></td>
    </tr>
</table>
<input type="submit" name="submit" value="Поставить" id="create" class="">
<br><br>
</form>
<?
    if($_POST['submit'])
    {
        $register_number = clearInt($_POST['register_number']);
        $record_book = clearInt($_POST['record_book']);
        $mark = clearStr($_POST['mark']);
        if($register_number && $record_book && $mark){
            try {
                $query = $link->prepare("UPDATE mark SET mark = ?
    WHERE register_id = ? AND record_book_id = ?");
                $query->execute(array($mark, $register_number, $record_book));
                echo "Оценка успешно поставлена";
            }catch (PDOException $e){
                echo "Error: ".$e;
            }
        } else echo "Заполните все поля!";
    }
    ?>