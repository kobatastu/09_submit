<?php

session_start();

//1. データ取得
$id = $_GET["id"];

//２．データ登録SQL作成
include "funcs.php";
logincheck();


$pdo = db_con();
$stmt = $pdo->prepare("SELECT * FROM an_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    $row = $stmt->fetch();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新</title>
  <link href="style.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
  <!-- ブートストラップ用 -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<!-- Head[Start] -->
<header class="header">
  <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->

<div class='contents'>
    <form class="form-horizontal" method="post" action="update.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name_rest" class="col-sm-4 control-label">レストランの名前</label>
            <div class="col-sm-8">
                <input class="form-control" style="width:400px;" type="text" name="name_rest" value="<?=$row["name_rest"]?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">評価</label>
            <div class="col-sm-8">
                <select style="width:400px;" name="evaluation" id="range" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">タイトル</label>
            <div class="col-sm-8">
                <input style="width:400px;" type="text" name="title" class="form-control"  value="<?=$row["title"]?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">コメント</label>
            <div class="col-sm-8">
                <textArea style="width:400px;" name="comment" rows="4" cols="40" class="form-control"><?=$row["comment"]?></textArea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">レストランの写真</label>
            <div class="col-sm-8">
                <input style="width:400px;" type="file" name="rest_pic" accept="image/jpeg,image/gif,image/png">
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-sm-8 col-sm-offset-4">  
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <input type="submit" value="送信">
            </div>
        </div>
    </form>
</div>

<!-- Main[End] -->

<!-- <div class="container">
    <h2>LOGIN</h2>
        <form action="login_act.php" method="post">
            <div class="form-group">
                <label>ID</label>
                <input style="width:400px;" type="text" name="lid" class="form-control" placeholder="IDを入力してください" >
            </div>
       
            <div class="form-group" >
                <label>PW</label>
                <input style="width:400px;" type="text" name="lpw" class="form-control" placeholder="PWを入力してください">
            </div>

            <button type="submit" class="btn btn-info">LOGIN</button>

        </form>
    </div> -->

<footer class="footer">
  <div class="container">
    <div class="text-right">
        <p class="text-muted">Copyright (c) G's dish log.All Rights Reserved.</p>
    </div>
  </div>
</footer>


</body>
</html>