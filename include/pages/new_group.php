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
            <td>Группа:  </td><td><input type="text" name="group"><br></td>
        </tr>
        <tr>
            <td>Факультет:</td><td><input type="text" name="department"><br></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Создать" id="create" class="">
    <br><br>
<?
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $group = clearInt($_POST['group']);
    $department = clearStr($_POST['department']);
    if($group && $department){
        try {
            $link = Connect::getInstance()->getLink();
            $query = $link->prepare("INSERT INTO session.group (`group`, department)
    VALUES (?, ?)");
            $query->execute(array($group, $department));
            echo "Новая группа успешно добавлена";
        }catch (PDOException $e){
            echo "Error: ".$e;
        }
    } else echo "Заполните все поля!";
}
?>
</form>