<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 31.05.2016
 * Time: 0:07
 */
if($_SESSION['login'] != 1) header("Location: http://".$_SERVER['HTTP_HOST']);
?>
<form method="post" id="new_row">
    <table class="new-row">
        <tr>
            <td>Предмет:  </td><td><input type="text" name="subject"><br></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Создать" id="create" class="">
    <br><br>
    <?
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $subject = clearStr($_POST['subject']);
        if($subject){
            try {
                $link = Connect::getInstance()->getLink();
                $query = $link->prepare("INSERT INTO subject (name)
    VALUES (?)");
                $query->execute(array($subject));
                echo "Новый предмет успешно добавлен";
            }catch (PDOException $e){
                echo "Error: ".$e;
            }
        } else echo "Заполните все поля!";
    }
    ?>
</form>