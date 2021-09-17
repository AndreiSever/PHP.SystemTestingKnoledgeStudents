<?php 
//echo "1";
//echo var_dump($_POST);
$EFabc = new EFabc();
if ($EFabc->user->privateRoleOnly()){ 
	//if (isset($_POST['edit'])){ 
		if ((isset($_POST['login']))&&(isset($_POST['forename']))&&(isset($_POST['name']))&&(isset($_POST['thirdname'])))
			{
				$nickname=$_POST['login'];
				$forename=$_POST['forename'];
				$name=$_POST['name'];
				$thirdname=$_POST['thirdname'];
				$email=$_POST['email'];
				$_POST['login']="";
				$_POST['forename']="";
				$_POST['name']="";
				$_POST['thirdname']="";
				$nickname=$EFabc->user->sanitizeMySql($nickname);
				$forename=$EFabc->user->sanitizeMySql($forename);
				$name=$EFabc->user->sanitizeMySql($name);
				$thirdname=$EFabc->user->sanitizeMySql($thirdname);
				$email=$EFabc->user->sanitizeMySql($email);
				$id=$EFabc->user->sanitizeMySql($EFabc->user->getId());
				$hash=$EFabc->user->sanitizeMySql($EFabc->user->getHash());
				$flag=0;
				$flag1=0;
				global $db;
				$result = mysqli_query($db,"SELECT * FROM users WHERE nickname='".$nickname."' and id<>'".$id."' and hash_pass<>'".$hash."'")or die(mysql_error());
				$myrow=mysqli_fetch_array($result,MYSQLI_ASSOC);
				if (empty($myrow['id'])){
					$result2 = mysqli_query($db,"SELECT * FROM users WHERE nickname='".$nickname."' and secondname='".$forename."' and name='".$name."' and thirdname='".$thirdname."'")or die(mysql_error());
					$myrow2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
					if (empty($myrow2['id'])){
						mysqli_query($db,"UPDATE users SET nickname='".$nickname."', secondname='".$forename."', name='".$name."',thirdname='".$thirdname."' WHERE id='".$id."' and hash_pass='".$hash."'")or die(mysql_error());
						echo "<mes>Ok</mes>";
						$flag=1;
					}
				}else{
					$flag=1;
					echo "<mes>No</mes>";
				}
				//$data=mysqli_fetch_array($result,MYSQLI_ASSOC);
				if ((isset($_POST['oldPassword']))&&(isset($_POST['password']))&&(isset($_POST['password2']))){
					$passwordOld=$_POST['oldPassword'];
					$passwordNew=$_POST['password'];
					$passwordReapet=$_POST['password2'];
					$passwordOld=$EFabc->user->sanitizeMySql($passwordOld);
					$passwordNew=$EFabc->user->sanitizeMySql($passwordNew);
					$passwordReapet=$EFabc->user->sanitizeMySql($passwordReapet);
					if (($passwordNew !=="") && ($passwordReapet !=="")&&($passwordReapet==$passwordNew)){
						$passwordOld=sha1("Не бейте".$passwordOld."я новичок");//$passwordOld=sha1("Не бейте".$passwordOld."я новичок");
						$result = mysqli_query($db,"SELECT * FROM users WHERE password='".$passwordOld."' and id='".$id."' and hash_pass='".$hash."'")or die(mysql_error());
						$pass=mysqli_fetch_array($result,MYSQLI_ASSOC);
						if (!empty($pass['id'])){
							$passwordNew=sha1("Не бейте".$passwordNew."я новичок");//$passwordNew=sha1("Не бейте".$passwordNew."я новичок");
							$result = mysqli_query($db,"UPDATE users SET password='".$passwordNew."' WHERE id='".$id."' and hash_pass='".$hash."'")or die(mysql_error());
							echo "<mespass>Okpass</mespass>";
							$flag1=1;
						}else{
							$flag1=1;
							echo "<mespass>Nopass</mespass>";
						}
					}
				}
				if ((isset($_POST['email']))&&($email!=="")){
					$email=$EFabc->user->sanitizeMySql($email);
					$result = mysqli_query($db,"SELECT * FROM users WHERE email='".$email."'")or die(mysql_error());
					$myrow=mysqli_fetch_array($result,MYSQLI_ASSOC);
					if (empty($myrow['id'])){
						$id=$EFabc->user->sanitizeMySql($EFabc->user->getId());
						$hash=$EFabc->user->sanitizeMySql($EFabc->user->getHash());
						$result1 = mysqli_query($db,"SELECT * FROM users WHERE id='".$id."' and hash_pass='".$hash."'")or die(mysql_error());
						$myrow1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
						if (!empty($myrow1['id'])){
							do{
								$pass=$EFabc->user->generateNumber(10);
								$result2 = mysqli_query($db,"SELECT * FROM change_email WHERE pass='".$pass."'")or die(mysql_error());
								$myrow2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
							}while (!empty($myrow2['id']));
							$date = new DateTime();
							$date->add(new DateInterval('PT5M'));
							$date =$date->format('Y-m-d H:i:s');
							mysqli_query($db,"INSERT INTO change_email (id_user,pass,new_email,time) VALUES('".$id."','".$pass."','".$email."','".$date."')") or die(mysql_error());
							$EFabc->auth->confirm($email, $pass);
							echo "<mesemail>Ok</mesemail>";
						}
					}else{
						echo "<mesemail>No</mesemail>";
					}
					//«десь дописать отправку письма с изменением почты
				}else{
					echo "<mesemail>Default</mesemail>";
				}
				if ($flag==0){
					echo "<mes>Default</mes>";
				}
				if ($flag1==0){
					echo "<mespass>Default</mespass>";
				}
			}
	//}
}
?>