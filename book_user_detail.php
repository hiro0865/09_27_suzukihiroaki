<?php
include("functions.php");
//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）
$id = $_GET["id"];

//1.  DB接続します
$pdo = db_con();
  
  //２．データ登録SQL作成
  $stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id =:id");
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);// ->のマークは「$stmtの中に」ということ
  $status = $stmt->execute();
  
  //３．データ表示
  $view="";
  if($status==false){
    //execute（SQL実行時にエラーがある場合）
    error_db_info($stmt);
  }else{
        $row = $stmt->fetch();//１行だけとる
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>書籍登録更新</title>
  <link href="" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="book_user_select.php">書籍登録一覧</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="book_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍更新登録</legend>
     <label>書籍名：<input type="text" name="bookname" value="<?=$row["bookname"]?>"></label><br>
     <label>書籍URL：<input type="text" name="bookurl" value="<?=$row["bookurl"]?>"></label><br>
     <label>コメント<textarea name="comment" cols="30" rows="10"><?=$row["comment"]?></textarea></label><br>
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$id?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
