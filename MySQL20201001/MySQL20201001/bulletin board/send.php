<?php

/**データベースに接続 */
$dbh =  new PDO('mysql:host=localhost;dbname=masayoshi_db;', 'hoge', 'moke',  array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));
//このページでechoしたものがhtmlに返されて出力される
header("Content-type: text/plain; charaset=UTF-8");

if (isset($_POST['request'])) {

  //text_id(int型)で検索するためint以外を弾く
  $requestid = (int)filter_input(INPUT_POST, 'request');
  // $comment = array();
  // $datetime = array();
  // $dataarray = array();
  echo '<tr>
  <thead class="thead-light" id="thead-light">
  <th>投稿日時</th>
  <th>コメント</th>
  </thead>
</tr>';
  $result = $dbh->query('SELECT * FROM t_text WHERE text_id = "' . $requestid . '" ORDER BY datetime DESC');

  foreach ($result as $row) {
    // $comment[] = $row['comment'];
    // $datetime[] = $row['datetime'];
    // $comment[] = $row['comment'];
    // $datetime[] = $row['datetime'];
    // $dataarray[] = $comment;
    // $dataarray[] = $datetime;
    echo '<tr id="wrap">';
    echo '<td class = "comment">' . $row['comment'] . '</td>';
    echo '<td class = "datetime">' . $row['datetime'] . '</td>';
    echo '</tr>';
  }
  $result2 = $dbh->query('SELECT * FROM t_text WHERE reply_parent_id = "' . $requestid . '" ORDER BY datetime DESC');

  foreach ($result2 as $row2) {
    // $comment[] = $row2['comment'];
    // $datetime[] = $row2['datetime'];
    
    // $dataarray[] = {$com =>$comment, $date => $datetime};
    // $dataarray[] = $datetime;
    echo '<tr id="wrap">';
    echo '<td class = "comment">' . $row2['comment'] . '</td>';
    echo '<td class = "datetime">' . $row2['datetime'] . '</td>';
    echo '</tr>';
  }


  
  // foreach ($dataarray as $key => $val) {
  // foreach ($comment as $key => $val) {
    
  //   echo '<tr id="wrap">';
  //   echo '<td class = "comment">' . $val . '</td>';
  //   echo '<td class = "datetime">' . $val . '</td>';
  //   echo '</tr>';
  
  // }
  

  // echo '<div id="wrap">';
  // echo '<div class = "comment">'.$comment.'</div>';
  // echo '<div class = "datetime">'.$datetime.'</div>';
  // // // echo '<td><div class = "comment">'.$comment.'</div></td>';
  // // // echo '<td><div class = "datetime">'.$datetime.'</div></td>';
  // echo '</div>';

  // echo '<table id="wrap">';
  // echo '<td class = "comment">'.$comment.'</td>';
  // echo '<td class = "datetime">'.$datetime.'</td>';
  // // echo '<td><div class = "comment">'.$comment.'</div></td>';
  // // echo '<td><div class = "datetime">'.$datetime.'</div></td>';
  // echo '</table>';

}
