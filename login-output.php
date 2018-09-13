<?php session_start(); ?>
<?php require 'menu.php'; ?>
<?php
header("Content-Type: text/html; charset=UTF-8");
unset($_SESSION['usertb']);

//sqlにログイン
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);
$results=$pdo->query('SELECT* FROM usertb ORDER BY id;');

//入力されたユーザー名とパスワードが一致しているか判定
foreach($results as $row){
    if ($row['name']== $_REQUEST['name'] && $row['password']== $_REQUEST['password']){
		$cnt=$cnt+1;
		$_SESSION['usertb'] = array(
							  'id' => $row['id'],
							  'name' => $row['name'],
							  'password' => $row['password']);
    }
    else{
    }
}
    if( $cnt==1 ){
	
		echo 'いらっしゃいませ、', $_SESSION['usertb']['name'],'さん。';
		echo '<a href="tasoudan.php"> 掲示板へ </a>';
		
	} 
	else{
		echo 'ログイン名またはパスワードが違います';
	}
?>



