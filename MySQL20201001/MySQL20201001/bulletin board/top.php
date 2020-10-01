<!DOCTYPE html>
<html lang="ja">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿フォーム</title>
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script>
    function send(data) {
      console.log(data);
      var senddata = {
        request: data
      };
      console.log(data);
      $.ajax({
        type: "POST",
        url: "send.php",
        data: senddata

      }).done(function(data) {
        // var result = $(data).find('.comment, .datetime');
        console.log(data);
        // console.log(result);
        // console.log(result[0]);
        // console.log(result[1]);

        // $('#comment').html(result[0]);
        // $('#datetime').html(result[1]);
        // $('#table').append(data);
        $('#thead-light').html(data);
        // $('#sendvalue').append(result[0]);
        // $('#sendvalue').append(result[1]);
        // $('#datetime').append(result[1]);
      }).fail(function() {
        alert("error");
      });

    }
    
  </script>

</head>

<body>
  <div class="row">
    <form action="comment_insert_done.php" method="post">
      <input type="text" name="comment">
      <input type="submit" value="送信">
    </form>
  </div>

  <table class='table' id="table">
    
    
  </table>
  <?php

  require_once("func/header.php");

  define('DB_HOST', 'localhost');
  define('DB_NAME', 'masayoshi_db');
  define('DB_USER', 'hoge');
  define('DB_PASSWORD', 'moke');
  // 文字化け対策
  // $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'");
  $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
  $pdo = new PDO('mysql:host=localhost;dbname=masayoshi_db;', 'hoge', 'moke',  array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
  ));
  echo "<table class='table'>
<thead class='thead-light'>
  <tr>
  <th>コメント</th>
  <th>投稿日時</th>
  <th></th>
  <th></th>
  <th></th>
  <th></th>
  </tr>
</thead>
";
  $result = $pdo->query('SELECT * FROM t_text WHERE reply_parent_id = 0 AND deleteflg = 0 AND comment IS NOT NULL  ORDER BY datetime DESC');

  $send = "";
  foreach ($result as $row) {

    $sendid = $row['text_id'];
 
    echo "<tr>";
    echo "<td>" . $row['comment'] . "</td>";
    echo "<td>" . $row['datetime'] . "</td>";
    echo '<td>';
    echo '<form action="comment_change.php" method="post">';
    echo '  <input type="hidden" value="' . $row['text_id'] . '" name= "text_id">';
    echo '  <input type="hidden" value="' . $row['comment'] . '" name= "comment">';
    echo '  <input type="submit" class="btn btn-success" value="変更" >';
    echo "</form>";
    echo "</td>";
    echo '<td>';
    echo '<form action="comment_delete_done.php" method="post" onClick="return confirm(\'削除しますか？\');">';
    echo '  <input type="hidden" value="' . $row['text_id'] . '" name= "text_id">';
    echo '<input type="submit" class="btn btn-danger" value="削除" >';
    echo "</form>";
    echo "</td>";
    echo '<td>';
    echo '<form action="reply.php" method="post" onClick="return confirm(\'返信しますか？\');">';
    echo '  <input type="hidden" value="' . $row['text_id'] . '" name= "text_id">';
    echo '  <input type="hidden" value="' . $row['reply_parent_id'] . '" name= "reply_parent_id">';
    echo '  <input type="hidden" value="' . $row['user_id'] . '" name= "user_id">';
    echo '<input type="hidden" value = "' . $row['comment'] . '" name= "comment">';
    echo '<input type="submit" class="btn  btn-secondary" value="返信" >';
    echo "</form>";
    echo "</td>";
    echo '<td>';
    echo '<form  method="post" onClick="return confirm(\'情報を表示しますか？\');">';
    echo '  <input type="hidden" value="' . $row['text_id'] . '" name= "text_id" id = "request">';
    // echo '<input type="button" class="btn btn-info" value= "' . $send . '"id = "' . $send . '" name = "info"  onClick="send(' . $sendid . ')">';
    // echo '<script type="text/javascript">';
    echo '<input type="button" class="btn btn-info" value= "情報" name = "info" data-val = "内容"  onClick="send(' . $sendid . ')">';
    // echo "</script>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    $reply_id = $row['text_id'];
    // $reply_id = $row['reply_parent_id'];
    $result2 = $pdo->query('SELECT * FROM t_text WHERE reply_parent_id = "' . $reply_id . '" AND deleteflg = 0 AND comment IS NOT NULL ORDER BY datetime DESC');

    foreach ($result2 as $row2) {
      // print_r($row2['text_id']);
      echo "<tr>";
      echo "<td>" . $row2['comment'] . "</td>";
      echo "<td>" . $row2['datetime'] . "</td>";
      echo '<td>';
      echo '<form action="comment_change.php" method="post">';
      echo '  <input type="hidden" value="' . $row2['text_id'] . '" name= "text_id">';
      echo '  <input type="hidden" value="' . $row2['comment'] . '" name= "comment">';
      echo '<input type="submit" class="btn btn-success" value="変更" >';
      echo "</form>";
      echo "</td>";
      echo '<td>';
      echo '<form action="comment_delete_done.php" method="post" onClick="return confirm(\'削除しますか？\');">';
      echo '  <input type="hidden" value="' . $row2['text_id'] . '" name= "text_id">';
      echo '<input type="submit" class="btn btn-danger" value="削除" >';
      echo "</form>";
      echo "</td>";
      echo '<td>';
      // print_r($row2['text_id']);
      echo '<form action="reply.php" method="post" onClick="return confirm(\'返信しますか？\');">';
      echo '  <input type="hidden" value="' . $row2['text_id'] . '" name= "text_id">';
      echo '  <input type="hidden" value="' . $row2['reply_parent_id'] . '" name= "reply_parent_id">';
      echo '  <input type="hidden" value="' . $row2['user_id'] . '" name= "user_id">';
      echo '<input type="hidden" value = "' . $row2['comment'] . '" name= "comment">';
      echo '<input type="submit" class="btn  btn-secondary" value="返信" >';
      echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
  }
  echo '</table>';
  ?>

</body>

</html>