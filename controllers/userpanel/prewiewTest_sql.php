<?php
$EFabc = new EFabc();
if ($EFabc->user->getRole()== "user"){ 
	if (isset($_POST['start'])){
		global $db;
		$EFabc = new EFabc();
		$flag=1;
		$id=$EFabc->user->sanitizeMySql($EFabc->user->getId());
		$hash=$EFabc->user->sanitizeMySql($EFabc->user->getHash());
		$res = mysqli_query($db,"SELECT * FROM users WHERE id='".$id."' and hash_pass='".$hash."'")or die(mysql_error());
		$group=mysqli_fetch_array($res,MYSQLI_ASSOC);
		$res1 = mysqli_query($db,"SELECT * FROM list_students WHERE login='".$group['nickname']."'")or die(mysql_error());
		$group1=mysqli_fetch_array($res1,MYSQLI_ASSOC);
		$result = mysqli_query($db,"SELECT * FROM name_test WHERE id='".$EFabc->route->getId()."' and id_group='".$group1['id_group']."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if (!empty($myrow['id'])){
			$flag=0;
			$result1 = mysqli_query($db,"SELECT * FROM config_test WHERE id_name='".$myrow['id']."'")or die(mysql_error());
			while($myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
				$countconfig+=1;
				$maxcountconfig[$countconfig]=$myrow1['kolvo_quest'];
				$count=0;
				$result2 = mysqli_query($db,"SELECT * FROM question WHERE id_sub='".$myrow1['id_sub']."' and name<>'' and (var1<>'' or var2<>'' or var3<>'' or var4<>'' or var5<>'' or var6<>'') and (ans1<>'' or ans2<>'' or ans3<>'' or ans4<>'' or ans5<>'' or ans6<>'')")or die(mysql_error());
				while ($myrow2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
					$flag1=0;
					for ($g=1;$g<=6;$g++){
						if ($myrow2['ans'.$g]<>""){
							if (is_numeric($myrow2['ans'.$g]) && $myrow2['ans'.$g]<=6){
								if ($myrow2['var'.$myrow2['ans'.$g]]=="")
									$flag1=1;	
							}else{
								$flag1=1;
							}
						}
					}
					if ($flag1==0){
						$count+=1;
						$arrayquest[$countconfig][$count]=$myrow2['id'];
						//echo $arrayquest[$countconfig][$count];
					}
				}
				if ($count<$myrow1['kolvo_quest']){
					$flag=1;
				}
			}
		}
		if ($flag==1){
			echo "<mes>No</mes>";
		}

		if ($flag==0){
			
			$result3 = mysqli_query($db,"INSERT INTO starttest (id_name,id_user) VALUES('".$myrow['id']."','".$id."')") or die(mysql_error());
			$result4 = mysqli_query($db,"SELECT * FROM starttest WHERE id_name=".$myrow['id']." and id_user=".$id."")or die(mysql_error());
			$myrow4 = mysqli_fetch_array($result4,MYSQLI_ASSOC);
			$count11=count($maxcountconfig);
			for ($j=1;$j<=$count11;$j++){		
				shuffle($arrayquest[$j]);
				if ($maxcountconfig[$j]>1){
					//echo "fadfsdfsd";
					$rand_keys=array_rand($arrayquest[$j], $maxcountconfig[$j]);
					for ($i=0;$i<=$maxcountconfig[$j]-1;$i++){
						mysqli_query($db,"INSERT INTO save_question (id_start,id_question) VALUES('".$myrow4['id']."','".$arrayquest[$j][$rand_keys[$i]]."')") or die(mysql_error());
					}
				}else{
					//echo "12312313";
					mysqli_query($db,"INSERT INTO save_question (id_start,id_question) VALUES('".$myrow4['id']."','".$arrayquest[$j][0]."')") or die(mysql_error());
				}
			}
			echo "<mes>Ok</mes>";
		}
	}
}
?>