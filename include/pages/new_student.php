<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 31.05.2016
 * Time: 0:05
 */
if($_SESSION['login'] != 1) header("Location: http://".$_SERVER['HTTP_HOST']);
?>
<form method="post" id="new_row" class='col-md-9'>
    <table class="new-row">
        <tr>
            <td>Зачетная книжка:  </td><td><input type="text" name="record_book"><br></td>
        </tr>
        <tr>
            <td>Группа:</td><td><input type="text" name="group"><br></td>
        </tr>
        <tr>
            <td>Фамилия:</td><td><input type="text" name="second_name"><br></td>
        </tr>
        <tr>
            <td>Имя:</td><td><input type="text" name="first_name"><br></td>
        </tr>
        <tr>
            <td>Отчество:</td><td><input type="text" name="patronymic"><br></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Создать" id="create" class="">
    <br><br>
<?
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $record_book = clearInt($_POST['record_book']);
    $group = clearInt($_POST['group']);
    $first_name = clearStr($_POST['first_name']);
    $second_name = clearStr($_POST['second_name']);
    $patronymic = clearStr($_POST['patronymic']);
    if($record_book && $group && $first_name && $second_name && $patronymic){
        try {
            $link = Connect::getInstance()->getLink();
            $query = $link->prepare("INSERT INTO student (record_book, `group`, first_name, second_name, patronymic)
    VALUES (?, ?, ?, ?, ?)");
            $query->execute(array($record_book, $group, $first_name, $second_name, $patronymic));
            echo "Новый студент успешно добавлен";
        }catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    } else echo "Заполните все поля!";
}
?>
</form>
