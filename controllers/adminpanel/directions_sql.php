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
			$result = mysqli_query($db,"SELECT * FROM sub_themes WHERE id_direct='".$group[$i]."'")or die(mysql_error());
			if ($result){
				while($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$result1 = mysqli_query($db,"SELECT * FROM question WHERE id_sub='".$myrow['id']."'")or die(mysql_error());
					if ($result1){
						while ($myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
							if (!empty($myrow1['id'])){
								if ($myrow1['image']!=""){
									$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR;
									$uploadfile = $uploaddir . basename($myrow1['image']);
									unlink($path.$uploadfile);
								}
							}
						}	
						$result2 = mysqli_query($db,"DELETE FROM question WHERE id_sub='".$myrow['id']."'")or die(mysql_error());
					}
					$result3 = mysqli_query($db,"DELETE FROM sub_themes WHERE id='".$myrow['id']."'")or die(mysql_error());
				}
			}
			
			
			$result4 = mysqli_query($db,"DELETE FROM directions WHERE id='".$group[$i]."'")or die(mysql_error());	
		}
	}
	if (isset($_POST['save'])){
		global $db;
		$id=$_POST['id'];
		$name=$_POST['name'];
		$id=$EFabc->user->sanitizeMySql($id);
		$name=$EFabc->user->sanitizeMySql($name);
		$result = mysqli_query($db,"SELECT * FROM directions WHERE name='".$name."' and id<>'".$id."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (empty($myrow['id'])){
			$result = mysqli_query($db,"UPDATE directions SET  name='".$name."'  WHERE id='".$id."'")or die(mysql_error());
			echo "<mes>Ok</mes>";
		}else{
			echo "<mes>No</mes>";
		}
	}
	if (isset($_POST['add'])){
		$EFabc = new EFabc();
		global $db;
		$name=$_POST['name'];
		$name=$EFabc->user->sanitizeMySql($name);
		$result = mysqli_query($db,"SELECT * FROM directions WHERE name='".$name."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (empty($myrow['id'])){
			$result = mysqli_query($db,"INSERT INTO directions (name) VALUES('".$name."')") or die(mysql_error());
			$result = mysqli_query($db,"SELECT * FROM directions WHERE name='".$name."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo "<id>".$myrow['id']."</id>";
			echo "<mesadd>Ok</mesadd>";
		}else{
			echo "<mesadd>No</mesadd>";
		}
	}
}
?>