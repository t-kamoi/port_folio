<?php
	try{
		$db=new PDO('mysql:dbname=heroku_c5e50f79a7ca84c;host=us-cdbr-east-05.cleardb.net;charset=utf-8','b6a593ac39066f','019b21d7');
	} catch(PDOException $e){
		echo 'DB接続エラー：' . $e -> getMessage();
	}
?>