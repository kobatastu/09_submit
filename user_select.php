<?php

session_start();

include "funcs.php";
logincheck();

//1.データベース接続
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM user_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $view .= '<tr>'; 
      $view .= '<th>';  
      $view .= $result["name"] . "</th><th>" . $result["lid"]. "</th><th>" . $result["kanri_flg"]. "</th><th>" . $result["life_flg"];
      $view .= '</th>';
      $view .= '<th><a href="user_detail.php?id='.$result["id"].'">';  
      $view .= "[更新]";
      $view .= '</a></th>';
      $view .= '<th><a href="user_delete.php?id='.$result["id"].'">';  
      $view .= "[削除]";
      $view .= '</a></th>';

      $view .= '</tr>';
    }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link href="style.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
  <!-- ブートストラップ用 -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header class='header'>
    <div class='jumbotron'>
        <div class="container">
            <h2>ユーザー一覧</h2>
        </div>
    </div>

</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="container">
    <div class="contents">
        <table class="table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>ID</th>
                    <th>管理者権限</th>
                    <th>使用状況</th>
                    <th>更新</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                <?=$view?>
            </tbody>
        </table>
    </div>
</div>


<div class='container'>
    <div style="margin:100px 0px" class='text-center'>
<!-- Main[End] -->
        <a href="user_make.php">新規ユーザー登録</a><br>
        <a href="select.php?page=1">Topへ</a>
    </div>
</div>

<footer class="footer">
  <div class="container">
    <div class="text-right">
        <p class="text-muted">Copyright (c) G's dish log.All Rights Reserved.</p>
    </div>
  </div>
</footer>

</body>
</html>