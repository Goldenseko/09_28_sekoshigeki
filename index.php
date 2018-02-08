<?php
require 'password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();


//DB定義
const DB = "";
const DB_ID = "root";
const DB_PW = "";
const DB_NAME = "";

//PDOでデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost;dbname=gs_db09;charset=utf8',DB_ID,DB_PW);
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文（最新順番3つ取得）
$sql = 'SELECT * FROM gs_bm_table ORDER BY POSTTIME DESC LIMIT 10';
//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute();

if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{

    // エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql:host=localhost; dbname=gs_db09; charset=utf8', DB_ID, DB_PW);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, DB_ID, DB_PW, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    $sql = "SELECT * FROM gs_user_table WHERE id = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['name'];
                    header("Location: login_act.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
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
                    <a class="navbar-brand" href="select.php">データ一覧</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->


    <div class="container">
        <div class="header">
                    <form name="form1" action="login_act.php" method="post">
                        ID:<input type="text" id="userid" name="lid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["lid"])) {echo htmlspecialchars($_POST["lid"], ENT_QUOTES);} ?>"/>
                        PW:<input type="password" id="password" name="lpw" placeholder="パスワードを入力"/>
                        <input type="submit" id="login" name="login" value="ログイン" />
                    </form>
                <h3 class="title"><a class="" href="login.php">新規登録画面</a></h3>
        </div>
        <div class="menu">MENU</div>
        <!-- Main[Start] -->
        <div class="content">
                <ul class=""> 
                        <h2 class="content-title">Bookコンテンツ</h2>
                        <table border = '2'>
                        <tr>
                        <th>posttime</th>
                        <th>name</th>
                        <th>b_name</th>
                        <th>b_url</th>
                        </tr>
                        <?php
                            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo "<tr>";
                                echo "<td><a href='select.php'>" . $result['posttime'] ."</a></td>";
                                echo "<td><a href='select.php'>" . $result['name'] . "</a></td>";
                                echo "<td><a href='select.php'>" . $result['b_name'] . "</a></td>";
                                echo "<td><a href='select.php'>" . $result['b_url'] . "</a></td>";
                                echo "</tr>";
                        } ?>
                         </table>

                </ul>

            <!-- <form method="post" action="insert.php">
                <div class="jumbotron">
                    <fieldset>
                        <legend>ユーザー登録</legend>
                        <label>名前：            <input type="text" name="name"></label><br>
                        <label>ログイン名：       <input type="text" name="lid"></label><br>
                        <label>ログインパスワード：<input type="text" name="lpw"></label><br>
                        <input type="submit" value="送信">
                    </fieldset>
                </div>
            </form> -->
        </div>
        <!-- Main[End] -->  
        <div class="footer">FOOTER</div>
    </div>
</body>
</html>
<?php
}
?>

