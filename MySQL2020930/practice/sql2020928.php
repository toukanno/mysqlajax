<?php
require_once("func/header.php");



$pdo = new PDO('mysql:host=localhost;dbname=masayoshi_db;', 'hoge', 'moke',  array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));
echo "<table class='table'>
<thead class='thead-light'>
  <tr>
  <th>番号</th>
  <th>ユーザー名</th>
  <th>ログインID</th>
  <th>パスワード</th>
  </tr>
</thead>
";

foreach ($pdo->query('SELECT * FROM t_user') as $row) {
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['login_id'] . "</td>";
  echo "<td>" . $row['password'] . "</td>";
  echo "</tr>";
  // echo "<tr>";
  // echo "<th>コメント</th>";
  // echo "<th></th>";
  // echo "<th>日付</th>";
  // echo "<th></th>";
  // echo "</tr>";
  // echo "<tr>";
  $id = $row['id'];
  // echo $id;
  foreach ($pdo->query('SELECT user_id,comment,datetime FROM t_text WHERE user_id ="' . $id . '"  AND comment IS NOT NULL') as $row2) {
    
    echo "<tr>";
    echo "<thead class='thead-light'>";
    echo "<th>コメント</th>";
    echo "<th></th>";
    echo "<th>日付</th>";
    echo "<th></th>";
    echo "</thead>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $row2['comment'] . "</td>";
    echo "<td></td>";
    echo "<td>" . $row2['datetime'] . "</td>";
    echo "<td></td>";
    echo "</tr>";
    echo $row2['user_id'];
    // echo $row2['user_id'];
  }
  echo "</tr>";
}
echo '</table>';
