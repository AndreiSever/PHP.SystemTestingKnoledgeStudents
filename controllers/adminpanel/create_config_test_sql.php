<?php
$EFabc = new EFabc();
if ($EFabc->user->privateRoleOnly()){ 
	if (isset($_POST['change'])){
		$EFabc = new EFabc();
		global $db;
		$id=$_POST['id'];
		$id=$EFabc->user->sanitizeMySql($id);
		$result = mysqli_query($db,"SELECT * FROM directions WHERE id='".$id."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (!empty($myrow['id'])){
			$result1 = mysqli_query($db,"SELECT * FROM sub_themes WHERE id_direct='".$myrow['id']."'")or die(mysql_error());
			$myrow1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
			if (!empty($myrow1['id'])){
				$result1 = mysqli_query($db,"SELECT * FROM sub_themes WHERE id_direct='".$myrow['id']."'")or die(mysql_error());
				while ($myrow1=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
					echo "<id>".$myrow1['id']."</id>\r\n";
					echo "<name>".$myrow1['name']."</name>\r\n";
					
				}
				echo "<meschange>Ok</meschange>";
			}else{
				echo "<meschange>Default</meschange>";
			}
			
			
		}else{
			echo "<meschange>No</meschange>";
		}
	}
	if (isset($_POST['add'])){
		$EFabc = new EFabc();
		global $db;
		$result = mysqli_query($db,"SELECT * FROM directions")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (!empty($myrow['id'])){

			$result1 = mysqli_query($db,"SELECT * FROM sub_themes WHERE id_direct='".$myrow['id']."'")or die(mysql_error());
			$myrow1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
			if (!empty($myrow1['id'])){
				$result1 = mysqli_query($db,"SELECT * FROM sub_themes WHERE id_direct='".$myrow['id']."'")or die(mysql_error());
				while ($myrow1=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
					echo "<idsub>".$myrow1['id']."</idsub>\r\n";
					echo "<namesub>".$myrow1['name']."</namesub>\r\n";
					
				}
				echo "<messub>Ok</messub>";
			}else{
				echo "<messub>Default</messub>";
			}
			$result = mysqli_query($db,"SELECT * FROM directions")or die(mysql_error());
			while ($myrow=mysqli_fetch_array($result,MYSQLI_ASSOC)){
					echo "<iddir>".$myrow['id']."</iddir>\r\n";
					echo "<namedir>".$myrow['name']."</namedir>\r\n";
					
			}
			echo "<mesdir>Ok</mesdir>";
		}else{
			echo "<mesdir>No</mesdir>";
		}
	}
	if (isset($_POST['savetodb'])){
		$EFabc = new EFabc();
		global $db;
		$selectsub=$_POST['selectsub'];
		$select=$_POST['select'];
		$input=$_POST['input'];
		$nameTest=$_POST['nameTest'];
		$numberGroup=$_POST['numberGroup'];
		$numberGroup=$EFabc->user->sanitizeMySql($numberGroup);
		$nameTest=$EFabc->user->sanitizeMySql($nameTest);
		$flag1=0;
		$flag=0;
		$flagnumber=0;
		//echo count($input[0]);
		//echo $input[0][0];
		for ($j=0;$j<=count($input)-1;$j++){
			//echo count($input[j]);
			for ($i=0;$i<=count($input[$j])-1;$i++){
				//echo "fdsfsdfaasdfasdfa";
				//echo $input[$j][$i];
				if (preg_match("/[.,]/",$input[$j][$i]) ||($input[$j][$i]<=0) || is_numeric($input[$j][$i])==false) {
					$flagnumber=1;
				}
			}
		}
		
		if (!empty($selectsub)&&!empty($select)&&!empty($input)&&!empty($nameTest)&&!empty($numberGroup)&&$flagnumber==0){
			$result = mysqli_query($db,"SELECT * FROM name_test WHERE id_group='".$numberGroup."' and name='".$nameTest."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if (empty($myrow['id'])){
				$result = mysqli_query($db,"SELECT * FROM student_group WHERE id='".$numberGroup."'")or die(mysql_error());
				$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
				if (!empty($myrow['id'])){
					$result = mysqli_query($db,"INSERT INTO name_test (id_group,name) VALUES('".$numberGroup."','".$nameTest."')") or die(mysql_error());
					$result3 = mysqli_query($db,"SELECT * FROM name_test WHERE id_group='".$numberGroup."' and name='".$nameTest."'")or die(mysql_error());
					$myrow3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
					for($x=0;$x<=count($select)-1;$x++){
						$select[$x]=$EFabc->user->sanitizeMySql($select[$x]);
						$result1 = mysqli_query($db,"SELECT * FROM directions WHERE id='".$select[$x]."'")or die(mysql_error());
						$myrow1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
						if (!empty($myrow1['id'])){
							for($y=0;$y<=count($selectsub[$x])-1;$y++){
								$selectsub[$x][$y]=$EFabc->user->sanitizeMySql($selectsub[$x][$y]);
								$result2 = mysqli_query($db,"SELECT * FROM sub_themes WHERE id='".$selectsub[$x][$y]."'")or die(mysql_error());
								$myrow2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
								if (!empty($myrow2['id'])){
									
									if (!empty($myrow3['id'])){
										$result4 = mysqli_query($db,"SELECT * FROM config_test WHERE id_direct='".$select[$x]."' and id_sub='".$selectsub[$x][$y]."' and id_name='".$myrow3['id']."'")or die(mysql_error());
										$myrow4=mysqli_fetch_array($result4,MYSQLI_ASSOC);
										if (!empty($myrow4['id'])){
											$result5 = mysqli_query($db,"SELECT * FROM question WHERE id_sub='".$selectsub[$x][$y]."' and name<>'' and (var1<>'' or var2<>'' or var3<>'' or var4<>'' or var5<>'' or var6<>'') and (ans1<>'' or ans2<>'' or ans3<>'' or ans4<>'' or ans5<>'' or ans6<>'')")or die(mysql_error());
											//$myrow5=mysqli_num_rows($result5);
											$count=0;
											while ($myrow5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)){
												if (!empty($myrow5['id'])){
													$flag2=0;
													for ($g=1;$g<=6;$g++){
														if ($myrow5['ans'.$g]<>""){
															if (is_numeric($myrow5['ans'.$g]) && $myrow5['ans'.$g]<=6){
																if ($myrow5['var'.$myrow5['ans'.$g]]=="")
																	$flag2=1;	
															}else{
																$flag2=1;
															}
														}
													}
													if ($flag2==0){
														$count+=1;
														//$arrayquest[$countconfig][$count]=$myrow2['id'];
														//echo $arrayquest[$countconfig][$count];
													}
												}
											}
											if ($count>=($input[$x][$y]+$myrow4['kolvo_quest'])){
												$input[$x][$y]=$EFabc->user->sanitizeMySql($input[$x][$y]);
												$result = mysqli_query($db,"UPDATE config_test SET  kolvo_quest='".($myrow4['kolvo_quest']+$input[$x][$y])."'  WHERE id='".$myrow4['id']."'")or die(mysql_error());
											}else{
												$flag1=1;
											}
										}else{
											$result5 = mysqli_query($db,"SELECT * FROM question WHERE id_sub='".$selectsub[$x][$y]."' and name<>'' and (var1<>'' or var2<>'' or var3<>'' or var4<>'' or var5<>'' or var6<>'') and (ans1<>'' or ans2<>'' or ans3<>'' or ans4<>'' or ans5<>'' or ans6<>'')")or die(mysql_error());
											//$myrow5=mysqli_num_rows($result5);
											$count=0;
											while ($myrow5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)){
												if (!empty($myrow5['id'])){
													$flag2=0;
													for ($g=1;$g<=6;$g++){
														if ($myrow5['ans'.$g]<>""){
															if (is_numeric($myrow5['ans'.$g]) && $myrow5['ans'.$g]<=6){
																if ($myrow5['var'.$myrow5['ans'.$g]]=="")
																	$flag2=1;	
															}else{
																$flag2=1;
															}
														}
													}
													if ($flag2==0){
														$count+=1;
														//$arrayquest[$countconfig][$count]=$myrow2['id'];
														//echo $arrayquest[$countconfig][$count];
													}
												}
											}
										if ($count>=$input[$x][$y] && !empty($input[$x][$y])){
												$input[$x][$y]=$EFabc->user->sanitizeMySql($input[$x][$y]);
												$result = mysqli_query($db,"INSERT INTO config_test (id_name,id_direct,id_sub,kolvo_quest) VALUES('".$myrow3['id']."','".$select[$x]."','".$selectsub[$x][$y]."','".$input[$x][$y]."')") or die(mysql_error());
											}else{
												$flag1=1;
											}
										}
									}
								}else{
									$flag=1;
									echo "<mes>Nosub</mes>";
								}
							}
						}else{
							$flag=1;
							//echo "1234";
							echo "<mes>Nodir</mes>";
						}
					}
					if ($flag==1){
						$delete = mysqli_query($db,"DELETE FROM config_test WHERE id_name='".$myrow3['id']."'")or die(mysql_error());
						$delete1 = mysqli_query($db,"DELETE FROM name_test WHERE id='".$myrow3['id']."'")or die(mysql_error());
					}
					if ($flag1==1){
						$delete = mysqli_query($db,"DELETE FROM config_test WHERE id_name='".$myrow3['id']."'")or die(mysql_error());
						$delete1 = mysqli_query($db,"DELETE FROM name_test WHERE id='".$myrow3['id']."'")or die(mysql_error());
						echo "<mes>NoAdd</mes>";
					}
					if ($flag==0 && $flag1==0){
						echo "<mes>Ok</mes>";
					}
				}else{
					echo "<mes>Nogroup</mes>";
				}
			}else{
				echo "<mes>No</mes>";
			}
		}else{
			echo "<mes>Default</mes>";
		}
	}
}
?>