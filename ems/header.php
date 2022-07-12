<div class="title-area">
	<div class="logo">
		<a href="index.php"><img src="image/title.png" alt=""></a>
	</div>
	<ul>
		<li class="nav-item dropdown mt-3">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img class="user-icon" src="image/icon_user.png" alt=""><?php print $_SESSION['user_name']; ?></a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
				<li><a class="dropdown-item" href="#">マイページ（未実装）</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="logout.php">ログアウト</a></li>
			</ul>
		</li>
	</ul>
</div>

