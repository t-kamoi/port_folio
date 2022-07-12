<?php
	try{
		$db=new PDO('mysql:dbname=heroku_f7234f0c90c463f;host=us-cdbr-east-05.cleardb.net;cherset=utf-8','b0469157d54e5e','f378ace7');
	} catch(PDOException $e){
		echo 'DB接続エラー：' . $e -> getMessage();
	}
?>