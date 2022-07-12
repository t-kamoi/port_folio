<?php
	require('dbconnect.php');
	require('login_check.php');
	require('htmlspecialchars.php');
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
							<li class="nav-item px-3"><a class="nav-link" href="list_event.php">イベント一覧</a></li>
							<li class="nav-item px-3"><a class="nav-link" href="regist_event.php">新規イベント登録</a></li>
							<?php if($_SESSION['user_type_id'] == "2"): ?>
							<li class="nav-item px-3"><a class="nav-link" href="regist_user.php">新規ユーザー登録</a></li>
							<li class="nav-item px-3"><a class="nav-link active" aria-current="page" href="list_user.php">ユーザー管理</a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<main>
			<h3 class="my-4">ユーザー一覧</h3>
			<table class="table table-sm table-bordered">
				<thead>
					<tr class="width_list_user">
						<th class="userList_id">ID</th>
						<th class="userList_name">氏名</th>
						<th class="userList_groupid">所属グループ</th>
						<th class="userList_typeid">ユーザータイプ</th>
						<th class="userList_detail">詳細</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
							$page = $_REQUEST['page'];
						} else {
							$page = 1;
						}
						$start = 5 * ($page -1);
						$getUsers = $db->prepare('SELECT users.id , users.name , group_id , type_id , groups.name AS group_name , user_types.name AS type_name FROM users , groups , user_types WHERE groups.id = users.group_id AND users.type_id = user_types.id ORDER BY users.id DESC LIMIT ?,5;');
						$getUsers->bindParam(1 , $start , PDO::PARAM_INT);
						$getUsers->execute();
						while($userList = $getUsers->fetch()):
					?>
						<tr>
							<td class="width_userList_id"><?php print $userList['id']; ?></td>
							<td class="width_userList_name"><?php print h($userList['name']); ?></td>
							<td class="width_userList_groupid"><?php print h($userList['group_name']); ?></td>
							<td class="width_userList_typeid"><?php print h($userList['type_name']); ?></td>
							<td class="width_userList_detail"><a class="btn btn-outline-primary btn-sm" role="button" href="detail_user.php?view=<?php print h($userList['id']); ?>&page=<?php print $page; ?>">開く</a></td>
						</tr>
					<?php endwhile; ?>

					<!-- ページング処理 -->
					<nav>
						<?php
							$counts = $db->query('SELECT COUNT(*) AS cnt FROM users');
							$count = $counts->fetch();
							$max_page = ceil($count['cnt'] / 5);
						?>
						<div class="list_count mb-2">
							登録ユーザー数： <?php echo $count['cnt']; ?> 名
						</div>
						<ul class="pagination mb-2">
							<?php if($page >= 2): ?>
								<li class="page-item"><a class="page-link" href="list_user.php?page=<?php print($page-1); ?>"><</a></li>
							<?php else: ?>
								<li class="page-item"><a class="page-link" href="#"><</a></li>
							<?php endif; ?>

							<?php for($i=1; $i <= $max_page; $i++): ?>
								<?php if($i==$page): ?>
									<li class="page-item active" aria-current="page"><a class="page-link" href="#"><?php print $page; ?></a></li>
								<?php else: ?>
									<li class="page-item"><a class="page-link" href="list_user.php?page=<?php print $i; ?>"><?php print $i; ?></a></li>
								<?php endif; ?>
							<?php endfor; ?>

							<?php if($page < $max_page): ?>
								<li class="page-item"><a class="page-link" href="list_user.php?page=<?php print($page+1); ?>">></a></li>
							<?php else: ?>
								<li class="page-item"><a class="page-link" href="#">></a></li>
							<?php endif; ?>
						</ul>
					</nav>
				</tbody>
			</table>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>