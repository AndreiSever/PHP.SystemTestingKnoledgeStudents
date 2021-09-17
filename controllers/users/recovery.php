<?php 

if (isset($_POST['email'])) {
	global $db;
	$EFabc=new EFabc();
	$email=$_POST['email'];
	$email=$EFabc->user->sanitizeMySql($email);
	$result = mysqli_query($db,"SELECT * FROM users WHERE email='".$email."'")or die(mysql_error());
	$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	
	if (!empty($myrow['id']))	{
		$random=$EFabc->user->generateCode(10);
		$EFabc->auth->recovery($email, $random);
		$random=sha1("Не бейте".$random."я новичок");;//sha1("Не бейте".$random."я новичок");
		$posted = mysqli_query($db,"UPDATE `users` SET `password`='".$random."' WHERE `id`='".$myrow['id']."'") or die(mysql_error());
		header('Location: http://testlocal.net.host1582112.serv11.hostland.pro');	
	}			
}	
?> 
