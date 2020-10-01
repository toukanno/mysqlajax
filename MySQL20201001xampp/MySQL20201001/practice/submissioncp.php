<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿フォーム</title>
</head>

<body>
  <form action="comment_insert_done.php" method="post">
    <input type="text" name="comment">
    <input type="submit" value="送信">
  </form>
</body>

</html>
<?php
require_once("func/header.php");



$pdo = new PDO('mysql:host=localhost;dbname=masayoshi_db;', 'hoge', 'moke',  array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));
echo "<table class='table'>
<thead class='thead-light'>
  <tr>
  <th>コメント</th>
  <th>投稿日時</th>
  <th></th>
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
  echo '<td>';
  echo '<form action="reply.php" method="post" onClick="return confirm(\'返信しますか？\');">';
  echo '  <input type="hidden" value = "' . $row['comment'] . '" name= "comment">';
  echo '  <input type="submit" class="btn  btn-secondary" value="返信" >';
  echo "</form>";
  echo "</td>";
  echo "</tr>";
  $reply_id = $row['text_id'];

  $result2 = $pdo->query('SELECT `comment`, `datetime` FROM t_text WHERE reply_parent_id = "' . $reply_id . '" AND comment IS NOT NULL ORDER BY datetime DESC');

  foreach ($result2 as $row2) {
    echo "<tr>";
    echo "<td>" . $row2['comment'] . "</td>";
    echo "<td>" . $row2['datetime'] . "</td>";
    echo '<td>';
    echo '<form action="reply.php" method="post" onClick="return confirm(\'返信しますか？\');">';
    echo '  <input type="hidden" value = "' . $row['comment'] . '" name= "comment">';
    echo '  <input type="submit" class="btn  btn-secondary" value="返信" >';
    echo "</form>";
    echo "</td>";
    echo "</tr>";
  }
}
echo '</table>';
?>