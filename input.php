<?php

session_start();
include "funcs.php";
logincheck();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel = "stylesheet" href ='style.css'/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<header class='header'>
    <div class='jumbotron'>
        <div class="container">
            <h2>お店登録</h2>
        </div>
    </div>

</header>

    <div class="container">
    <div class="contents">
        <form action="input_act.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>レストランの名前</label>
                <input style="width:400px;" type="text" name="name_rest" class="form-control" placeholder="NAMEを入力してください" >
            </div>
       
            <div class="form-group" >
                <label>評価</label>
                <select style="width:400px;" name="evaluation" id="range" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="form-group" >
                <label>タイトル</label>
                <input style="width:400px;" type="text" name="title" class="form-control" placeholder="タイトルを入力してください">
            </div>

            <div class="form-group" >
                <label>コメント</label>
                <textarea style="width:400px;" name="comment" id="" rows="5" class="form-control" placeholder="コメントを入力してください"></textarea>
            </div>

            <div class="form-group" >
                <label>店の写真</label><br>
                <input style="width:400px;" type="file" name="rest_pic" accept="image/jpeg,image/gif,image/png">
            </div>

            <button type="submit" class="btn btn-info">お店追加</button>

        </form>
        </div>
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