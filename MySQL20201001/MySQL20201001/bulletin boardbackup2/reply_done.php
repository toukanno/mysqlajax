<?php

require_once("func/header.php");

if (!isset($_POST['comment'])) {
  echo "内容が入力されていません";
  header('Location: top.php');
  exit;
}


//DB名,ユーザ名,パスワード array(オプション)
$dbh =  new PDO('mysql:host=localhost;dbname=masayoshi_db;', 'hoge', 'moke',  array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
)); //MySQLのデータベースに接続

$text_id = $_POST['text_id'];
print_r($text_id);
$reply_parent_id = $_POST['reply_parent_id'];
$comment = $_POST['comment'];
$datetime = date('Y-m-d h:m:s');
if($reply_parent_id == 0) {
  $reply_parent_id = $text_id;
}
print_r($text_id);
$sql = 'INSERT INTO t_text (reply_parent_id,reply_id,comment, datetime) VALUES("' . $reply_parent_id . '","' . $text_id . '","' . $comment . '","' . $datetime . '")';
print_r($sql);
//queryでSQL文を実行する
$dbh->query($sql);
?>
<meta http-equiv="refresh" content="1;URL=top.php">
コメントに返信しました