<?php
	session_start();
	// *ログイン状態のチェック* $_SESSION['login_id]に値がある＆ログインしてから60分以内であるか
	if(isset($_SESSION['user_id']) && $_SESSION['time_now'] + 3600 > time()){
	
		// 現在ログイン中ユーザーの登録情報をDBから取得し、セッションを更新する
		$getUserRecord = $db->prepare('SELECT * FROM users where id=?');
		$getUserRecord->execute(array($_SESSION['user_id']));
		$userName = $getUserRecord->fetch();
		$_SESSION['user_name'] = $userName['name'];
		$_SESSION['user_id'] = $userName['id'];
		$_SESSION['user_type_id'] = $userName['type_id'];
		$_SESSION['time_now'] = time();
		
	}else{
		header('Location:login.php');
		exit;
	}
?>