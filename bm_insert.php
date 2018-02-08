<?php
//入力チェック(受信確認処理追加)
include("functions.php");

if(
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["bookname"]) || $_POST["bookname"]=="" ||
  !isset($_POST["bookurl"]) || $_POST["bookurl"]=="" ||
  !isset($_POST["comment"]) || $_POST["comment"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$lid   = $_POST["lid"];
$bookname   = $_POST["bookname"];
$bookurl  = $_POST["bookurl"];
$comment = $_POST["comment"];

//2. DB接続します(エラー処理追加)
$pdo = db_con();


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id,lid,bookname, bookurl, comment,
indate )VALUES(NULL, :a0, :a1, :a2, :a3, sysdate())");
$stmt->bindValue(':a0', $lid);
$stmt->bindValue(':a1', $bookname);
$stmt->bindValue(':a2', $bookurl);
$stmt->bindValue(':a3', $comment);
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
