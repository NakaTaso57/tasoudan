<?php session_start(); ?>
<?php require 'menu.php'; ?>
<?php
header("Content-Type: text/html; charset=UTF-8");

//セッションが維持されていればセッションunset
if (isset($_SESSION['usertb'])) {
	unset($_SESSION['usertb']);
	echo 'ログアウトしました。';
} else {
	echo 'すでにログアウトしています。';
}
?>


