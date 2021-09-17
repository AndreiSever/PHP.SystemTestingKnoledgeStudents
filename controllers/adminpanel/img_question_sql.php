<?php
// разрешенные расширения файлов
	//$allowExt = array('gif', 'jpeg', 'jpg', 'png');
	// отдает расширение файла
	function getFileExt($filename) {
		$temp = explode('.', $filename);
		return strtolower(end($temp));
	}
	// проверка валиден ли тип и расширение
	function isPicture($type, $ext) {
		$allowExt = array('gif', 'jpeg', 'jpg', 'png');
		$result = false;
		switch ($type) {
			case 'image/jpeg':
			case 'image/jpg':
			case 'image/pjpeg':
			case 'image/x-png':
			case 'image/png':
			case 'image/gif':
				$result = true;
				break;
		}
		if ($result) {
			$result = in_array(strtolower($ext), $allowExt);
		}
		return $result;
	}
	if (isset($_POST['delete'])){
		global $db;
		$EFabc = new EFabc();
		$id=$EFabc->user->sanitizeMySql($_POST['id']);
		$result = mysqli_query($db,"SELECT * FROM question WHERE id='".$id."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (!empty($myrow['id'])){
			$deleteImage=$myrow['image'];
			if ($deleteImage<>""){
				$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR;
				$uploadfile = $uploaddir . basename($deleteImage);
				unlink($path.$uploadfile);
			}
			mysqli_query($db,"UPDATE question SET  image='' , extension='' WHERE id='".$id."'")or die(mysql_error());
			echo "<mes>Ok</mes>";
		}else{
			echo "<mes>No</mes>";
		}
	}
	if (isset($_FILES['userfile']['name'])){
		$ext = getFileExt($_FILES['userfile']['name']);
		if (isPicture($_FILES['userfile']['type'], $ext)) {
			global $db;
			$EFabc = new EFabc();
			$id=$EFabc->user->sanitizeMySql($_POST['id']);
			$result = mysqli_query($db,"SELECT * FROM question WHERE id='".$id."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if (!empty($myrow['id'])){
				$deleteImage=$myrow['image'];
				if ($deleteImage<>""){
					$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR;
					$uploadfile = $uploaddir . basename($deleteImage);
					unlink($path.$uploadfile);
				}
				do{
					$login=$EFabc->user->generateCode(10);
					$login=$login.'.'.$ext;
					$result1 = mysqli_query($db,"SELECT * FROM question WHERE image='".$login."'")or die(mysql_error());
					$myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
				}while (!empty($myrow1['id']));
				$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR;
				$uploadfile = $uploaddir . basename($login);
				move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
				$image=$EFabc->user->sanitizeMySql(basename($login));
				$ext=$EFabc->user->sanitizeMySql($ext);
				mysqli_query($db,"UPDATE question SET  image='".$image."' , extension='".$ext."' WHERE id='".$id."'")or die(mysql_error());
				echo "<img>".$image."</img>";
				echo "<mes>Ok</mes>";
			}
		} else {
			echo "<mes>No</mes>";
		}
		
		
		//$fdata = pathinfo($_FILES['userfile']['name']);
		//$ext = $fdata['extension'];
		
				
		//if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		//}
		//unlink($path.$uploadfile);
	}
?>