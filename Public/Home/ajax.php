<?php 
		header("content-type:text/html;charset=utf-8");

		$pdo = new PDO("mysql:host=localhost;dbname=danrukou","root","123456");
		$pdo->exec("set names utf8");


		$user = $_GET['user'];
		$sql = "select * from ts_user where username='$user'";
		if($pdo->query($sql)->rowCount()>=1){
			//用户名已被注册
			echo "false";
		}else{
			//用户名未被注册
			echo "true";
		}
 ?>