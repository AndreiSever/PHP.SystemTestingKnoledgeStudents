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
			$result = mysqli_query($db,"SELECT * FROM name_test WHERE id='".$group[$i]."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if ($myrow['id']){
				$result4 = mysqli_query($db,"SELECT * FROM starttest WHERE id_name='".$myrow['id']."'")or die(mysql_error());
				while($myrow4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)){
					mysqli_query($db,"DELETE FROM save_question WHERE id_start='".$myrow4['id']."'")or die(mysql_error());
				}
				//while($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					//$result1 = mysqli_query($db,"SELECT * FROM question WHERE id_sub='".$myrow['id']."'")or die(mysql_error());
					//if ($result1){
					//	$result2 = mysqli_query($db,"DELETE FROM question WHERE id_sub='".$myrow['id']."'")or die(mysql_error());
					//}
				mysqli_query($db,"DELETE FROM config_test WHERE id_name='".$myrow['id']."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM starttest WHERE id_name='".$myrow['id']."'")or die(mysql_error());
				$result5 = mysqli_query($db,"SELECT * FROM result_test WHERE id_name='".$group[$i]."'")or die(mysql_error());
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
				mysqli_query($db,"DELETE FROM result_test WHERE id_name='".$group[$i]."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM name_test WHERE id='".$group[$i]."'")or die(mysql_error());	
				//}
			}
			
			
		}
	}
}
?>