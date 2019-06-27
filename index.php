<?php
//各ページに載せられるMAXのデータ個数を決定
define('MAX',4);

//ページングを動作させるための機能
// if (preg_match('/^[1-9][0-9]*$/', $_GET['page'])){
// if($_GET['page']== ''){
//     $page=1;
// } else
if (preg_match('/^[1-9][0-9]*$/', $_GET['page'])){
    $page = (int)$_GET['page'];
} else {
    $page =1;
}

$offset = MAX*($page-1);


//1.  DB接続します
include "funcs.php";
$pdo = db_con();

$total = $pdo->query('SELECT COUNT(*) from an_table')->fetchColumn();
$totalpages = ceil($total/MAX);


//２．データ表示SQL作成
$stmt = $pdo->prepare('SELECT an_table.id,an_table.name,name_rest,evaluation,title,comment,good,rest_pic,indate,my_pic FROM an_table INNER JOIN user_table ON user_table.name=an_table.name ORDER BY an_table.id DESC LIMIT '.$offset.','.MAX);
$status = $stmt->execute();


// $stmt = $pdo->prepare('SELECT * FROM an_table ORDER BY id DESC LIMIT '.$offset.','.MAX);
// $status = $stmt->execute();
$view = "";
$star = "";
$com = "";

//３．データ表示
if($status==false){
    $error = $stmt->errorInfo(); //Errorがある場合 
    exit("ErrorQuery:".$error[2]); //配列index[2]にエラーコメントあり
} else {
//Selectデータの数だけ自動でループしてくれる
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){


        if(strlen($result["comment"])>=30){
            $com = substr($result["comment"],0,130)."...";
        } else {
            $com = $result["comment"];
        }; 
        $star .= '<div class="eva"><p style="margin:0px;font-weight:bold;">'.$result['name_rest'].'</p>';
        for ($i=1;$i <= $result["evaluation"];$i++){
            $star .= '<img src="img/star.jpg" alt="" class="star">';
        };
        $star .= "</div>"; 
        
        $view .= '<div class="col-sm-6"><div class="box"><img src="upload/'.$result["my_pic"].'" alt="" class="user">'.$star//.$result["id"]."</td><td>"
                .'<p style="margin-top:10px;font-weight:bold;">'.$result["title"]."@".$result["name"].'</p>'
                .'<p style="width:400px;">'.$com.'</p>
                <img src="upload_restrant/'.$result["rest_pic"].'" style="width:400px;"><p style="margin:0px">投稿時間：'.$result["indate"].'</p></div></div>' ;
       
        $star = ''; 

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
    <link rel = "stylesheet" href ='style.css'/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <!-- ブートストラップ用 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<header class='header'>
    <div class='jumbotron'>
        <div class="container">
            <form action="search.php" method='post'>
                <input type="text" name='search' placeholder="投稿者名か、キーワードを入力してください" size=80>
                <input type="submit" value="検索">
                <a class="btn" class="btn btn-primary btn-lg" role="button" href="login.php">ログイン</a>
                <a class="btn" class="btn btn-primary btn-lg" role="button" href="make.php">新規登録</a>
            </form>
        </div>
    </div>

</header>
<body>

<!-- <div class='container'> -->

<div class='contents'>

    <div class="container">
        <div class="row">
            <table><?=$view?></table>
        </div>
    </div>

    <div class='container'>
        <div style="margin:100px 0px" class='text-center'>
            <?php for ($i = 1; $i <= $totalpages; $i++):?>
            <a class='text-center' href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
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