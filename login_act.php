<?php

include "funcs.php";


$lid = h($_POST["lid"]);
$lpw = h($_POST["lpw"]);


// 1.接続
$pdo = db_con();

// 2.データ登録sql作成
$sql = "SELECT * FROM user_table WHERE lid=:lid";

// sqlをセット
$stmt = $pdo->prepare($sql);
// sqlに値を代入
$stmt -> bindvalue(':lid',$lid);

// sqlを実行
$res = $stmt-> execute();

if($res==false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}

//結果を表示
$result = $stmt->fetch();

session_start();

if (password_verify($lpw,$result["lpw"]) && $result[life_flg]==0){
    $_SESSION["chk_ssid"] = session_id();
    $_SESSION["kanri_flg"] = $result['kanri_flg'];//SESSIONに持たせておけば管理権限を取り出すことができる
    $_SESSION["name"] = $result['name'];
    $_SESSION["id"] = $result['id'];
    redirect('select.php?page=1');
} else {
    redirect('logout.php');
}
//処理終了
exit();

?>