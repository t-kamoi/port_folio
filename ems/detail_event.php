<?php
	require('dbconnect.php');
	require('login_check.php');
	require('htmlspecialchars.php');

	$page = $_GET['page'];
	$eventId = $_GET['view'];
	$joinUserId = $_SESSION['user_id'];
	
	// ログインユーザーが参加済みのイベントかチェック
	$selectJoin = $db->prepare('SELECT * , count(*) FROM attends WHERE event_id=? AND user_id=? ');
	$selectJoin->execute(array($eventId , $joinUserId));
	$checkJoin = $selectJoin->fetch();
	
	if($checkJoin['count(*)'] > 0){
		$check['join'] = 'done';
	}else{
		$check['join'] = 'none';
	}
	
	// 参加ボタンが押された時の処理|未参加の時attendテーブルにユーザーID番号とイベントID番号を挿入する|参加済みの時削除する
	if(isset($_POST['join'])){
		if($check['join'] == 'done'){
			$deleteJoinUser = $db->prepare('DELETE FROM attends WHERE user_id=? and event_id=?');
			$deleteJoinUser->execute(array($joinUserId , $eventId));
			$check['join'] = 'none';
		}else{
			$sendJoinUser = $db->prepare('INSERT INTO attends SET user_id=? , event_id=?');
			$sendJoinUser->execute(array($joinUserId , $eventId));
			$check['join'] = 'done';
		}
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
			<h3 class="my-4">イベント詳細</h3>
			<?php
				// eventsテーブルから特定IDのレコードを取得
				$getEvent = $db->prepare('SELECT * FROM events , groups where events.id=? AND groups.id = events.group_id;');
				$getEvent->execute(array($_GET['view']));
				$eventDetail = $getEvent->fetch();

				?>
			<table class="table table-sm table-bordered">
				<tr>
					<th>タイトル</th>
					<td>
						<?php
							if($check['join'] == 'done'){
								print h($eventDetail['title']) . " " . '<span class="badge text-bg-success">参加</span>';
							}else{
								print h($eventDetail['title']) ;
							}
						?>
					</td>
				</tr>
				<tr>
					<th>開始日時</th>
					<td><?php print  date("Y/m/d H:i" , strtotime(h($eventDetail['start']))); ?></td>
				</tr>
				<tr>
					<th>終了日時</th>
					<td><?php print $eventDetail['end'] == "0000-00-00 00:00:00" ? "未定" : date("Y/m/d H:i" , strtotime(h($eventDetail['end']))); ?></td>
				</tr>
				<tr>
					<th>場所</th>
					<td><?php print h($eventDetail['place']); ?></td>
				</tr>
				<tr>
					<th>対象グループ</th>
					<td>
						<?php
							$arrayGroupList = explode(',',$eventDetail['group_id']);
							foreach($arrayGroupList as $value){
								$getGroupName = $db->prepare('SELECT * FROM groups WHERE id=?');
								$getGroupName->execute(array($value));
								$groupName = $getGroupName->fetch();
								print h($groupName['name']) . " ";
							}
						?>	
					</td>
				</tr>
				<tr>
					<th>詳細</th>
					<td><?php print h($eventDetail['detail']); ?></td>
				</tr>
				<tr>
					<th>登録者</th>
					<td>
						<?php
							$selectRegistUser = $db->prepare('SELECT * FROM events , users WHERE events.id=? AND events.registered_by=users.id');
							$selectRegistUser->execute(array($eventId));
							$registUser = $selectRegistUser->fetch();
							print h($registUser['name']);
						?>
					</td>
				</tr>
				<tr>
					<th>*参加者*</th>
					<td>
						<?php
							$selectJoinUser = $db->prepare('SELECT * FROM attends , users WHERE attends.event_id=? AND attends.user_id=users.id');
							$selectJoinUser->execute(array($eventId));
							while($joinUser = $selectJoinUser->fetch()){
								print h($joinUser['name']) . "/";
							}
						?>
					</td>
				</tr>
			</table>

			<!-- 参加ボタン -->
			<form action="" method="post" class="mb-4">
				<?php if($check['join'] == 'done'): ?>
					<input type="submit" class="btn btn-success" name="join" value="参加を取り消す">
				<?php else: ?>
					<input type="submit" class="btn btn-outline-success" name="join" value="参加">
				<?php endif; ?>
			</form>
			
			<!-- 戻る・編集・削除ボタン -->
			<?php if($registUser['id'] == $_SESSION['user_id'] || $_SESSION['user_type_id'] == '2'): ?>
				<a class="btn btn-info" href="edit_event.php?view=<?php print $eventId; ?>&page=<?php print $page; ?>">編集</a>
				<a class="btn btn-danger" href="delete_event_check.php?view=<?php print $eventId; ?>&page=<?php print $page; ?>">削除</a>
			<?php endif; ?>
			<a class="btn btn-secondary" role="button" href="list_event.php?page=<?php print $_GET['page']; ?>">一覧に戻る</a>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>