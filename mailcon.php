<?php session_start(); ?>
<?php require 'menu.php'; ?>
<?php
header("Content-Type: text/html; charset=UTF-8");
echo 'メール認証を行います。　受信可能なメールアドレスをご入力ください。';
echo '<form method="post">';
echo '<table>';
echo '<tr><td>受信を希望するメールアドレス</td><td>';
echo '<input type="text" name="mail">';
echo '</td></tr>';
echo '</table>';
echo '<input type="submit" value="送信">';
echo '</form>';
?>
<?php 
header("Content-Type: text/html; charset=UTF-8");
if( !empty($_POST['mail']) ){
	$mail=$_POST['mail'];
	$body = mt_rand(1000, 9999);
	mb_language('japanese');
	mb_internal_encoding('UTF-8');
	$from = '送信用メールアドレス';
	$subject = 'たそ姉の雑談室　メール認証コード';	
	
	$success = mb_send_mail($mail, $subject, $body, 'From: ' . $from);
}
else{
	echo 'メールアドレスをご入力ください。';
}
?>
<?php
header("Content-Type: text/html; charset=UTF-8");
echo '受信した4桁のコードをご入力ください。';
echo '<form method="post">';
echo '<table>';
echo '<tr><td>4桁の認証コード</td><td>';
echo '<input type="text" name="con">';
echo '<input type="hidden" name="rand" value="';
echo $body;
echo '">';
echo '</td></tr>';
echo '</table>';
echo '<input type="submit" value="送信">';
echo '</form>';
?>
<?php
header("Content-Type: text/html; charset=UTF-8");
if( (!empty($_POST['con'])) && (!empty($_POST['rand'])) ){
	$original = $_POST['rand'];
	$passcode = $_POST['con'];
	if($original==$passcode){
		echo '認証に成功しました。';
		echo '<a href="usertb-input.php">会員登録ページへ</a>';
		$_SESSION['mail']=1;
	}
	else{
		echo '認証に失敗しました。もう一度メールアドレスを入力してコードを取得してください。';
	}
}
else{
	echo '認証コードをご入力ください。';
}
	
	
?>
	


