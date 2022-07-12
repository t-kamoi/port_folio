<?php
	session_start();

	// セッション情報を削除
	$_SESSION =array();
	if(ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name() , '' , time() - 42000 , $params["path"] , $params["domain"] , $params["secure"] , $params["httponly"]);
	}
	session_destroy();

	// cookie情報も削除
	setcookie('email' , '' , time()-3600);
	setcookie('password' , '' , time()-3600);

	header('Location: login.php');
	exit();
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
			<h1>タイトル</h1>
		</header>
	</div>
</body>
</html>