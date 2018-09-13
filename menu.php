<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>たそ姉の雑談室</title>
</head>
<body>
<a href="login-input.php">ログイン</a>
<a href="logout-input.php">ログアウト</a>
<a href="mailcon.php">会員登録</a>
<hr>
<?php
//sqlにログイン
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);
//ユーザー情報を保存するテーブル
$usertb="usertb";
//テーブル usertbを作成
$sql="create table usertb"
."("
."id INT,"
."name char(32),"
."password TEXT"
.");";
$stmt=$pdo->query($sql);
?>
</body>
</html>
