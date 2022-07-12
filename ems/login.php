<?php
	require('dbconnect.php');
	session_start();

	// ログインボタンが押された時、以下の処理を実行する
	if(!empty($_POST)){
		// ログインIDとパスワードの入力チェック
		if($_POST['login_id'] != '' && $_POST['login_pass'] != ''){
			// 入力された内容をDBに問い合せ、結果を$userに代入
			$login = $db->prepare('SELECT * FROM users where login_id=? and login_pass=?');
			$login->execute(array($_POST['login_id'] , sha1($_POST['login_pass'])));
			$user = $login->fetch();
			
			// ログイン成功時の処理（$userに中身が入っていた場合、データベースに登録されたidカラムの値をセッションに代入する）
			if($user){
				$_SESSION['user_name'] = $user['name'];
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['user_type_id'] = $user['type_id'];
				$_SESSION['time_now'] = time();

				header('Location:index.php');
			}else{
				$error['login'] = 'failed';
			}
		}else{
		$error['login'] = 'blank';
		}
	}
	
	// 入力値復元用の変数に初期値として空白をセット
	if(empty($_POST)){
		$error['login'] = '';
		$_POST['login_id'] = '';
		$_POST['login_pass'] = '';
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
	<div class="wrapper">
		<header>
			<a href="login.php"><img src="image/title.png" alt=""></a>
		</header>
		<div class="login-form">
			<h3 class="my-4">ログイン</h3>
			<form action="" method="post">
				<?php if($error['login'] == 'blank'): ?>
					<p><span class="font_red">ログインIDとパスワードを入力して下さい</span></p>
				<?php endif; ?>
				<?php if($error['login'] == 'failed'): ?>
					<p><span class="font_red">ログインIDまたはパスワードが間違っています</span></p>
				<?php endif; ?>
				<input type="text" name="login_id" class="form-control mb-4" placeholder="ログインID" value="<?php echo htmlspecialchars($_POST['login_id'] , ENT_QUOTES) ?>">
				<input type="password" name="login_pass" class="form-control mb-4" placeholder="パスワード" value="<?php echo htmlspecialchars($_POST['login_pass'] , ENT_QUOTES) ?>">
				<div class="d-grid gap-2">
					<input type="submit" name="login_button" class="btn btn-primary" value="ログインする">
				</div>
			</form>
		</div>
	</div>
</body>
</html>