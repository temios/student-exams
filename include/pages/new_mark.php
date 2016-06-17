<?php
/**
 * Created by PhpStorm.
 * User: driln
 * Date: 01.06.2016
 * Time: 23:53
 */
if($_SESSION['login'] > 2) header("Location: http://".$_SERVER['HTTP_HOST']);
$link = Connect::getInstance()->getLink();

?>
<form method="post" id="new_row"">
    <table class="new-row">
        <tr>
            <td>Номер ведомости:  </td><td><input type="text" name="register_number"><br></td>
        </tr>
        <tr>
            <td>Номер зачетки:  </td><td><input type="text" name="record_book"><br></td>
        </tr>
        <tr>
            <td>Оценка: </td><td><select size="1" name="mark">
                    <option value='Отлично'>Отлично</option>
                    <option value='Хорошо'>Хорошо</option>
                    <option value='Удовлетворительно'>Удовлетворительно</option>
                    <option value='Неудовлетворительно'>Неудовлетворительно</option>
                    <option value='Зачет'>Зачет</option>
                    <option value='Не зачет'>Не зачет</option>
                    <option value='Не явился'>Не явился</option>
                </select><br></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Поставить" id="create" class="">
    <br><br>
    <?
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $register_number = clearInt($_POST['register_number']);
        $record_book = clearInt($_POST['record_book']);
        $mark = clearStr($_POST['mark']);
        if($register_number && $record_book && $mark){
            try {
                $query = $link->prepare("INSERT INTO mark (register_id, record_book_id, mark)
    VALUES (?, ?, ?)");
                $query->execute(array($register_number, $record_book, $mark));
                echo "Оценка успешно поставлена";
            }catch (PDOException $e){
                echo "Error: ".$e;
            }
        } else echo "Заполните все поля!";
    }
    ?>
</form>