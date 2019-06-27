<?php

$id = $_POST["rest_id"];
$user_name= $_POST["user_name"];
$user_comment = $_POST["user_comment"];
$page = $_POST["pre_page"];


include "funcs.php";
$pdo = db_con();


//２．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO comment_table(id,user_name,rest_id,user_comment,indate)VALUES(NULL, :user_name,:rest_id,:user_comment,sysdate())");
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rest_id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_comment', $user_comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
$result = $stmt->fetch();

if ($status == false) {
    sqlError($stmt);
}else{
    redirect('select.php?page='.$page.'');
}


?>