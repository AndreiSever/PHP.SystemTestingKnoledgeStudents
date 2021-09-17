<?php 

	global $db;
	$EFabc=new EFabc();
	$pass=$EFabc->user->sanitizeMySql($EFabc->route->getId());
	$result = mysqli_query($db,"SELECT * FROM change_email WHERE pass='".$pass."' and time>Now()")or die(mysql_error());
	$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo $myrow['id'];
	if (!empty($myrow['id']))	{
		mysqli_query($db,"UPDATE users SET email='".$myrow['new_email']."' WHERE id='".$myrow['id_user']."'") or die(mysql_error());
		header('Location: http://testloca.tk/users/confirmmess');	//"users/confirmmess " обычгый шаблон с сообщением 
	}else{
		header('Location: http://testlocal.net.host1582112.serv11.hostland.pro');
	}		
	

?> 