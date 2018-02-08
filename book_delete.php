<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
//sessionチェック
chkSsid();

$id = $_GET["id"];

//1.  DB接続します
$pdo = db_con();

  //２．データ登録SQL作成
  $stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id =:id");
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);// ->のマークは「$stmtの中に」ということ
  $status = $stmt->execute();
  
  //３．データ表示
  $view="";
  if($status==false){
    //execute（SQL実行時にエラーがある場合）
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