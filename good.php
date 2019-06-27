<?php
session_start();
$id = $_POST["rest_id"];
$name= $_POST["user_name"];



include "funcs.php";

logincheck();

$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM good_table WHERE user_name = :user_name AND rest_id = :rest_id");
$stmt ->bindValue(":rest_id",$id,PDO::PARAM_INT);
$stmt ->bindValue(":user_name",$name,PDO::PARAM_STR);
$status = $stmt->execute();
$result = $stmt->fetch();

if ($result ==''){
    $stmt2 = $pdo->prepare("INSERT INTO good_table(id,user_name,rest_id)VALUES(NULL, :user_name,:rest_id)");
    $stmt2->bindValue(':user_name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt2->bindValue(':rest_id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
    $status2 = $stmt2->execute();
    $result2 = $stmt2->fetch();
} else {
    $id_1=$result["id"];
    // $good = $result["good_flg"];
    // $good = $good+1;
    $stmt2 = $pdo->prepare("DELETE FROM good_table WHERE id=:id");
    $stmt2->bindValue(':id', $id_1, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
    $status2 = $stmt2->execute();
    $result2 = $stmt2->fetch();

}

//データ表示

    //いいね処理。自分が今までにそのレストランに対し、いいねをしたかをカウントする。あれば$countに結果が格納
    $sql = "SELECT COUNT(*) FROM good_table WHERE user_name=:user_name AND rest_id=:rest_id;";
    $stmt3 = $pdo->prepare($sql);
    $stmt3->bindValue(':user_name',$name,PDO::PARAM_STR);
    $stmt3->bindValue(':rest_id',$id,PDO::PARAM_INT);
    $status3 = $stmt3->execute();
    $count = $stmt3->fetchColumn();

    //いいね処理。みんながいいねをした総数をカウントする。あれば$count2に結果が格納
    $sql2 = "SELECT COUNT(*) FROM good_table WHERE rest_id=:rest_id;";
    $stmt4 = $pdo->prepare($sql2);
    $stmt4->bindValue(':rest_id',$id,PDO::PARAM_INT);
    $status4 = $stmt4->execute();
    $count2 = $stmt4->fetchColumn();

    $good = '';

    if ($count > 0) {
        $good .= '<span style="font-size: 2em; color: Tomato;">
                <i class="fas fa-heart"></i>
                </span>'.$count2;
      } else {
        $good .= '<span style="font-size: 2em; color: black;">
                <i class="far fa-heart"></i>
                </span>'.$count2;
      }


    echo $good;


// if ($status == false) {
//     sqlError($stmt);
// }else{
//     redirect('select.php?page='.$page.'');
// }

?>