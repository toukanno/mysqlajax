<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿確認</title>
</head>

<body>

</body>

</html>


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
$comment = $_POST['comment'];
echo $comment;
$datetime = date('Y-m-d h:m:s');
echo $datetime;
$sql = 'INSERT INTO t_text (comment, datetime) VALUES("' . $comment . '","' . $datetime . '")';
print_r($sql);
//queryでSQL文を実行する
$dbh->query($sql);
?>
<meta http-equiv="refresh" content="1;URL=top.php">
コメントを投稿しました。