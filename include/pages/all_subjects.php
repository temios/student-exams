<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 31.05.2016
 * Time: 0:07
 */
try {
    $link = Connect::getInstance()->getLink();
    $query = $link->prepare('SELECT name
FROM subject');
    $query->execute();
    $subjects = $query->fetchAll();
    if (is_array($subjects) && (count($subjects) != 0)) {
        $stack = "<table class='col-md-9 result-table'><thead><tr><td class='col-md-8'>Предметы: </td>
        <td class='col-md-1'></td></tr></thead>";
        foreach ($subjects as $subject) {
            $stack .= "<tr>
        <td class='col-md-8'>".mb_ucfirst($subject['name'])."</td>
        <td class='col-md-1'></td></tr>";
        }
        $stack .= "</table>";
        echo $stack;
    } else echo "В данный момент информация о предметах недоступна";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}