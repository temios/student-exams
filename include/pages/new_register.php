<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 31.05.2016
 * Time: 0:08
 */
if($_SESSION['login'] > 2) header("Location: http://".$_SERVER['HTTP_HOST']);
$link = Connect::getInstance()->getLink();
$query = $link->prepare('SELECT id, control_name
FROM control');
$query->execute();
$controls = $query->fetchAll();
$query = $link->prepare('SELECT id, name
FROM subject');
$query->execute();
$subjects = $query->fetchAll();
$query = $link->prepare('SELECT id, first_name, second_name, patronymic
FROM professor');
$query->execute();
$professors = $query->fetchAll();
?>

<form method="post" id="new_row" class='col-md-9'>
    <table class="new-row">
        <tr>
            <td>Номер ведомости:  </td><td><input type="text" name="register_number"><br></td>
        </tr>
        <tr>
            <td>Форма контроля: </td><td><select size="1" name="control_id">
                <?
                foreach ($controls as $control) {
                    echo "<option value='$control[id]'>$control[control_name]</option>";
                }
                ?>
            </select><br></td>
        </tr>
        <tr>
            <td>Предмет: </td><td><select size="1" name="subject_id">
                    <?
                    foreach ($subjects as $subject) {
                        echo "<option value='$subject[id]'>".mb_ucfirst($subject[name])."</option>";
                    }
                    ?>
                </select><br></td>
        </tr>
        <tr>
            <td>Преподаватель: </td><td><select size="1" name="professor_id">
                    <?
                    foreach ($professors as $professor) {
                        echo "<option value='$professor[id]'>"
                            .mb_ucfirst($professor['second_name'])." "
                            .mb_ucfirst($professor['first_name'])." "
                            .mb_ucfirst($professor['patronymic'])
                            ."</option>";
                    }
                    ?>
                </select><br></td>
        </tr>
        <tr>
            <td>Наименование документа: </td><td><input type="text" name="document_name"><br></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Создать" id="create" class="">
    <br><br>
    <?
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $register_number = clearInt($_POST['register_number']);
        $control_id = clearInt($_POST['control_id']);
        $subject_id = clearInt($_POST['subject_id']);
        $professor_id = clearInt($_POST['professor_id']);
        $document_name = clearStr($_POST['document_name']);
        if($register_number && $control_id && $subject_id && $professor_id && $document_name){
            try {
                $query = $link->prepare("INSERT INTO register (register_number, control_id, subject_id, professor_id, document_name, `date`)
    VALUES (?, ?, ?, ?, ?, ?)");
                $date = date("Y-m-d G:i:s", time());
                echo $date;
                $query->execute(array($register_number, $control_id, $subject_id, $professor_id, $document_name, $date));
                echo "Новая ведомость успешно добавлена";
            }catch (PDOException $e){
                echo "Error: ".$e->getMessage();
            }
        } else echo "Заполните все поля!";
    }
    ?>
</form>