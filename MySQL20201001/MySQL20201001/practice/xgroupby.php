<?php
require_once("func/header.php");



$pdo = new PDO('mysql:host=localhost;dbname=name_db;', 'fuku', 'huku',  array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));
echo "<table class='table'>
<thead class='thead-light'>
  <tr>
  <th>コメント</th>
  <th>日付</th>
  </tr>
</thead>
";
$result = $pdo->query('SELECT `text_id`, `comment`, `datetime` FROM t_text WHERE reply_parent_id = 0 AND comment IS NOT NULL  ORDER BY datetime DESC');
// print_r($result);
var_dump($pdo->errorCode());
var_dump($pdo->errorInfo());

foreach ($result as $row) {
  // print_r($row);
  echo "<tr>";
  echo "<td>" . $row['comment'] . "</td>";
  echo "<td>" . $row['datetime'] . "</td>";
  echo "</tr>";
  $reply_id = $row['text_id'];

  $result2 = $pdo->query('SELECT `comment`, `datetime` FROM t_text WHERE reply_parent_id = "' . $reply_id . '" AND comment IS NOT NULL ORDER BY datetime DESC');

  foreach ($result2 as $row2) {
    echo "<tr>";
    echo "<td>" . $row2['comment'] . "</td>";
    echo "<td>" . $row2['datetime'] . "</td>";
    echo "</tr>";
  }
}
echo '</table>';
