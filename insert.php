<?php 
//入力チェック(受信確認処理追加)
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["lid"]) || $_POST["lid"]=="" ||
    !isset($_POST["lpw"]) || $_POST["lpw"]==""
  ){
    exit('ParamError');
  }
include("functions.php");

//フォームのデータ受け取り  //1. POSTデータ取得
$name = htmlspecialchars($_POST["name"], ENT_QUOTES);
$lid = htmlspecialchars($_POST["lid"], ENT_QUOTES);
$lpw = htmlspecialchars($_POST["lpw"], ENT_QUOTES);
//DB定義

//2. DB接続します(エラー処理追加)
$pdo = db_con();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, lid, lpw
)VALUES(NULL, :a1, :a2, :a3)");
$stmt->bindValue(':a1', $name);
$stmt->bindValue(':a2', $lid);
$stmt->bindValue(':a3', $lpw);
$status = $stmt->execute();

//PDOでデータベース接続  function内に記載


//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    error_db_info($stmt);
  }else{
    //５．index.phpへリダイレクト
    header("Location: index.php");
    exit;
  }

?>