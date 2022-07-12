<?php
	require('dbconnect.php');
	require('login_check.php');

	$userId = $_GET['view'];
	$joinUserId = $_SESSION['user_id'];
	$page = $_GET['page'];
	$eventId = $_GET['view'];
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
			<h3 class="my-4">ユーザー削除確認</h3>
			<?php
				// usersテーブルから特定IDのレコードを取得
				$getUser = $db->prepare('SELECT users.id AS user_id , users.login_id, users.name AS user_name , groups.id , groups.name AS group_name , user_types.name AS type_name FROM users , groups , user_types WHERE users.group_id=groups.id AND users.type_id=user_types.id AND users.id=?;;');
				$getUser->execute(array($_GET['view']));
				$userDetail = $getUser->fetch();

				?>
			<table class="table table-sm table-bordered">
				<tr>
					<th class="width_detail_user">ID</th>
					<td><?php print $userDetail['user_id']; ?></td>
				</tr>
				<tr>
					<th class="width_detail_user">氏名</th>
					<td><?php print $userDetail['user_name']; ?></td>
				</tr>
				<tr>
					<th class="width_detail_user">ログインID</th>
					<td><?php print $userDetail['login_id']; ?></td>
				</tr>
				<tr>
					<th class="width_detail_user">所属グループ</th>
					<td><?php print $userDetail['group_name']; ?></td>
				</tr>
				<tr>
					<th class="width_detail_user">ユーザータイプ</th>
					<td><?php print $userDetail['type_name']; ?></td>
				</tr>
			</table>
			<p>本当に削除してよろしいですか？</p>

			<a class="btn btn-secondary" role="button" href="detail_user.php?view=<?php print $userId; ?>&page=<?php print $page; ?>">キャンセル</a>
			<a class="btn btn-danger" role="button" href="delete_user_do.php?view=<?php print $userId; ?>">削除する</a>

		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>