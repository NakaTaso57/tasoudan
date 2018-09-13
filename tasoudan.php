<?php session_start(); ?>
<?php require 'menu.php'; ?>
<?php
if (!isset($_SESSION['usertb'])){
	header('Location: login-input.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>たそ姉の雑談室</title>
</head>
<body>
<pre>
<?php 
//sqlにログイン
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);
//ユーザー情報を保存するテーブル
$usertb="usertb";
//掲示板のログを保存するテーブル
$logtb="logtb";

//テーブル logtbを作成
$sql="create table logtb"
."("
."id INT,"
."name char(32),"
."comment char(128),"
."time TEXT"
.");";
$stmt=$pdo->query($sql);
?>
</pre>
<pre>
<?php
//フォームに入力された値を変数に代入　sqlにログイン
     $name=$_POST['name'];
     $comment=$_POST['comment'];
	 $dsn='データベース名';
     $user='ユーザー名';
     $password='パスワード';
     $pdo=new PDO($dsn,$user,$password);
	 $usertb="usertb";
	 $logtb="logtb";

//コメント編集
if(!empty($_POST['name']) && !empty($_POST['comment']) && !empty($_POST['hidd'])){
	$id=$_POST['hidd'];
    $nm2=$name;
    $kome=$comment;
    $result=$pdo->query("update logtb set name='$nm2',comment='$kome' where id=$id");  
}
//コメント書き込み
if(!empty($_POST['name']) && !empty($_POST['comment']) && empty($_POST['hidd'])){
	$sql=$pdo->prepare("INSERT INTO logtb(id,name,comment,time)
    VALUES(:nm,:name,:comment,:time)");
	$results=$pdo->query('SELECT* FROM logtb ORDER BY id;');
	foreach($results as $row){
		$nms=$row['id'];
	}
	$sql->bindParam(':nm',$nms,PDO::PARAM_STR);
    $sql->bindParam(':name',$name,PDO::PARAM_STR);
    $sql->bindParam(':comment',$comment,PDO::PARAM_STR);
	$sql->bindParam(':time',$time,PDO::PARAM_STR);
	$nms=$nms+1;
	$name=$_POST['name'];
    $comment=$_POST['comment'];
	$time=date('Y年m月d日 H:i:s');
    $sql->execute();
}
//削除
if(!empty($_POST['bangou'])){       
	$id=$_POST['bangou'];
    $result=$pdo->query("delete from logtb where id=$id");
}
//編集選択出力
if(!empty($_POST['rewrite'])){
　　　　$nm2=$_POST['rewrite'];
	$results=$pdo->query('SELECT* FROM logtb ORDER BY id;');
    foreach($results as $row){
        if ($row['id']== $nm2){
			$hi=$row['id'];
			$name3=$row['name'];
			$massage3=$row['comment'];
        }
    }
}

?>
</pre>
<p>ユーザー名：<?php echo $_SESSION['usertb']['name'];?></p>
<form method="post">
<input type="hidden" name="name" value="<?php echo $_SESSION['usertb']['name']; ?>">
<p>コメント：<input type="text" name="comment" value="<?php echo $massage3; ?>"><br></p>
<input type="hidden" name="hidd" value="<?php echo $hi; ?>">
<input type="submit" value="送信">
</form>
<form method="post">
<p>編集番号：<input type="number" name="rewrite"><br></p>
<input type="submit" value="送信">
</form>
<form method="post">
<p>削除番号：<input type="number" name="bangou"><br></p>
<input type="submit" value="送信">
</form>
<pre>
<?php
//書き込み内容を出力
    if(!empty($_POST['name']) && !empty($_POST['comment']) || !empty($_POST['bangou'])){
      $dsn='データベース名';
      $user='ユーザー名';
      $password='パスワード';
      $pdo=new PDO($dsn,$user,$password);

      $results=$pdo->query('SELECT* FROM logtb ORDER BY id;');
	  foreach($results as $row){
	  echo $row['id'].' ';
	  echo $row['name'].' ';
	  echo $row['comment'].' ';
	  echo $row['time'].'<hr>';
	  }
     }
?>
</pre>
</body>
</html>