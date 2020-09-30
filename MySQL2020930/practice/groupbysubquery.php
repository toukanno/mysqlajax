<?php
require_once("func/header.php");



$pdo = new PDO('mysql:host=localhost;dbname=masayoshi_db;', 'hoge', 'moke',  array(
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

foreach ($pdo->query('SELECT text_id, reply_id, comment, datetime FROM t_text WHERE reply_id = 0 AND comment IS NOT NULL  ORDER BY datetime DESC') as $row) {
  echo "<tr>";
  echo "<td>" . $row['comment'] . "</td>";
  echo "<td>" . $row['datetime'] . "</td>";
  echo "</tr>";
  $reply_id = $row['text_id'];
  // echo $reply_id;

  foreach ($pdo->query(' SELECT
  text_id, reply_id, comment, datetime
FROM
  t_text
WHERE
  reply_id = (SELECT text_id FROM t_text) ORDER BY datetime DESC') as $row2) {
    echo "<tr>";
    echo "<td>" . $row2['comment'] . "</td>";
    echo "<td>" . $row2['datetime'] . "</td>";
    echo "</tr>";

  }
}
echo '</table>';
