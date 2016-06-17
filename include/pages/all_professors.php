<?
try {
    $link = Connect::getInstance()->getLink();
    $query = $link->prepare('SELECT first_name, second_name, patronymic
FROM professor');
    $query->execute();
    $professors = $query->fetchAll();
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
    } else echo "В данный момент информация о преподавателях недоступна";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}