<?php
	require('dbconnect.php');
	require('login_check.php');
	require('htmlspecialchars.php');
	
	// 未記入フォームの有無をチェック
	if(!empty($_POST)){
		if($_POST['name'] == ""){
			$error['name'] = 'blank';
		}
		if($_POST['login_id'] == ""){
			$error['login_id'] = 'blank';
		}
		if($_POST['login_pass'] == ""){
			$error['login_pass'] = 'blank';
		}
		if(empty($_POST['type_id'])){
			$error['type_id'] = 'blank';
			$_POST['type_id'] = "";
		}
		if(!isset($error)){
			$_SESSION['join'] = $_POST;
			header('Location:regist_user_do.php');
			exit;
		}
	}

	// 入力値復元用の変数に初期値として空白をセット
	if(empty($_POST)){
		$_POST['name'] = "";
		$_POST['login_id'] = "";
		$_POST['login_pass'] = "";
		$_POST['type_id'] = "";
	}

	// プルダウンメニューの入力値復元用
	$groupSelect = $db->prepare('SELECT * FROM groups');
	$groupSelect->execute();
	while($groupList = $groupSelect->fetch()):
		$list[] = $groupList['id'];
	endwhile;

	$selected['listItem'] = $list;
	$lastElementNumber = end($selected['listItem']);
	for($i=0; $i<$lastElementNumber; $i++ ){
		if(isset($_POST['group_id'])){
			if($_POST['group_id']-1 == $i){
				$selected['listItem'][$i] = " selected";
			}else{
				$selected['listItem'][$i] = "";
			}
		}
	};
	// echo '<pre>';
	// var_dump($_POST['group_id']);
	// var_dump($lastElementNumber);
	// var_dump($selected);
	// echo '</pre>';

	// foreach($_POST['group_id'] as $value){
	// 	$selected['listItem'][$value] = " selected";
	// }
			
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
							<li class="nav-item px-3"><a class="nav-link active" aria-current="page" href="regist_user.php">新規ユーザー登録</a></li>
							<li class="nav-item px-3"><a class="nav-link" href="list_user.php">ユーザー管理</a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<main>
			<h3 class="my-4">ユーザー登録</h3>
			<form action="" method="post">
				<!-- 氏名入力フォーム -->
				<?php if(isset($error['name'])): ?>
					<div class="mb-4">
						<label for="inputName" class="form-label">氏名<span class="font_red">（必須）</span></label>
						<input type="text" name="name" class="form-control is-invalid" id="inputName">
						<div class="invalid-feedback">氏名を入力して下さい</div>
					</div>
				<?php else: ?>
					<div class="mb-4">
						<label for="inputName" class="form-label">氏名<span class="font_red">（必須）</span></label>
						<input type="text" name="name" class="form-control" id="inputName" value="<?php print $_POST['name']; ?>">
					</div>
				<?php endif; ?>

				<!-- ログインID入力フォーム -->
				<?php if(isset($error['login_id'])): ?>
					<div class="mb-4">
						<label for="inputLoginid" class="form-label">ログインID<span class="font_red">（必須）</span></label>
						<input type="text" name="login_id" class="form-control is-invalid" id="inputLoginid">
						<div class="invalid-feedback">ログインIDを入力して下さい</div>
					</div>
				<?php else: ?>
					<div class="mb-4">
						<label for="inputLoginid" class="form-label">ログインID<span class="font_red">（必須）</span></label>
						<input type="text" name="login_id" class="form-control" id="inputLoginid" value="<?php print $_POST['login_id']; ?>">
					</div>
				<?php  endif; ?>

				<!-- パスワード入力フォーム -->
				<?php if(isset($error['login_pass'])): ?>
					<div class="mb-4">
						<label for="inputLoginpass" class="form-label">パスワード<span class="font_red">（必須）</span></label>
						<input type="text" name="login_pass" class="form-control is-invalid" id="inputLoginpass">
						<div class="invalid-feedback">パスワードを入力して下さい</div>
					</div>
				<?php else: ?>
					<div class="mb-4">
						<label for="inputLoginpass" class="form-label">パスワード<span class="font_red">（必須）</span></label>
						<input type="text" name="login_pass" class="form-control" id="inputLoginpass" value="<?php print $_POST['login_pass']; ?>">
					</div>
					<?php endif; ?>

				<!-- 所属グループ選択フォーム -->
				<label for="inputGroupid" class="form-label">所属グループ<span class="font_red">（必須）</span></label>
				<select name="group_id" class="form-select form-select-lg mb-3" id="inputGroupid" >
						<?php
							$groupSelect = $db->prepare('SELECT * FROM groups');
							$groupSelect->execute();
							while($groupList = $groupSelect->fetch()):
						?>
					<option value="<?php print $groupList['id']; ?>" <?php print $selected['listItem'][$groupList['id']-1]; ?>><?php print $groupList['name']; ?></option>
						<?php endwhile; ?>
				</select>
				
				<!-- ユーザー区分選択フォーム -->
				<label for="inputUsertype" class="form-label">ユーザー区分<span class="font_red">（必須）</span></label>
				<?php
					$userTypeSelect = $db->prepare('SELECT * FROM user_types');
					$userTypeSelect->execute();
					while($userTypeList = $userTypeSelect->fetch()):
				?>
					<div class="form-check">
						<input type="radio" name="type_id" class="form-check-input" id="inputUsertype<?php print $userTypeList['id']; ?>" value="<?php print $userTypeList['id']; ?>" <?php $_POST['type_id'] == $userTypeList['id'] ? print 'checked' : ''; ?>>
						<label for="inputUsertype<?php print $userTypeList['id']; ?>" class="form-check-label"><?php print $userTypeList['name']; ?></label>
					</div>
				<?php endwhile; ?>
					<?php isset($error['type_id']) ? print '<span class="font_red">ユーザー区分を選択して下さい</span>' : ""; ?>
				
				<!-- 登録ボタン・キャンセルボタン -->
				<div class="my-4">	
					<input type="submit" class="btn btn-primary" value="登録">
					<a class="btn btn-secondary" href="index.php" role="button">ホームへ戻る</a>
				</div>
			</form>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>