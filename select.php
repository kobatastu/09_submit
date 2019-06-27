<?php

session_start();
include "funcs.php";
logincheck();


//各ページに載せられるMAXのデータ個数を決定
define('MAX',4);

$now_page=h($_GET['page']);

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
$pdo = db_con();

$total = $pdo->query('SELECT COUNT(*) from an_table')->fetchColumn();
$totalpages = ceil($total/MAX);


//２．データ表示SQL作成
$stmt = $pdo->prepare('SELECT an_table.id,an_table.name,name_rest,evaluation,title,comment,good,rest_pic,indate,my_pic FROM an_table INNER JOIN user_table ON user_table.name=an_table.name ORDER BY an_table.id DESC LIMIT '.$offset.','.MAX);
$status = $stmt->execute();
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

        //いいね処理。自分が今までにそのレストランに対し、いいねをしたかをカウントする。あれば$countに結果が格納
        $sql = "SELECT COUNT(*) FROM good_table WHERE user_name=:user_name AND rest_id=:rest_id;";
        $stmt2 = $pdo->prepare($sql);
        $stmt2->bindValue(':user_name',$_SESSION["name"],PDO::PARAM_STR);
        $stmt2->bindValue(':rest_id',$result['id'],PDO::PARAM_INT);
        $status2 = $stmt2->execute();
        $count = $stmt2->fetchColumn();

        //いいね処理。みんながいいねをした総数をカウントする。あれば$count2に結果が格納
        $sql2 = "SELECT COUNT(*) FROM good_table WHERE rest_id=:rest_id;";
        $stmt3 = $pdo->prepare($sql2);
        $stmt3->bindValue(':rest_id',$result['id'],PDO::PARAM_INT);
        $status3 = $stmt3->execute();
        $count2 = $stmt3->fetchColumn();


        //コメント処理。
        $stmt4 = $pdo->prepare("SELECT * FROM comment_table WHERE rest_id = :rest_id");
        $stmt4 ->bindValue(":rest_id",$result["id"],PDO::PARAM_INT);
        $status4 = $stmt4->execute();

        //コメント処理。コメントの総数をカウント。
        $stmt5 = $pdo->prepare("SELECT COUNT(*) FROM comment_table WHERE rest_id = :rest_id");
        $stmt5 ->bindValue(":rest_id",$result["id"],PDO::PARAM_INT);
        $status5 = $stmt5->execute();
        $count3 = $stmt5->fetchColumn();

        //ここから本文ループ
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
                <img src="upload_restrant/'.$result["rest_pic"].'" style="width:400px;"><br>';

        $view .= '<a id="btn'.$result["id"].'">
                  <span style="font-size: 2em; color: black;">
                    <i class="far fa-comment-alt"></i>
                  </span>'.$count3.'</a>'; 
       

                //いいね処理。一回でも押したことがあれば赤、押したことがなければ色塗りなしのハートになる。
                if ($count > 0) {
                    // $view .= '<a id="btn2'.$result["id"].'" href="good.php?id='.$result["id"].'&name='.$_SESSION["name"].'&pre_page='.$now_page.'">
                    // <span style="font-size: 2em; color: Tomato;">
                    // <i class="fas fa-heart"></i>
                    // </span>'.$count2.'</a>';

                    $view .= '<a id="btn2'.$result["id"].'">
                            
                            <span style="font-size: 2em; color: Tomato;">
                            <i class="fas fa-heart"></i>
                            </span>'.$count2.'</a>';
                  } else {
                    // $view .= '<a id="btn2'.$result["id"].'" href="good.php?id='.$result["id"].'&name='.$_SESSION["name"].'&pre_page='.$now_page.'">
                    // <span style="font-size: 2em; color: black;">
                    // <i class="far fa-heart"></i>
                    // </span>'.$count2.'</a>';
                    $view .=  '<a id="btn2'.$result["id"].'">
                            
                            <span style="font-size: 2em; color: black;">
                            <i class="far fa-heart"></i>
                            </span>'.$count2.'</a>';
                  }
          
            
        $view .= '<p style="margin:0px">投稿時間：'.$result["indate"].'</p>' ;         
               

        //コメントAjax

        
        $view .= '<div id="view'.$result["id"].'"></div>';
    
        $view .='<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
                 <script>
                    document.querySelector("#btn'.$result["id"].'").onclick = function() {

                        


                        $.ajax({
                            type: "post",
                            url: "comment_disp.php",
                            data: {
                                "rest_id":'.$result["id"].',
                                "user_name":"'.$_SESSION["name"].'",
                                "pre_page":'.$now_page.'
                            },
                            dataType: "html",
                            success: function(data) {
                                $("#view'.$result["id"].'").html(data);  
                            }
                        });

                    
                    }
                </script>';

        //いいねAjax

        $view .='<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
                <script>
                    document.querySelector("#btn2'.$result["id"].'").onclick = function() {
                        $.ajax({
                            type: "post",
                            url: "good.php",
                            data: {
                                "rest_id":'.$result["id"].',
                                "user_name":"'.$_SESSION["name"].'",
                            },
                            dataType: "html",
                            success: function(data) {
                                $("#btn2'.$result["id"].'").html(data);  
                            }
                        });
                    }
                </script>';




           //ajaxない場合はこの部分をコメントを書くために使う       
        //           if($status4==false){
        //               $error = $stmt4->errorInfo(); //Errorがある場合 
        //               exit("ErrorQuery:".$error[2]); //配列index[2]にエラーコメントあり
        //           } else {
        //           //Selectデータの数だけ自動でループしてくれる
        //               while( $result4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
                  
        //                   $stmt5 = $pdo->prepare("SELECT * FROM user_table WHERE name = :name");
        //                   $stmt5 ->bindValue(":name",$result4["user_name"],PDO::PARAM_STR);
        //                   $status5 = $stmt5->execute();
        //                   $result5 = $stmt5->fetch();
                  
        //                   $view .= '<img src="upload/'.$result5["my_pic"].'" alt="" class="user"><div class="eva">'
        //                           .'<p style="margin-top:10px;font-weight:bold;">'.$result4["user_name"].'</p></div>'
        //                           .'<p style="width:400px;">'.$result4['user_comment'].'<br>';
                  
        //                   $view .= '<p style="margin:0px">投稿時間：'.$result4["indate"].'</p>';
                          
        //               }
        //           }


        // $view .= '<div class="container">
        //                 <form class="form-horizontal" action="comment.php" method="post">
        //                     <div class="form-group">
        //                         <label class="col-sm-4 control-label"></label>
        //                         <input style="width:400px;" type="text" name="user_comment" class="form-control" placeholder="コメントを入力してください">
        //                         <input type="hidden" name="user_name" value='.$_SESSION["name"].'>
        //                         <input type="hidden" name="rest_id" value='.$result["id"].'>
        //                         <input type="hidden" name="pre_page" value='.$now_page.'>
        //                     </div>
                
        //                     <button type="submit" class="btn btn-info">送信</button>
                
        //                 </form>
        //         </div>';



       
         
        

                if ($_SESSION["kanri_flg"]=="1" || $_SESSION["name"]==$result["name"]){
                    $view .= '<a href="detail.php?id='.$result["id"].'">更新</a>
                    <a href="delete.php?id='.$result["id"].'">削除</a>';
                }
        $view .= '</div></div>';
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
    <!-- font awesome用 -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<header class='header'>
<div class='jumbotron'>
    <div class="container">
        <form action='login_search.php?page=<?=$now_page ?>' method='post'>
            <input type="text" name='search' placeholder="投稿者名か、キーワードを入力してください" size=80>
            <input type="submit" value="検索">
        </form>
        
        <a class="btn" href="mypage.php?id=<?= $_SESSION["id"] ?>">マイページ</a>
        <?php if($_SESSION["kanri_flg"]=="1"){ ?>
        <a class="btn" href="user_make.php">ユーザー登録</a>
        <a class="btn" href="user_select.php">ユーザー一覧</a>
        <?php } ?>
        <a class="btn" href="input.php">お店登録</a>
        <a class="btn" href="logout.php">ログアウト</a>
        
    </div>
</div>
</header>
<body>


<div class='contents'>

    <div class="container">
        <div class="row">
            <table><?=$view?></table>
        </div>
    </div>

    <div class='container'>
        <div style="margin:100px 0px" class='text-center'>

            <?php for ($i = 1; $i <= $totalpages; $i++):?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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