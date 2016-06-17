<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 31.05.2016
 * Time: 0:06
 */
?>
    <form method="post" id="new_row" class='col-md-9'>
        <table class="new-row">
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
<?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = clearStr($_POST['first_name']);
    $second_name = clearStr($_POST['second_name']);
    $patronymic = clearStr($_POST['patronymic']);
    $count = 0;
    $query_arr = array();
    $query_str = "";
    $val = "";
    $professors = 0;
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
        $query = $link->prepare("SELECT * FROM professor WHERE $query_str ORDER BY second_name");
        $query->execute($query_arr);
        $professors = $query->fetchAll();
        echo "</form>";
        if (is_array($professors) && (count($professors) != 0)) {
            $stack = "<table class='col-md-9 result-table'><thead><tr>
        <td class='col-md-2'>Фамилия</td><td class='col-md-3'>Имя</td><td class='col-md-3'>Отчество</td>
        <td class='col-md-1'></td></tr></thead>";
            foreach ($professors as $professor) {
                $stack .= "<tr><td class='col-md-2'>" . mb_ucfirst($professor['second_name']) . "</td>
        <td class='col-md-3'>" . mb_ucfirst($professor['first_name']) . "</td>
        <td class='col-md-3'>" . mb_ucfirst($professor['patronymic']) . "</td>
        <td class='col-md-1'></td></tr>";
            }
            $stack .= "</table>";
            echo $stack;
        } else echo "Студент не найден";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
?>