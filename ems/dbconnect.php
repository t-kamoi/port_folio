<?php
		$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
		$server = $url["host"];
		$username = $url["user"];
		$password = $url["pass"];
		$db = substr($url["path"], 1);

	try{
		$conn = new PDO($server, $username, $password, $db);
		$conn -> set_charset('utf8');
	} catch(PDOException $e){
		echo 'DB接続エラー：' . $e -> getMessage();
	}
?>