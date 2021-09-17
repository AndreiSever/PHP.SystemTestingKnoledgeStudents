<?php
//echo"fdsfd";
	if ((isset($_POST['nickname']))&&(isset($_POST['password']))) {
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];
		//$EFabc = new EFabc();
		$user = new user();
		
		$nickname=$user->sanitizeMySql($nickname);
		$password=$user->sanitizeMySql($password);
		//echo $password;
		$user->authorization($nickname, $password);
		header('Location:  http://testlocal.net.host1582112.serv11.hostland.pro');
	}
?>