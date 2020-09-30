<?php

/**データベースに接続 */
$dbh =  new PDO('mysql:host=localhost;dbname=masayoshi_db;', 'hoge', 'moke',  array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));
//このページでechoしたものがhtmlに返されて出力される
header("Content-type: text/plain; charaset=UTF-8");

//Ajaxによるリクエストかどうかの識別を行う
//strtolower()を付けるのは,XMLHttpRequestやxmlHttpRequestで返ってくる場合があるため
// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  if(isset($_POST['reqest'])){
    
    //text_id(int型)で検索するためint以外を弾く
    $requestid= (int)filter_input(INPUT_POST, 'request');
    // $request= (int)filter_input(INPUT_POST, 'request');
    
    $requestid= $_POST['data'];
    echo $_POST['data'];
    $result = $dbh->query('SELECT * FROM t_text WHERE text_id = "'.$requestid.'"');
    // $result = $dbh->query('SELECT * FROM t_text');
    foreach($result as $row){
      // echo $row['comment'];
      // echo $row['datetime'];
      $String = $row['comment'];
      $String .=$row['datetime'];
    }
  // }else{
    //デバック用 データがなかった時にSQLを出力する
    // echo $reslt;
    echo $String;
  }
  // echo "test";
// }else{
//   echo 'The parameter of "request" is not found.';
// }
