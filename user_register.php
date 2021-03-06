<?php

session_start();

//0.外部ファイル読み込み
include("functions.php");

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>POSTデータ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
<?php if($_SESSION["kanri_flg"]=="1"){ ?>
  <a class="navbar-brand" href="user_view.php">ユーザー表示</a>
  <a class="navbar-brand" href="book_select.php">書籍一覧表示</a>
<?php }else{ ?>
  <a class="navbar-brand" href="book_user_select.php">書籍一覧表示</a>
<?php } ?>
  <a class="navbar-brand" href="bm_index.php">書籍登録</a>
  <a class="navbar-brand" href="logout.php">ログアウト</a>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>ユーザーID：<input type="text" name="lid"></label><br>
     <label>パスワード<input type="password" name ="lpw"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
