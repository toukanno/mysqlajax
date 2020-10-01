<?php

/**データベースに接続 */
$dbh =  new PDO('mysql:host=localhost;dbname=name_db;', 'fuku', 'huku',  array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));
//このページでechoしたものがhtmlに返されて出力される
header("Content-type: text/plain; charaset=UTF-8");

if (isset($_POST['request'])) {

  //text_id(int型)で検索するためint以外を弾く
  $requestid = (int)filter_input(INPUT_POST, 'request');
 
  echo "<table class='table'>
  <thead class='thead-light'>
    <tr>
    <th>コメント</th>
    <th>投稿日時</th>
    </tr>
  </thead>
  ";
  $result = $dbh->query('SELECT * FROM t_text WHERE text_id = "' . $requestid . '" ORDER BY datetime DESC');

  foreach ($result as $row) {
    echo '<tr id="wrap">';
    echo '<td class = "comment">' . $row['comment'] . '</td>';
    echo '<td class = "datetime">' . $row['datetime'] . '</td>';
    echo '</tr>';
  }
  $result2 = $dbh->query('SELECT * FROM t_text WHERE reply_parent_id = "' . $requestid . '" ORDER BY datetime DESC');

  foreach ($result2 as $row2) {

    echo '<tr id="wrap">';
    echo '<td class = "comment">' . $row2['comment'] . '</td>';
    echo '<td class = "datetime">' . $row2['datetime'] . '</td>';
    echo '</tr>';
  }
}
echo '</table>';
