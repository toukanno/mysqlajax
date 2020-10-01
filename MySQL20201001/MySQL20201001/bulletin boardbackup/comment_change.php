<?php
require_once("func/header.php");


//テキストidが空だったらtop.phpへ戻す
if (!$_POST['text_id']) {
  header('Location: top.php');
  exit;
}
//DB名,ユーザ名,パスワード array(オプション)
//MySQLのデータベースに接続
print_r($_POST['text_id']);
$text_id = $_POST['text_id'];
print_r($_POST['comment']);
$comment = $_POST['comment'];
?>

<title>コメント編集</title>

<body>

  <div class="container">

    <h1>コメント編集</h1>

    <form action="comment_change_done.php" method="post">
      <input type="text" name="comment" value="<?php echo $comment ?>">
      <input type="hidden" value="<?php echo $text_id; ?>" name="text_id">
      <input type="submit" value="保存" class="btn btn-primary">
    </form>
</body>

</html>