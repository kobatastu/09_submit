<?php
include "funcs.php";

session_start();
//日本時間に合わせる
// date_default_timezone_set('Asia/Tokyo');


$name = h($_POST["name"]);
$lid = h($_POST["lid"]);
$lpw = h($_POST["lpw"]);
$kanri_flg = 0;
$life_flg = 0;

//profile画像取得
if (isset($_FILES["my_pic"] ) && $_FILES["my_pic"]["error"] ==0 ) {
    
  $file_name = $_FILES["my_pic"]["name"];//ファイル名取得
  $tmp_path  = $_FILES["my_pic"]["tmp_name"];//一時保存場所

  // list($w, $h) =getimagesize($file_name);

  // if($w > $h){
  //   $diff  = ($w - $h) * 0.5; 
  //   $diffW = $h;
  //   $diffH = $h;
  //   $diffY = 0;
  //   $diffX = $diff;
  // }elseif($w < $h){
  //   $diff  = ($h - $w) * 0.5; 
  //   $diffW = $w;
  //   $diffH = $w;
  //   $diffY = $diff;
  //   $diffX = 0;
  // }elseif($w === $h){
  //   $diffW = $w;
  //   $diffH = $h;
  //   $diffY = 0;
  //   $diffX = 0;
  // }

  // $thumbW = 300;
  // $thumbH = 300;

  // $thumbnail = imagecreatetruecolor($thumbW, $thumbH);

  // $baseImage = imagecreatefromjpeg($file_name);

  // imagecopyresampled($thumbnail, $baseImage, 0, 0, $diffX, $diffY, $thumbW, $thumbH, $diffW, $diffH);

  // imagejpeg($thumbnail, "neko_thumbnail_diff.jpg", 100);




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

$pw = password_hash($lpw,PASSWORD_DEFAULT);


//2. DB接続します
$pdo = db_con();


// 2.データ登録sql作成
$sql2 = "SELECT * FROM user_table WHERE name=:name";

// sqlをセット
$stmt2 = $pdo->prepare($sql2);
// sqlに値を代入
$stmt2 -> bindvalue(':name',$name);
$status2 = $stmt2->execute();
$val = $stmt2->fetch(); 


//４．データ登録処理後
if($status2==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt2->errorInfo();
    exit("QueryError:".$error[2]);
  }elseif($val2['id'] !=''){
    header("Location: make_error.php");
    exit;
  } 




//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO user_table(id,name,lid,lpw,kanri_flg,life_flg,my_pic)
VALUES(NULL, :name,:lid,:lpw,:kanri_flg,:life_flg,:my_pic)");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
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
    header("Location: index.php?page=1");
    exit;
  
  }


?>