<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 31.05.2016
 * Time: 0:04
 */
?>
    <form method="post" id="new_row" class='col-md-9'>
        <table class="new-row">
            <tr>
                <td>Зачетная книжка:</td>
                <td><input type="text" name="record_book"><br></td>
            </tr>
            <tr>
                <td>Группа:</td>
                <td><input type="text" name="group"><br></td>
            </tr>
            <tr>
                <td>Фамилия:</td>
                <td><input type="text" name="second_name"><br></td>
            </tr>
            <tr>
                <td>Имя:</td>
                <td><input type="text" name="first_name"><br></td>
            </tr>
            <tr>
                <td>Отчество:</td>
                <td><input type="text" name="patronymic"><br></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Искать" id="create" class="">
        <br><br>
    </form>
<?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $record_book = clearInt($_POST['record_book']);
    $group = clearInt($_POST['group']);
    $first_name = clearStr($_POST['first_name']);
    $second_name = clearStr($_POST['second_name']);
    $patronymic = clearStr($_POST['patronymic']);
    $count = 0;
    $query_arr = array();
    $query_str = "";
    $val = "";
    $students = 0;
    pushToSearch($record_book, "record_book", $query_str, $query_arr, $count);
    pushToSearch($group, "group", $query_str, $query_arr, $count);
    pushToSearch($first_name, "first_name", $query_str, $query_arr, $count);
    pushToSearch($second_name, "second_name", $query_str, $query_arr, $count);
    pushToSearch($patronymic, "patronymic", $query_str, $query_arr, $count);
    for ($i = 0; $i < $count; $i++) {
        if ($val) {
            $val .= ", ";
        }
        $val .= "?";
    }
    try {
        $link = Connect::getInstance()->getLink();
        $query = $link->prepare("SELECT * FROM student WHERE $query_str ORDER BY second_name");
        $query->execute($query_arr);
        $students = $query->fetchAll();
        echo "</form>";
        if (is_array($students) && (count($students) != 0)) {
            foreach ($students as $student) {
                $stack .= "<div class='row'><div class='col-md-12'><h4 class='col-md-4 col-md-push-2'>Номер зачетной книжки: " . $student['record_book'] . "<br><br>Студент: " . mb_ucfirst($student['second_name']) . " " .
                    mb_ucfirst($student['first_name']) . " " . mb_ucfirst($student['patronymic']) . "</h4>";
                $query = $link->prepare("SELECT m.mark, s.name
  FROM mark as m
  INNER JOIN register as r ON r.register_number = m.register_id
  INNER JOIN subject as s ON s.id = r.subject_id
  WHERE m.record_book_id = ?");
                $query->execute(array($student['record_book']));
                $marks = $query->fetchAll();
                $stack .= "<table class='result-table col-md-push-1 col-md-10'><thead><tr><td class='col-md-5'>Предмет</td>
        <td class='col-md-5'>Оценка</td></tr></thead>";
                foreach($marks as $mark){
                    $stack .= "<tr><td class='col-md-5'>".mb_ucfirst($mark['name'])."</td>
        <td class='col-md-5'>".mb_ucfirst($mark['mark'])."</td></tr>";
                }
                $stack .= "</table></div></div>";
            }
            echo $stack;
        } else echo "Студент не найден";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
?>