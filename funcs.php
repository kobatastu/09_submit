<?php
//共通に使う関数を記述

function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

function db_con(){
    try {
        $pdo = new PDO('mysql:dbname=09_submit;charset=utf8;host=localhost','root','');
        return $pdo;
    } catch (PDOException $e) {
        exit('DB-Connection-Error:'.$e->getMessage());
      }      
}

function redirect($page){
    header("Location: ".$page);
    exit;
}

function sqlError($stmt){ 
    $error = $stmt->errorInfo();
    exit("ErrorSQL:".$error[2]);
}

//ログイン認証関数
function logincheck(){
    //直接select.phpを打ちこんで、入ってこれないようにするために使う
    //クッキーはサーバに保存されるため、別のブラウザからはアクセスできない
    if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
        echo "LOGIN Error!";
        exit();
    } else {
        //毎回セッションキーを新しくし、ハッカーの攻撃を防ぐ
        session_regenerate_id();
        $_SESSION["chk_ssid"] = session_id();
    }
}