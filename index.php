<?php
//0.外部ファイル読み込み
include("functions.php");
//1.  DB接続します
$pdo = db_con();
//２．データ登録SQL作成＋kanri_flgチェック
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY indate DESC LIMIT 20");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td>';
    $view .= '<a href="index_detail.php?id='.$result["id"].'">';
    $view .= $result["bookname"];
    $view .= '</td>';
    $view .= '<td>';
    $view .=$result["bookurl"];
    $view .= '</td>';
    $view .= '<td>';
    $view .=$result["indate"];
    $view .= '</td>';
    $view .='</a>';
    $view .= '</td>';
    $view .= '</tr>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <ul class="main-nav">
          <li><img src="img/bookimg.jpg" width="175px" alt="本"></li>
          <li><a href="book_user_select.php">マイページ</a></li>
          <li><a href="login.php">ログイン</a></li>
          <li><a href="logout.php">ログアウト</a></li>
          <li><a href="user_first_register.php">新規登録</a></li>
        </ul>
      </nav>

<h1>みんなのブックマークアプリ</h1>

<div id ="main">
    <p>自分の好きな本をブックマークしてみんなで共有しよう</p>
    <p>クリックして詳細ページへ</p>
    <div id ="output">
          <div class="container jumbotron">
          <table>
          <tr>
          <th>書籍名</th>
          <th>書籍URL</th>
          <th>登録日時</th>
          </tr>
          <?=$view?>
          </table>
          </div>
    </div>
</div>

</body>
</html>