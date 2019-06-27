<?php

session_start();

$id = $_GET["id"];

include "funcs.php";

logincheck();

//1.データベース接続
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM user_table WHERE id=:id");
$stmt ->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
}
$row = $stmt->fetch();
//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>My Profile</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <link rel = "stylesheet" href ='style.css'/>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<!-- Head[Start] -->
<header class='header'>
    <div class='jumbotron'>
        <div class="container">
            <h2>My Profile</h2>
        </div>
    </div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class='container'>
    <div class='contents'>
        <form class="form-horizontal" method="post" action="mypage_picture_update.php" enctype="multipart/form-data">
            <div class="form-group" >
                <label class="col-sm-4 control-label">名前：<?=$row["name"]?></label>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">ID：<?=$row["lid"]?></label>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">PROFILE IMAGE：<input style="width:400px;" type="file" name="my_pic" accept="image/jpeg,image/gif,image/png"></label>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <input type="hidden" name="id" value="<?=$row["life_flg"]?>">
                <input type="submit" value="送信">
            </div>
        </form>
    </div>
</div>
<!-- Main[End] -->



<div class='container'>
    <form class="form-horizontal" method="post" action="cancelmyid.php">
        <label class="col-sm-4 control-label">退会手続き:</label>
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        <input type="submit" value="退会する">
    </form>
</div>

<div class='container'>
    <div style="margin:100px 0px" class='text-center'>

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