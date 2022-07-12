<?php
	require('dbconnect.php');
	require('login_check.php');
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
							<li class="nav-item px-3"><a class="nav-link active" aria-current="page" href="index.php">ホーム</a></li>
							<li class="nav-item px-3"><a class="nav-link" href="list_event.php">イベント一覧</a></li>
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
			<h3 class="my-4">本日のイベント</h3>
			<table class="table table-sm table-bordered">
				<thead>
					<tr>
						<th class="eventList_title" scope="col">タイトル</th>
						<th class="eventList_start" scope="col">開始日時</th>
						<th class="eventList_place" scope="col">場所</th>
						<th class="eventList_group" scope="col">対象グループ</th>
						<th class="eventList_detail" scope="col">詳細</th>
					</tr>
				</thead>
				<tbody>
					<?php
						// 日付指定の別案
						// $time = new DateTime();
						// $date = $time->format('Y-m-d 23:59:59');
						// var_dump($date);
						// 登録されたイベント情報一覧を取得する
						if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
							$page = $_REQUEST['page'];
						} else {
							$page = 1;
						}
						$start = 5 * ($page -1);
						$getEvent = $db->prepare('SELECT * , events.id as event_id FROM events , groups WHERE events.group_id=groups.id and start between date(now()) and date(now()) + interval "23:59:59" day_second ORDER BY events.id LIMIT ?,5;');
						$getEvent->bindParam(1 , $start , PDO::PARAM_INT);
						$getEvent->execute();
						while($eventList = $getEvent->fetch()):
					?>
					<tr>
						<td class="eventList_title"><?php print $eventList['title']; ?></td>
						<td class="eventList_start"><?php print $eventList['start']; ?></td>
						<td class="eventList_place"><?php print $eventList['place']; ?></td>
						<td class="eventList_group"><?php print $eventList['name']; ?></td>
						<td class="eventList_detail"><a class="btn btn-outline-primary btn-sm" role="button" href="detail_event.php?view=<?php print $eventList['event_id']; ?>&page=<?php print $page; ?>">開く</a></td>
					</tr>
					<?php endwhile; ?>

					<!-- ページング処理 -->
					<nav>
						<?php
							$counts = $db->query('SELECT COUNT(*) AS cnt FROM events WHERE start between date(now()) and date(now()) + interval "23:59:59" day_second');
							$count = $counts->fetch();
							$max_page = ceil($count['cnt'] / 5);
						?>
						<div class="list_count mb-2">
							全件数：<?php echo $count['cnt']; ?> 件
						</div>
						<ul class="pagination mb-2">
							<?php if($page >= 2): ?>
								<li class="page-item"><a class="page-link" href="index.php?page=<?php print($page-1); ?>"><</a></li>
							<?php else: ?>
								<li class="page-item"><a class="page-link" href="#"><</a></li>
							<?php endif; ?>
								
							<?php for($i=1; $i <= $max_page; $i++): ?>
								<?php if($i==$page): ?> 
									<li class="page-item active" aria-current="page"><a class="page-link" href="#"><?php print $page; ?></a></li>
								<?php else: ?>
									<li class="page-item"><a class="page-link" href="index.php?page=<?php print $i; ?>"><?php print $i; ?></a></li>
								<?php endif; ?>
							<?php endfor; ?>
										
							<?php if($page < $max_page): ?>
								<li class="page-item"><a class="page-link" href="index.php?page=<?php print($page+1); ?>">></a></li>
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