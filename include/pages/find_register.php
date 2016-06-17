<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 31.05.2016
 * Time: 0:07
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
            <td>Номер ведомости:</td>
            <td><input type="text" name="register_number"><br></td>
        </tr>
        <tr>
            <td>Форма контроля:</td>
            <td><select size="1" name="control_id">
                    <?
                    foreach ($controls as $control) {
                        echo "<option value='$control[id]'>$control[control_name]</option>";
                    }
                    ?>
                </select><br></td>
        </tr>
        <tr>
            <td>Предмет:</td>
            <td><select size="1" name="subject_id">
                    <?
                    foreach ($subjects as $subject) {
                        echo "<option value='$subject[id]'>" . mb_ucfirst($subject[name]) . "</option>";
                    }
                    ?>
                </select><br></td>
        </tr>
        <tr>
            <td>Преподаватель:</td>
            <td><select size="1" name="professor_id">
                    <?
                    foreach ($professors as $professor) {
                        echo "<option value='$professor[id]'>"
                            . mb_ucfirst($professor['second_name']) . " "
                            . mb_ucfirst($professor['first_name']) . " "
                            . mb_ucfirst($professor['patronymic'])
                            . "</option>";
                    }
                    ?>
                </select><br></td>
        </tr>
        <tr>
            <td>Наименование документа:</td>
            <td><input type="text" name="document_name"><br></td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Поиск" id="create" class="">
    <br><br>
<?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $register_number = clearInt($_POST['register_number']);
    $control_id = clearInt($_POST['control_id']);
    $subject_id = clearInt($_POST['subject_id']);
    $professor_id = clearInt($_POST['professor_id']);
    $document_name = clearStr($_POST['document_name']);
    $count = 0;
    $query_arr = array();
    $query_str = "";
    $val = "";
    $registers = 0;
    pushToSearch($register_number, "register_number", $query_str, $query_arr, $count);
    pushToSearch($control_id, "control_id", $query_str, $query_arr, $count);
    pushToSearch($subject_id, "subject_id", $query_str, $query_arr, $count);
    pushToSearch($professor_id, "professor_id", $query_str, $query_arr, $count);
    pushToSearch($document_name, "document_name", $query_str, $query_arr, $count);
    for ($i = 0; $i < $count; $i++) {
        if ($val) {
            $val .= ", ";
        }
        $val .= "?";
    }
    try {
        $link = Connect::getInstance()->getLink();
        $query = $link->prepare("SELECT register_number, c.control_name, s.name, p.first_name, p.second_name, p.patronymic, r.document_name, r.date
FROM session.register AS r
INNER JOIN session.control AS c ON c.id = r.control_id
INNER JOIN session.subject AS s ON s.id = r.subject_id
INNER JOIN session.professor AS p ON p.id = r.professor_id
WHERE $query_str
ORDER BY `date`");
        $query->execute($query_arr);
        $registers = $query->fetchAll();
        echo "</form>";
        if (is_array($registers) && (count($registers) != 0)) {
            foreach ($registers as $register) {
                $stack .= "<div class='col-md-9'><h3>" . mb_ucfirst($register['document_name']) . ": $register[register_number]</h3>
        <h4>Преподаватель: " . mb_ucfirst($register['second_name']) . " " .
                    mb_ucfirst($register['first_name']) . " " . mb_ucfirst($register['patronymic']) . "</h4>
            <h4>Предмет: " . mb_ucfirst($register['name']) . "</h4>";
            }
            $stack .= "<table class='result-table'><thead><tr><td class='col-md-1'>№ зачетной книжки</td>
        <td class='col-md-2'>Фамилия</td><td class='col-md-2'>Имя</td><td class='col-md-2'>Отчество</td>
        <td class='col-md-1'>Оценка</td><td class='col-md-1'></td></tr></thead>";
            $query = $link->prepare("SELECT m.register_id, m.record_book_id, m.mark, s.first_name, s.second_name, s.patronymic
FROM mark as m
INNER JOIN student AS s ON s.record_book = m.record_book_id
WHERE register_id = $register[register_number]
ORDER BY s.second_name");
            $query->execute();
            $students = $query->fetchAll();
            if (is_array($students) && (count($students) != 0)) {
                foreach ($students as $student) {
                    $stack .= "<tr><td class='col-md-1'>$student[record_book_id]</td>
        <td class='col-md-2'>" . mb_ucfirst($student['second_name']) . "</td><td class='col-md-2'>" . mb_ucfirst($student['first_name']) . "</td>
        <td class='col-md-2'>" . mb_ucfirst($student['patronymic']) . "</td><td class='col-md-1'>" . mb_ucfirst($student['mark']) . "</td>
        <td class='col-md-1'><form class='' method='POST' action='index.php?page=change_mark&record_book_id=" . $student['record_book_id']
                        ."&register_id=".$register['register_number']."'>
        <input type='submit' value='Изменить'></form></td></tr>";
                }
            }
            $stack .= "</table></div>";
            echo $stack;
        } else echo "Ведомость не найдена";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
?>