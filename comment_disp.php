<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";

logincheck();

$id = $_POST["rest_id"];
$user_name= $_POST["user_name"];
$page = $_POST["pre_page"];

//1.  DB接続します
$pdo = db_con();

$stmt = $pdo->prepare("SELECT * FROM comment_table WHERE rest_id = :rest_id");
$stmt ->bindValue(":rest_id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

$view = '';

if($status==false){
    $error = $stmt->errorInfo(); //Errorがある場合 
    exit("ErrorQuery:".$error[2]); //配列index[2]にエラーコメントあり
} else {

if($status==false){
    $error = $stmt->errorInfo(); //Errorがある場合 
    exit("ErrorQuery:".$error[2]); //配列index[2]にエラーコメントあり
} else {
//Selectデータの数だけ自動でループしてくれる
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

        $stmt2 = $pdo->prepare("SELECT * FROM user_table WHERE name = :name");
        $stmt2 ->bindValue(":name",$result["user_name"],PDO::PARAM_STR);
        $status2 = $stmt2->execute();
        $result2 = $stmt2->fetch();

        $view .= '<img src="upload/'.$result2["my_pic"].'" alt="" class="user"><div class="eva">'
                .'<p style="margin-top:10px;font-weight:bold;">'.$result["user_name"].'</p></div>'
                .'<p style="width:400px;">'.$result['user_comment'].'<br>';

        $view .= '<p style="margin:0px">投稿時間：'.$result["indate"].'</p>';
        
    }
}


$view .= '<div class="container">
            <form class="form-horizontal" action="comment.php" method="post">
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <input style="width:400px;" type="text" name="user_comment" class="form-control" placeholder="コメントを入力してください">
                    <input type="hidden" name="user_name" value='.$user_name.'>
                    <input type="hidden" name="rest_id" value='.$id.'>
                    <input type="hidden" name="pre_page" value='.$page.'>
                </div>

                <button type="submit" class="btn btn-info">送信</button>

            </form>
        </div>';


echo $view;

}
?>
