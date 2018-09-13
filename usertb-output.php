<?php session_start(); ?>
<?php require 'menu.php'; ?>
<?php
//メール認証をクリアしていなければ、メール認証ページへ遷移
if (!isset($_SESSION['mail'])){
	header('Location: mailcon.php');
	exit();
}
?>
<?php
header("Content-Type: text/html; charset=UTF-8");
$cnt=0;
//sqlにログイン
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);
$sql=$pdo->prepare("INSERT INTO usertb(id,name,password)
VALUES(:nm,:name,:pass)");
$results=$pdo->query('SELECT* FROM usertb ORDER BY id;');

//テーブルに重複されたユーザー名がないか確認し、なければユーザー情報をテーブルに書き込み
foreach($results as $row){
	$nms=$row['id'];
	if ( $row['name']==$_REQUEST['name'] ){
		$cnt=$cnt+1;
	}
}
if ( $cnt==0  ){
$sql->bindParam(':nm',$nms,PDO::PARAM_STR);
$sql->bindParam(':name',$name,PDO::PARAM_STR);
$sql->bindParam(':pass',$pass,PDO::PARAM_STR);
$nms=$nms+1;
$name=$_REQUEST['name'];
$pass=$_REQUEST['password'];
$sql->execute();
echo 'お客様情報を登録しました。';
}
else {
	echo 'すでに登録されてあるユーザー名です。お手数ですが他のユーザー名をご入力ください。';
}

?>