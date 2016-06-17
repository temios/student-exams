<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 31.05.2016
 * Time: 0:04
 */
try {
    $link = Connect::getInstance()->getLink();
    $query = $link->prepare('SELECT record_book, `group`, first_name, second_name, patronymic
    FROM student');
    $query->execute();
    $students = $query->fetchAll();
    if (is_array($students) && (count($students) != 0)) {
        $stack = "<table class='col-md-9 result-table'><thead><tr><td class='col-md-1'>№ зачетной книжки</td>
                <td class='col-md-2'>Фамилия</td><td class='col-md-2'>Имя</td><td class='col-md-3'>Отчество</td>
                <td class='col-md-1'></td></tr></thead>";
        foreach ($students as $student) {
            $stack .= "<tr><td class='col-md-1'>$student[record_book]</td>
                <td class='col-md-2'>".mb_ucfirst($student['second_name'])."</td><td class='col-md-2'>".mb_ucfirst($student['first_name'])."</td>
                <td class='col-md-3'>".mb_ucfirst($student['patronymic'])."</td>
                <td class='col-md-1'></td></tr>";
        }
        $stack .= "</table>";
        echo $stack;
    } else echo "В данный момент информация о студентах недоступна";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}