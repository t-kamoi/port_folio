<?php
	require('dbconnect.php');
	require('login_check.php');
	
	// 未記入フォームの有無をチェック
	if(!empty($_POST)){
		if($_POST['title'] == ''){
			$error['title'] = 'blank';
		}
		if($_POST['start_time'] == ''){
			$error['start_time'] = 'blank';
		}
		if($_POST['place'] == ''){
			$error['place'] = 'blank';
		}
		if(empty($_POST['subject_group'])){
			$error['subject_group'] = 'blank';
		}
		if(!isset($error)){
			$_SESSION['regist'] = $_POST;
			header('Location:regist_event_do.php');
			exit;
		}
	}

	// 入力値復元用の変数に初期値として空白をセット
	if(empty($_POST)){
		$_POST['title'] = "";
		$_POST['start_time'] = "";
		$_POST['place'] = "";
	}

	// チェックボックスの入力値復元用
	$groupSelect = $db->prepare('SELECT * FROM groups');
	$groupSelect->execute();
	while($groupList = $groupSelect->fetch()):
		$list[] = $groupList['id'];
	endwhile;

	$checked['listItem'] = $list;
	$lastElementNumber = end($checked['listItem']);
	if(isset($_POST['subject_group'])){
		for($i=0; $i<$lastElementNumber; $i++ ){
			$checked['listItem'][$i] = "";
		}
		foreach($_POST['subject_group'] as $value){
			$checked['listItem'][$value-1] = " checked";
		}
	};
	// echo '<pre>';
	// var_dump($_POST['subject_group']);
	// var_dump($lastElementNumber);
	// var_dump($checked);
	// echo '</pre>';


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
							<li class="nav-item px-3"><a class="nav-link active" aria-current="page" href="regist_event.php">新規イベント登録</a></li>
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
			<form action="" method="post">
				<!-- タイトル入力フォーム -->
				<?php if(isset($error['title'])): ?>
					<div class="mb-4">
						<label for="inputTitle" class="form-label">タイトル<span class="font_red">（必須）</span></label>
						<input type="text" name="title" class="form-control is-invalid" id="inputTitle">
						<div class="invalid-feedback">タイトルを入力して下さい</div>
					</div>
				<?php else: ?>
					<div class="mb-4">
						<label for="inputTitle" class="form-label">タイトル<span class="font_red">（必須）</span></label>
						<input type="text" name="title" class="form-control" id="inputTitle" value="<?php print $_POST['title']; ?>">
					</div>
				<?php endif; ?>

				<!-- 開始日時入力フォーム -->
				<?php if(isset($error['start_time'])): ?>
					<div class="mb-4">
						<label for="inputStarttime" class="form-label">開始日時<span class="font_red">（必須）</span></label>
						<input type="datetime-local" name="start_time" class="form-control is-invalid" id="inputStarttime">
						<div class="invalid-feedback">開始日時を入力して下さい</div>
					</div>
				<?php else: ?>
					<div class="mb-4">
						<label for="inputStarttime" class="form-label">開始日時<span class="font_red">（必須）</span></label>
						<input type="datetime-local" name="start_time" class="form-control" id="inputStarttime" value="<?php print $_POST['start_time']; ?>">
					</div>
				<?php endif; ?>
				
				<!-- 終了日時入力フォーム -->
				<div class="mb-4">
					<label for="exampleInputEndtime" class="form-label">終了日時（未入力の場合”未定”になります）</label>
					<input type="datetime-local" name="end_time" class="form-control" id="exampleInputEndtime">
				</div>

				<!-- 場所入力フォーム -->
				<?php if(isset($error['place'])): ?>
					<div class="mb-4">
						<label for="inputPlace" class="form-label">場所<span class="font_red">（必須）</span></label>
						<input type="text" name="place" class="form-control is-invalid" id="inputPlace">
						<div class="invalid-feedback">場所を入力して下さい</div>
					</div>	
				<?php else: ?>
					<div class="mb-4">
						<label for="inputPlace" class="form-label">場所<span class="font_red">（必須）</span></label>
						<input type="text" name="place" class="form-control" id="inputPlace" value="<?php print $_POST['place']; ?>">
					</div>
				<?php endif; ?>

				<!-- 対象グループチェックフォーム -->
				<div class="mb-4">
					<label for="groupsCheckbox" class="form-label">対象グループ<span class="font_red">（必須）</span></label>
					<?php
							$groupSelect = $db->prepare('SELECT * FROM groups');
							$groupSelect->execute();
							while($groupList = $groupSelect->fetch()):
						?>
							<div class="form-check">
								<input class="form-check-input" id="groupsCheckbox" type="checkbox" name="subject_group[]" value="<?php print $groupList['id']; ?>" <?php print $checked['listItem'][$groupList['id']-1]; ?>> <?php print $groupList['name']; ?>
								<label class="form-check-label" for="groupsCheckbox"></label>
							</div>
							<?php endwhile; ?>
					<?php if(isset($error['subject_group'])): ?>
						<p><span class="font_red">対象グループを選択して下さい</span></p>
					<?php endif; ?>
				</div>
				
				<!-- 詳細入力フォーム -->
				<div class="mb-4">
					<label for="detail">詳細</label>
					<textarea class="form-control" name="detail" id="detail" cols="30" rows="10"></textarea>
				</div>
				
				<div class="mb-5">	
					<input type="submit" class="btn btn-primary" value="登録">
					<a class="btn btn-secondary" href="index.php" role="button">ホームへ戻る</a>
				</div>
			</form>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>