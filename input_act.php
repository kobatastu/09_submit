<?php

session_start();

include 'funcs.php';

logincheck();


//日本時間に合わせる
// date_default_timezone_set('Asia/Tokyo');

$name = h($_SESSION["name"]);
$name_rest = h($_POST["name_rest"]);
$evaluation = h($_POST["evaluation"]);
$title = h($_POST["title"]);
$comment = h($_POST["comment"]);
$good = 0;
// $time = date("Y/m/d H:i:s");

//profile画像取得
if (isset($_FILES["rest_pic"] ) && $_FILES["my_pic"]["error"] ==0 ) {
    
  $file_name = $_FILES["rest_pic"]["name"];//ファイル名取得
  $tmp_path  = $_FILES["rest_pic"]["tmp_name"];//一時保存場所

  $extension = pathinfo($file_name, PATHINFO_EXTENSION);//拡張子だけ取られる
  $file_name = date("YmdHis").md5(session_id()) . "." . $extension;//拡張子の前に日時とSESSION IDをつけてユニークなファイル名を作成する。

  // FileUpload [--Start--]
  $img="";
  $file_dir_path = "upload_restrant/".$file_name;//upload下にファイルを保存
  if ( is_uploaded_file( $tmp_path ) ) {
      if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
          chmod( $file_dir_path, 0644 );
          // $img = '<img src="'.$file_dir_path.'">';//確認のために作成
      } else {
          // echo "Error:アップロードできませんでした。";
      }
  }

  
}else{
  //  $img = "画像が送信されていません";
}


//2. DB接続します
$pdo = db_con();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO an_table(id,name,name_rest,evaluation,title,comment,rest_pic,good,indate)
VALUES(NULL, :name,:name_rest,:evaluation,:title,:comment,:rest_pic,:good,sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name_rest', $name_rest, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':evaluation', $evaluation, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rest_pic', $file_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':good', $good, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }else{
    //５．index.phpへリダイレクト　この処理がないと画面が切り替わらない
    header("Location: select.php?page=1");
    exit;
  
  }
?>