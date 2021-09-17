<?php 
	function getXLS($xls){
		require_once "$_SERVER[DOCUMENT_ROOT]/Classes/PHPExcel.php";
		$objPHPExcel = PHPExcel_IOFactory::load($xls);
		$objPHPExcel->setActiveSheetIndex(0);
		$aSheet = $objPHPExcel->getActiveSheet();
		
		$array = array();//этот массив будет содержать массивы содержащие в себе значения ячеек каждой строки
		//получим итератор строки и пройдемся по нему циклом
		foreach($aSheet->getRowIterator() as $row){
			//получим итератор ячеек текущей строки
			$cellIterator = $row->getCellIterator();
			//пройдемся циклом по ячейкам строки
			$item = array();//этот массив будет содержать значения каждой отдельной строки
			foreach($cellIterator as $cell){
				//заносим значения ячеек одной строки в отдельный массив
				array_push($item, iconv('utf-8', 'utf-8', $cell->getCalculatedValue()));
			}
			//заносим массив со значениями ячеек отдельной строки в "общий массв строк"
			array_push($array, $item);
		}
		return $array;
	}
	
$EFabc = new EFabc();
if ($EFabc->user->privateRoleOnly()){ 	
	if (isset($_FILES['userfile']['name'])){
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
		$fdata = pathinfo($_FILES['userfile']['name']);
		$ext = $fdata['extension'];
		$uploadfile = $uploaddir . basename('1.'.$ext);
		$column=0;
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			$xlsData = getXLS($path.'uploads/1.xls'); //извлеаем данные из XLS
			$column=0;
			echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
			echo "<list>\r\n";
			foreach($xlsData as $k => $v)
			{
				foreach($v as $m => $v1)
				{
				  echo "<item id='".$k."'>".$v1."</item>\r\n";
				}
				$column=$column+1;
			}
			echo "<maxcolumn>".$column."</maxcolumn>";
			echo "</list>\r\n";
		}
		unlink($path.$uploadfile);
	}

	if (isset($_POST['saveToFile'])){
		$exportData = $_POST['array'];
		$numberGroup=$_POST['numberGroup'];
		$numberGroup=$EFabc->user->sanitizeMySql($numberGroup);
		require_once "$_SERVER[DOCUMENT_ROOT]/Classes/PHPExcel.php";

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$active_sheet = $objPHPExcel->getActiveSheet();
		$objWriter = PHPExcel_IOFactory::createWriter( $objPHPExcel, 'Excel5' );

		$row_start = 1;
		$i = 0;
		foreach($exportData as $item) {
			$row_next = $row_start + $i;
			$active_sheet->setCellValue('A'.$row_next,$item[0]);
			$active_sheet->setCellValue('B'.$row_next,$item[1]);
			$active_sheet->setCellValue('C'.$row_next,$item[2]);
			$active_sheet->setCellValue('D'.$row_next,$item[3]);
			$active_sheet->setCellValue('E'.$row_next,$item[4]);
			$active_sheet->getStyle('A'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('A'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('A'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('A'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('B'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('B'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('B'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('B'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('C'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('C'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('C'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('C'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('D'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('D'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('D'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('D'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('E'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('E'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('E'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('E'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$i++;
		}
		
		$objWriter->save('uploads/'.$numberGroup.'.xls');
		exit;
	}

	if (isset($_POST['delete'])){
		$string = $_POST['delete'][0];
		$group = explode(",",$string);
		global $db;
		$count=count($group)-1;
		for ($i=0; $i<=$count; $i++){
			$group[$i]=$EFabc->user->sanitizeMySql($group[$i]);
			$result = mysqli_query($db,"SELECT * FROM list_students WHERE id='".$group[$i]."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if ($myrow['id']){
				$result1 = mysqli_query($db,"SELECT * FROM users WHERE nickname='".$myrow['login']."'")or die(mysql_error());
				$myrow1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
				if ($myrow1['id']){
					$result2 = mysqli_query($db,"SELECT * FROM starttest WHERE id_user='".$myrow1['id']."'")or die(mysql_error());
					while($myrow2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
						mysqli_query($db,"DELETE FROM save_question WHERE id_start='".$myrow2['id']."'")or die(mysql_error());
					}
					mysqli_query($db,"DELETE FROM starttest WHERE id_user='".$myrow1['id']."'")or die(mysql_error());
				}
				$result5 = mysqli_query($db,"SELECT * FROM result_test WHERE id_user='".$myrow1['id']."'")or die(mysql_error());
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
				mysqli_query($db,"DELETE FROM result_test WHERE id_user='".$myrow1['id']."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM users WHERE nickname='".$myrow['login']."'")or die(mysql_error());
				mysqli_query($db,"DELETE FROM list_students WHERE id='".$group[$i]."'")or die(mysql_error());	
			}
			
		}
	}
	if (isset($_POST['save'])){
		global $db;
		$id=$_POST['id'];
		$secondname=$_POST['secondname'];
		$name=$_POST['name'];
		$thirdname=$_POST['thirdname'];
		$password=$_POST['password'];
		$id=$EFabc->user->sanitizeMySql($id);
		$secondname=$EFabc->user->sanitizeMySql($secondname);
		$name=$EFabc->user->sanitizeMySql($name);
		$thirdname=$EFabc->user->sanitizeMySql($thirdname);
		$password=$EFabc->user->sanitizeMySql($password);
		$result = mysqli_query($db,"SELECT * FROM list_students WHERE id='".$id."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (!empty($myrow['id'])){
			$result = mysqli_query($db,"UPDATE list_students SET surname='".$secondname."' , name='".$name."' , thirdName='".$thirdname."' , password='".$password."' WHERE id='".$id."'")or die(mysql_error());
			$password=sha1("Не бейте".$password."я новичок");
			$result = mysqli_query($db,"UPDATE users SET secondname='".$secondname."' , name='".$name."' , thirdname='".$thirdname."' , password='".$password."' WHERE nickname='".$myrow['login']."'")or die(mysql_error());
			
		}
	}
	if (isset($_POST['add'])){
		$EFabc = new EFabc();
		global $db;
		$id=$_POST['id'];
		$secondname=$_POST['secondname'];
		$name=$_POST['name'];
		$thirdname=$_POST['thirdname'];
		$password=$_POST['password'];
		$id=$EFabc->user->sanitizeMySql($id);
		$secondname=$EFabc->user->sanitizeMySql($secondname);
		$name=$EFabc->user->sanitizeMySql($name);
		$thirdname=$EFabc->user->sanitizeMySql($thirdname);
		$password=$EFabc->user->sanitizeMySql($password);

		$role='user';
		$result = mysqli_query($db,"SELECT * FROM student_group WHERE name='".$EFabc->route->getId()."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (!empty($myrow['id'])){
			do{
				$login=$EFabc->user->generateCode(10);
				$result = mysqli_query($db,"SELECT * FROM users WHERE nickname='".$login."'")or die(mysql_error());
				$myrow1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
			}while (!empty($myrow1['id']));
				echo "<login>".$login."</login>";
				$result = mysqli_query($db,"INSERT INTO list_students (id_group,surname,name,thirdname,login,password) VALUES('".$myrow['id']."','".$secondname."','".$name."','".$thirdname."','".$login."','".$password."')") or die(mysql_error());
				$password=sha1("Не бейте".$password."я новичок");
				$result = mysqli_query($db,"INSERT INTO users (nickname,email,password,hash_pass,remote_addr,user_agent,name,secondname,thirdname,registration,role) VALUES('".$login."','','".$password."','','','','".$name."','".$secondname."','".$thirdname."',now(), '$role')") or die(mysql_error());
				$result = mysqli_query($db,"SELECT * FROM list_students WHERE login='".$login."'")or die(mysql_error());
				$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
				echo "<id>".$myrow['id']."</id>";
		}
	}
}
?>