<?php

session_start();
include "funcs.php";

logincheck();

//1. life_flgを退会扱いにしておく
$life_flg =1;
$id = $_POST["id"];


//2. DB接続します
$pdo = db_con();

//３．データ登録SQL作成
$sql = "UPDATE user_table SET life_flg=:life_flg WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    redirect("logout.php");
}