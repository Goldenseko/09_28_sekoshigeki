<?php
session_start();

//0.外部ファイル読み込み. 先にやっておく。
    //A. DB接続関数（PDO）db_conを呼び出す
    //B. SQL処理エラー
    //C. XSS:htmlspecialchars
include("functions.php");

//1.  DB接続 db_conの中身は"functions.php" の中に記載ずみ
$pdo = db_con();

//2. データ登録SQL作成
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND lpw=:lpw AND life_flg=0");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$res = $stmt->execute();

//3. SQL実行時にエラーがある場合
if($res==false){
    queryError($stmt);
}

//4. 抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//5. 該当レコードがあればSESSIONに値を代入
// echo $val["id"];
if( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg==1"] = $val['kanri_flg==1'];
  $_SESSION["name"]      = $val['name'];

  header("Location: select.php");
}elseif( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg==0"] = $val['kanri_flg==0'];
  $_SESSION["name"]      = $val['name'];

  header("Location: select2.php");
}else{
  //logout処理を経由して全画面へ
  // 認証失敗
  $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
  header("Location: index.php");
}

exit();
?>