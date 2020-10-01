<!DOCTYPE html>
<html lang="ja">
<?php
// var_dump($_POST);
// var_dump($_POST['info']);
// $send = $_POST['info'];
$php_test = "test";
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿フォーム</title>
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script>
    var js_test = '<?php echo $php_test; ?>';

    // const a = "#";
    // var send = a.concat(send);
    // console.log(send);
    // console.log("test");
    // console.log(js_test);

    // console.log(send);

    //   //情報ボタンをクリック
    //   console.log("test");

    //   console.log(send);
    //   // $(document).on('click','#' + send, function() {
    //     // var $s = $(`${send}`);
    //     // console.log($s);
    //     $('#'+send).click(function() {
    //       // console.log(send);
    //     console.log("test");
    //     //POSTメソッドで送るデータを定義する
    //     //var data = {パラメータ : 値};
    //     var data = {
    //       request: $('#request').val()
    //     };
    //     // let data =  $('#request').val();
    //     console.log(data);
    //     console.log({
    //       request: $('#request').val()
    //     });
    // var data = $('#text_id').val();
    //     // alert(data);
    //     // console.log(data);
    //     //Ajax通信メソッド
    //     //type:HTTP通信の種類(POSTかGET)
    //     //url:リクエスト送信先のURL
    //     //data:サーバに送信する値
    //     console.log("test");
    //   $.ajax({

    //     type: "POST",
    //     url: "send.php",
    //     data: data,
    //     //Ajax通信が成功した場合に呼び出されるメソッド successは非推奨
    //     success: function(data) {
    //       //デバック用 アラートとコンソール
    //       alert(data);
    //       console.log(data);
    //       //出力する部分
    //       $('#result').html(data);
    //     },
    //     //Ajax通信が失敗した場合に呼び出されるメソッド
    //     // error: function(XMLHttpRequest,textStatus,errorThrown){
    //     //   alert('Error:' + errorThrown);
    //     //   $("#XMLHttpRequest").html("XMLHttpRequest :" + XMLHttpRequest.status);
    //     //   $("#textStatus").html("textStatus :" + textStatus);
    //     //   $("#errorThrown").html("errorThrown :" + errorThrown);
    //     // }
    //     error: function(data) {
    //       alert("error");
    //     },

    //   });
    //   return false;
    // });
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
        // console.log(data1);
        // console.log(data2);
        // console.log(data3);
        // console.log(data4);
        // console.log(data2);
        // console.log(index);
        var result = $(data).find('.comment, .datetime');
        console.log(data);
        console.log(result);
        console.log(result[0]);
        console.log(result[1]);
        // var result = find('.comment,.datetime');
        // console.log( result[0]);
        // $(data).find("div").each(function (index, divEl) {
        // $(data)
        // console.log((data).find('div'));
        // console.log(data);
        //     .find("div")
        //     .each(function (index, optionEl) 
        // const prefectureName = optionEl.value;
        // console.log(prefectureName);
        // const result = $(data);
        // console.log(result[0]);
        // console.log(result[1]);
        // $(data).find("div")
        //find()メソッド 子要素を取得dataの中のdiv
        // success: function(data) {
        //デバック用 アラートとコンソール
        // alert(data);
        // console.log(data);
        // const result1 = $("div").data("comment");
        // const result2 = $("div").data("datetime");
        $('#comment').html(result[0]);
        $('#datetime').html(result[1]);
        // $('#datetime').append(divEl);

        // });

        // const prefectureName = $(data).find('.comment');
        // console.log(prefectureName);

      }).fail(function() {
        alert("error");
      });

    }
    var test = 3;
    send(test);
    // console.log(send(28));
    // });
    // $(document).ready(function() {
    //   });
  </script>

</head>

<body>
  <div class="row">
    <form action="comment_insert_done.php" method="post">
      <input type="text" name="comment">
      <input type="submit" value="送信">
    </form>
  </div>
  <!-- <div id="XMLHttpRequest"></div>ステータスコード -->
  <!-- <div id="textStatus"></div>エラー情報 -->
  <!-- <div id="errorThrown"></div>例外情報 -->
  <table class='table'>
    <thead class='thead-light'>
      <tr>
        <th>コメント</th>
        <th>投稿日時</th>
      </tr>
    </thead>
    <tr>
      <td id="comment"></td><!-- 返してきたデータを表示 -->
      <td id="datetime"></td>
    </tr>
  </table>
  <!-- </td>
    </tr>
  </table> -->
  <?php
  // echo ($_POST['text_id']);
  // var_dump($_POST);
  // echo ($_POST);
  // echo ($_POST['#text_id']);
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
  // print_r($result);
  // var_dump($pdo->errorCode());
  // var_dump($pdo->errorInfo());
  $send = "";
  foreach ($result as $row) {
    // $sendtmp = "send" . $row['text_id'];
    $sendid = $row['text_id'];
    // $src  = '<script type="text/javascript">';
    // $src .= 'top.rss_menu.location.href="rss_menu.php";';
    // $src .= '</script>'; 
    // $send2 = $sendtmp;
    // print_r($send);
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