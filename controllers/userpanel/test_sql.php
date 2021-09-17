<?php
$EFabc = new EFabc();
if ($EFabc->user->getRole()== "user"){ 
	if (isset($_POST['savetoresult'])){
		global $db;
		$EFabc = new EFabc();
		$headers=$_POST['headers'];
		$tabpane=$_POST['tabpane'];
		$taball=$_POST['taball'];
		$headerscount=count($_POST['headers']);
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
			$result1 = mysqli_query($db,"SELECT * FROM starttest WHERE id_name='".$myrow['id']."' and id_user='".$id."'")or die(mysql_error());
			$myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
			
			if (!empty($myrow1['id'])){
				$result2 = mysqli_query($db,"SELECT * FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
				$questcount = mysqli_num_rows($result2);
				$count=0;
				$mark=0;
				for ($x=0;$x<=$headerscount-1;$x++){
				$headers[$x]=$EFabc->user->sanitizeMySql($headers[$x]);
				$result2 = mysqli_query($db,"SELECT * FROM save_question WHERE id_start='".$myrow1['id']."'  and id_question='".$headers[$x]."'")or die(mysql_error());
				$myrow2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
					if (!empty($myrow2['id'])){
						$result2 = mysqli_query($db,"SELECT * FROM question WHERE id='".$myrow2['id_question']."' and name<>'' and (var1<>'' or var2<>'' or var3<>'' or var4<>'' or var5<>'' or var6<>'') and (ans1<>'' or ans2<>'' or ans3<>'' or ans4<>'' or ans5<>'' or ans6<>'')")or die(mysql_error());
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
								//echo $myrow2['id']." ";
								$countvar=0;
								$flagvar=0;
								for ($j=1;$j<=6;$j++){
									if ($myrow2['var'.$j]<>""){
										$countvar+=1;
									}
									for ($h=1;$h<=6;$h++){
										if ($myrow2['var'.$j]<>""){
											//$countvar+=1;
											if ($myrow2['var'.$j]==$myrow2['var'.$h] && $j<>$h){
												$flagvar=1;
											}
										}
									}
								}
								//echo $flagvar." ";
								$sum=0;
								if ($flagvar==0){
									for ($j=1;$j<=6;$j++){
										$flagvar1=0;
										for ($d=0;$d<=$countvar;$d++){
											//echo $taball[$x][$d];
											if ($myrow2['var'.$j]<>""){
												if ($taball[$x][$d]==$myrow2['var'.$j] && $flagvar1==0){
													//echo $taball[$x][$d]."<br>";
													//for ()
													$flagvar1=1;
													$sum+=1;
												}
											}
										}
									}
								}
								//echo $countvar;
								if ($sum==$countvar){
									$flagsum=0;
									$flagdefaultans=0;
									for ($g=1;$g<=6;$g++){
										
											for ($d=0;$d<=count($taball[$x]);$d++){
												//if ($myrow2['var'.$myrow2['ans'.$g]]==$tabpane[$x][$d]){
												if ($myrow2['var'.$g]==$tabpane[$x][$d] && $myrow2['var'.$g]<>""){
													$flagdefaultans=1;
													$flagsum-=1;
													$flagfg=0;
													for ($v=1;$v<=6;$v++){
														if ($myrow2['ans'.$v]==$g && $flagfg==0){
															$flagsum+=1;
															$flagfg=1;
														}
													}
												}
											
										}
									}
									if ($flagdefaultans==0){
										$flagsum=-1;
									}
									if ($flagsum==0){
										$mark+=1;
										$arraytrue[$x]=1;
									}else{
										$arraytrue[$x]=0;
									}
									//echo "fsdfsd";
									$count+=1;
								}
								//$arrayquest[$countconfig][$count]=$myrow2['id'];
							}
						}
						
					}
				}
				//echo $count;
				if ($count<>$questcount){
					$flag=1;
				}
			}
		}
		if ($flag==1){
			echo "<mes>No</mes>";
		}

		if ($flag==0){
			//echo "dasfs";
			$resultmark="(".round(($mark/$headerscount)*100,1)."%)";
			if ((($mark/$headerscount)*100)<50){
				mysqli_query($db,"DELETE FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM starttest WHERE id_name='".$myrow['id']."' and id_user='".$id."'")or die(mysql_error());
				mysqli_query($db,"INSERT INTO result_test (id_group,id_name,id_user,mark) VALUES('".$group1['id_group']."','".$myrow['id']."','".$id."','2".$resultmark."')") or die(mysql_error());
			}
			if ((($mark/$headerscount)*100)>=50 && (($mark/$headerscount)*100)<72){
				//echo "sfgd";
				mysqli_query($db,"DELETE FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM starttest WHERE id_name='".$myrow['id']."' and id_user='".$id."'")or die(mysql_error());
				mysqli_query($db,"INSERT INTO result_test (id_group,id_name,id_user,mark) VALUES('".$group1['id_group']."','".$myrow['id']."','".$id."','3".$resultmark."')") or die(mysql_error());
			}
			if ((($mark/$headerscount)*100)>=73 && (($mark/$headerscount)*100)<85){
				mysqli_query($db,"DELETE FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM starttest WHERE id_name='".$myrow['id']."' and id_user='".$id."'")or die(mysql_error());
				mysqli_query($db,"INSERT INTO result_test (id_group,id_name,id_user,mark) VALUES('".$group1['id_group']."','".$myrow['id']."','".$id."','4".$resultmark."')") or die(mysql_error());
			}
			if ((($mark/$headerscount)*100)>=86){
				mysqli_query($db,"DELETE FROM save_question WHERE id_start='".$myrow1['id']."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM starttest WHERE id_name='".$myrow['id']."' and id_user='".$id."'")or die(mysql_error());
				mysqli_query($db,"INSERT INTO result_test (id_group,id_name,id_user,mark) VALUES('".$group1['id_group']."','".$myrow['id']."','".$id."','5".$resultmark."')") or die(mysql_error());
			}
			$result4 = mysqli_query($db,"SELECT * FROM result_test WHERE id_group='".$group1['id_group']."' and id_name=".$myrow['id']." and id_user=".$id."")or die(mysql_error());
			$myrow4 = mysqli_fetch_array($result4,MYSQLI_ASSOC);
			//echo $myrow4['id'];
			for ($x=0;$x<=$headerscount-1;$x++){
					
					$result5 = mysqli_query($db,"SELECT * FROM question WHERE id='".$headers[$x]."' and name<>'' and (var1<>'' or var2<>'' or var3<>'' or var4<>'' or var5<>'' or var6<>'') and (ans1<>'' or ans2<>'' or ans3<>'' or ans4<>'' or ans5<>'' or ans6<>'')")or die(mysql_error());
					$myrow5 = mysqli_fetch_array($result5,MYSQLI_ASSOC);
					$login="";
					if ($myrow5['image']!=""){
						do{
							$login=$EFabc->user->generateCode(10);
							$login=$login.'.'.$myrow5['extension'];
							$result6 = mysqli_query($db,"SELECT * FROM view_quest_result WHERE image='".$login."'")or die(mysql_error());
							$myrow6 = mysqli_fetch_array($result6, MYSQLI_ASSOC);
						}while (!empty($myrow6['id']));
						$file =$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.$myrow5['image'];
						$newfile = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'image_result'.DIRECTORY_SEPARATOR.$login;
						
						if (!copy($file, $newfile)) {
							echo "не удалось скопировать $file...\n";
						}
					}
					mysqli_query($db,"INSERT INTO view_quest_result (id_result,name_quest,var1,var2,var3,var4,var5,var6,ans1,ans2,ans3,ans4,ans5,ans6,ans,image) VALUES('".$myrow4['id']."','".$myrow5['name']."','".$taball[$x][0]."','".$taball[$x][1]."','".$taball[$x][2]."','".$taball[$x][3]."','".$taball[$x][4]."','".$taball[$x][5]."','".$tabpane[$x][0]."','".$tabpane[$x][1]."','".$tabpane[$x][2]."','".$tabpane[$x][3]."','".$tabpane[$x][4]."','".$tabpane[$x][5]."','".$arraytrue[$x]."','".$login."')") or die(mysql_error());
			}
			echo "<mes>Ok</mes>";
		}
	}
}
?>