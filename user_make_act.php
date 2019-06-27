<?php

session_start();

include 'funcs.php';

logincheck();


//日本時間に合わせる
// date_default_timezone_set('Asia/Tokyo');

$name = h($_POST["name"]);
$lid = h($_POST["lid"]);
$lpw = h($_POST["lpw"]);
$kanri_flg = h($_POST["kanri_flg"]);
$life_flg = 0;

// $time = date("Y/m/d H:i:s");

//profile画像取得
if (isset($_FILES["my_pic"] ) && $_FILES["my_pic"]["error"] ==0 ) {
    
  $file_name = $_FILES["my_pic"]["name"];//ファイル名取得
  $tmp_path  = $_FILES["my_pic"]["tmp_name"];//一時保存場所

  $extension = pathinfo($file_name, PATHINFO_EXTENSION);//拡張子だけ取られる
  $file_name = date("YmdHis").md5(session_id()) . "." . $extension;//拡張子の前に日時とSESSION IDをつけてユニークなファイル名を作成する。

  // FileUpload [--Start--]
  $img="";
  $file_dir_path = "upload/".$file_name;//upload下にファイルを保存
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
$stmt = $pdo->prepare("INSERT INTO user_table(id,name,lid,lpw,kanri_flg,life_flg,my_pic)
VALUES(NULL, :name,:lid,:lpw,:kanri_flg,:life_flg,:my_pic)");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':my_pic', $file_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }else{
    //５．index.phpへリダイレクト　この処理がないと画面が切り替わらない
    header("Location: user_select.php?page=1");
    exit;
  
  }
?>