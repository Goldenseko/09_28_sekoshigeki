<?php
session_start();
//0.外部ファイル読み込み
include("functions.php");
chkSsid();

//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="detail.php?id='.$result["id"].'">';
    $view .= h($result["id"])." "
              ."[".h($result["posttime"])."]"." "
              .h($result["name"])." "
              .h($result["b_name"]). " "
              .h($result["b_comment"]). " ";
    $view .= '</a>　';
    $view .= '<a href="delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/basic.css">
    <title>PHP Session Start Login画面作成テスト</title>
</head>
<body>
  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
        <?php if($_SESSION["kanri_flg"=="1"]){ ?>
        <a class="navbar-brand" href="index.php">データ登録</a>
        <?php } ?>
        <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->


  <div class="container">
      <div class="header">
          <nav>
              <div class=""> 
                  <form name="form1" action="login_act.php" method="post">
                      ID:<input type="text" name="lid" />
                      PW:<input type="password" name="lpw" />
                      <input type="submit" value="LOGIN" />
                  </form>
              </div>
          </nav>
          <div class="">
              <h1 class="title"><a class="" href="login.php">ログイン画面</a></h1>
          </div>
      </div>
      <div class="menu">MENU</div>
      <!-- Main[Start] -->
      <div class="content">
        <div>
          <div class=""><h6>
            <?=$_SESSION["name"]?>さん、こんにちは</h6>
          </div>
          <h6>
            <?=$view?></h6>
          </div>
        </div>
      </div>
      <!-- Main[End] -->
      <div class="footer">FOOTER</div>
  </div>

</body>
</html>