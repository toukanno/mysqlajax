<?php
if (!isset($_POST['text_id'])) {
  echo "ボタンが押されていません";
  header('Location: top.php');
  exit;
}
$dbh =  new PDO('mysql:host=localhost;dbname=masayoshi_db;', 'hoge', 'moke',  array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
)); //MySQLのデータベースに接続
$text_id = $_POST['text_id'];
$comment = $_POST['comment'];
echo $comment;
$datetime = date('Y-m-d h:m:s');
echo $datetime;
$sql = 'UPDATE t_text SET `comment` = "'.$comment.'", `datetime`="'.$datetime.'" WHERE text_id = "'.$text_id.'"';
print_r($sql);
//queryでSQL文を実行する
$dbh->query($sql);


?>
<meta http-equiv="refresh" content="1;URL=top.php">
コメントを変更しました。