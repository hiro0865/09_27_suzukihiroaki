<?php
//0.外部ファイル読み込み
include("functions.php");

//id取得
$id = $_GET["id"];

//DB接続
$pdo = db_con();
//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id =:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
    $row = $stmt->fetch();//１行だけとる
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>
    <div><a class="navbar-brand" href="index.php">トップページ</a></div>
</header>
<fieldset>
    <legend>書籍詳細情報</legend>
     <label>書籍名：<?=$row["bookname"]?></label><br>
     <label>書籍URL：<?=$row["bookurl"]?></label><br>
     <label>コメント：<?=$row["comment"]?></label><br>
     <label>登録日時：<?=$row["comment"]?></label><br>
</fieldset>
</body>
</html>