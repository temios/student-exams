<?
try {
$link = Connect::getInstance()->getLink();
$query = $link->prepare('SELECT register_number, c.control_name, s.name,
 p.first_name, p.second_name, p.patronymic, r.document_name, r.date
FROM session.register AS r
INNER JOIN session.control AS c ON c.id = r.control_id
INNER JOIN session.subject AS s ON s.id = r.subject_id
INNER JOIN session.professor AS p ON p.id = r.professor_id
ORDER BY `date`');
$query->execute();
$registers = $query->fetchAll();
    $stack = "<div class='col-md-9'>";
if (is_array($registers) && (count($registers) != 0)) {
    foreach($registers as $register) {
        $stack .= "<h3>" . mb_ucfirst($register['document_name']) . ": $register[register_number]</h3>
        <h4>Преподаватель: " . mb_ucfirst($register['second_name']) . " " .
            mb_ucfirst($register['first_name']) . " " . mb_ucfirst($register['patronymic']) . "</h4>
            <h4>Предмет: " . mb_ucfirst($register['name']) . "</h4>";

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
        <td class='col-md-1'></td></tr>";
            }
        }
        $stack .= "</table>";
    }
    $stack .= "</div>";
echo $stack;
} else echo "В данный момент информация о ведомостях недоступна";
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}