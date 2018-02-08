<?php
include("functions.php");
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["id"]) || $_POST["id"]=="" ||
  !isset($_POST["bookname"]) || $_POST["bookname"]=="" ||
  !isset($_POST["bookurl"]) || $_POST["bookurl"]=="" ||
  !isset($_POST["comment"]) || $_POST["comment"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$id = $_POST["id"];
$bookname   = $_POST["bookname"];
$bookurl  = $_POST["bookurl"];
$comment = $_POST["comment"];

//2. DB接続します(エラー処理追加)
$pdo =db_con();


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET bookname=:bookname, bookurl =:bookurl, comment=:comment WHERE id =:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  error_db_info($stmt);
}else{
  //５．リダイレクト+kanri_flgチェック
  if($_SESSION["kanri_flg"]==1){
    header("Location: book_select.php");
  }else{
    header("Location: book_user_select.php");
  }
  exit();
}
?>
