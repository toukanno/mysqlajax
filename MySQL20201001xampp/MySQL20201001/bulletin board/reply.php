<?php
require_once("func/header.php");
if (!isset($_POST['text_id'])) {
  echo "ボタンが押されていません";
  header('Location: top.php');
  exit;
}
$text_id = $_POST['text_id'];
$reply_parent_id = $_POST['reply_parent_id'];
$user_id = $_POST['user_id'];
$comment = $_POST['comment'];
print_r($text_id);

?>
<!DOCTYPE html>
<title>返信内容</title>

<body>
  <div class="container">
    <h1>返信内容</h1>
    <div class="row">
      <p class="bg-success"><?php echo $text_id . "番目"; ?></ｐ><br>
        <p class="text-light bg-dark"><?php echo $user_id . "さんに返信する"; ?></ｐ><br>
          <p class="bg-info"><?php echo "内容:" . $comment; ?></p><br>
          <form action="reply_done.php" method="post">
            コメント<br>
            <input type="hidden" value="<?php echo $text_id; ?>" name="text_id"><br>
            <input type="hidden" value="<?php echo $reply_parent_id; ?>" name="reply_parent_id"><br>
            <input type="text" name="comment"><br>
            <input type="submit" value="投稿" class="btn  btn-outline-primary"><br>
          </form>
    </div>
  </div>
</body>