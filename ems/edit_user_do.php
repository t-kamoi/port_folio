<?php
	require('dbconnect.php');
	require('login_check.php');

	$editName = $_SESSION['edit']['name'];
	$editLoginId = $_SESSION['edit']['login_id'];
	$editLoginPass = $_SESSION['edit']['login_pass'];
	$editGroupId = $_SESSION['edit']['group_id'];
	// var_dump($editLoginPass);
	// exit;
	if($editLoginPass == ''){
		$userUpdate = $db->prepare('UPDATE users SET name=? , login_id=? , group_id=? , created=NOW() WHERE id=?');
		$userUpdate->execute(array($editName , $editLoginId , $editGroupId , $_GET['view']));
		unset($_SESSION['edit']);
	}else{
		$userUpdate = $db->prepare('UPDATE users SET name=? , login_id=? , login_pass=? , group_id=? , created=NOW() WHERE id=?');
		$userUpdate->execute(array($editName , $editLoginId , sha1($editLoginPass) , $editGroupId , $_GET['view']));
		unset($_SESSION['edit']);
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
			<?php require('header.php'); ?>
			<nav class="navbar navbar-expand-lg navbar-dark bg-primary my-3">
				<div class="container-fluid">
					<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent2">
						<ul class="navbar-nav mb-2 mb-lg-0">
							<li class="nav-item px-3"><a class="nav-link" href="index.php">ホーム</a></li>
							<li class="nav-item px-3"><a class="nav-link active" aria-current="page" href="list_event.php">イベント一覧</a></li>
							<li class="nav-item px-3"><a class="nav-link" href="regist_event.php">新規イベント登録</a></li>
							<?php if($_SESSION['user_type_id'] == "2"): ?>
							<li class="nav-item px-3"><a class="nav-link" href="regist_user.php">新規ユーザー登録</a></li>
							<li class="nav-item px-3"><a class="nav-link" href="list_user.php">ユーザー管理</a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<main>
			<h3 class="my-4">ユーザー編集</h3>
			<p>ユーザー編集完了</p>
			<a class="btn btn-outline-secondary" role="button" href="list_user.php">一覧へ戻る</a>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>