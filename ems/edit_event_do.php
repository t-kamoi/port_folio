<?php
	require('dbconnect.php');
	require('login_check.php');

	$editTitle = $_SESSION['edit']['title'];
	$editStart = $_SESSION['edit']['start_time'];
	$editEnd = $_SESSION['edit']['end_time'];
	$editPlace = $_SESSION['edit']['place'];
	$editGroupCsv = implode(',',$_SESSION['edit']['subject_group']);
	$editDetail = $_SESSION['edit']['detail'];
	$editUser = $_SESSION['user_id'];

	$eventAdd = $db->prepare('UPDATE events SET title=? , start=? , end=? , place=? , group_id=? , detail=? , registered_by=? , created=NOW() WHERE id=?');
	$eventAdd->execute(array($editTitle , $editStart , $editEnd , $editPlace , $editGroupCsv , $editDetail , $editUser , $_GET['view']));
	unset($_SESSION['edit']);

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
			<h3 class="my-4">イベント登録</h3>
			<p>イベント登録完了</p>
			<a class="btn btn-outline-secondary" role="button" href="list_event.php">イベント一覧へ</a>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>