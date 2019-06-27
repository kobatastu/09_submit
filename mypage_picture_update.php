<?php

include "funcs.php";

session_start();

logincheck();

$id = h($_POST["id"]);

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
$sql = "UPDATE user_table SET my_pic=:my_pic WHERE id=:id";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':my_pic', $file_name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    redirect('mypage.php?id='.$id.'');
}
?>