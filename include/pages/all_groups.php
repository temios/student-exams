<?
try {
$link = Connect::getInstance()->getLink();
$query = $link->prepare('SELECT `group`, department
FROM session.group');
$query->execute();
$groups = $query->fetchAll();
if (is_array($groups) && (count($groups) != 0)) {
$stack = "<table class='col-md-9 result-table'><thead><tr><td class='col-md-4'>№ группы</td>
        <td class='col-md-4'>Факультет</td>
        <td class='col-md-1'></td></tr></thead>";
    foreach ($groups as $group) {
    $stack .= "<tr><td class='col-md-4'>$group[group]</td>
        <td class='col-md-4'>".mb_ucfirst($group['department'])."</td>
        <td class='col-md-1'></td></tr>";
    }
    $stack .= "</table>";
echo $stack;
} else echo "В данный момент информация о группах недоступна";
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}