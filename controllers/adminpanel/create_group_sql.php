<?php 
$EFabc = new EFabc();
if ($EFabc->user->privateRoleOnly()){ 
	if (isset($_POST['delete'])){
		$string = $_POST['delete'][0];
		$group = explode(",",$string);
		global $db;
		$count=count($group)-1;
		for ($i=0; $i<=$count; $i++){
			$group[$i]=$EFabc->user->sanitizeMySql($group[$i]);
			$result = mysqli_query($db,"SELECT * FROM student_group WHERE name='".$group[$i]."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if (!empty($myrow['id'])){
				$result1 = mysqli_query($db,"SELECT * FROM list_students WHERE id_group='".$myrow['id']."'")or die(mysql_error());
				while($myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
					mysqli_query($db,"DELETE FROM users WHERE nickname='".$myrow1['login']."'")or die(mysql_error());
					mysqli_query($db,"DELETE FROM list_students WHERE id='".$myrow1['id']."'")or die(mysql_error());
				}
				$result2 = mysqli_query($db,"SELECT * FROM name_test WHERE id_group='".$myrow['id']."'")or die(mysql_error());
				while($myrow2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
					$result3 = mysqli_query($db,"SELECT * FROM starttest WHERE id_name='".$myrow2['id']."'")or die(mysql_error());
					while($myrow3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)){
						mysqli_query($db,"DELETE FROM save_question WHERE id_start='".$myrow3['id']."'")or die(mysql_error());
					}
					mysqli_query($db,"DELETE FROM starttest WHERE id_name='".$myrow2['id']."'")or die(mysql_error());
					mysqli_query($db,"DELETE FROM config_test WHERE id_name='".$myrow2['id']."'")or die(mysql_error());
					
				}
				mysqli_query($db,"DELETE FROM name_test WHERE id_group='".$myrow['id']."'")or die(mysql_error());
				$result5 = mysqli_query($db,"SELECT * FROM result_test WHERE id_group='".$myrow['id']."'")or die(mysql_error());
				while($myrow5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)){
					$result6 = mysqli_query($db,"SELECT * FROM view_quest_result WHERE id_result='".$myrow5['id']."'")or die(mysql_error());
					while($myrow6 = mysqli_fetch_array($result6, MYSQLI_ASSOC)){
						if ($myrow6['image']!=""){
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'image_result'.DIRECTORY_SEPARATOR;
							$uploadfile = $uploaddir . basename($myrow6['image']);
							unlink($path.$uploadfile);
						}
					}
					mysqli_query($db,"DELETE FROM view_quest_result WHERE id_result='".$myrow5['id']."'")or die(mysql_error());
				}
				mysqli_query($db,"DELETE FROM result_test WHERE id_group='".$myrow['id']."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM student_group WHERE name='".$group[$i]."'")or die(mysql_error());
			}
		}
	}

	if (isset($_POST['add'])){
		global $db;
		$group = $_POST['name'];
		$group=$EFabc->user->sanitizeMySql($group);
		if (!preg_match("/[.,]/",$group)){
			$result = mysqli_query($db,"SELECT * FROM student_group WHERE name='".$group."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if (empty($myrow['id'])){
				$result = mysqli_query($db,"INSERT INTO student_group (name) VALUES('$group')") or die(mysql_error());
				echo '<mes>Ok</mes>';
			}else{
				echo '<mes>No</mes>';
			}
		}
	}
}
?>