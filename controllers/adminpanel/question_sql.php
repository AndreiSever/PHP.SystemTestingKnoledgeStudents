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
			$uploadfile = $uploaddir . basename('2.'.$ext);
			
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
				$xlsData = getXLS($path.'uploads/2.xls'); //извлеаем данные из XLS
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
		//$exportData = $_POST['array'];
		global $db;
		$numberSub=$_POST['numberSub'];
		$numberSub=$EFabc->user->sanitizeMySql($numberSub);
		$result = mysqli_query($db,"SELECT * FROM question WHERE id_sub='".$numberSub."'")or die(mysql_error());
		$i=0;
		while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$exportData[$i][0]=$myrow['name'];
			$exportData[$i][1]=$myrow['var1'];
			$exportData[$i][2]=$myrow['var2'];
			$exportData[$i][3]=$myrow['var3'];
			$exportData[$i][4]=$myrow['var4'];
			$exportData[$i][5]=$myrow['var5'];
			$exportData[$i][6]=$myrow['var6'];
			$exportData[$i][7]=$myrow['ans1'];
			$exportData[$i][8]=$myrow['ans2'];
			$exportData[$i][9]=$myrow['ans3'];
			$exportData[$i][10]=$myrow['ans4'];
			$exportData[$i][11]=$myrow['ans5'];
			$exportData[$i][12]=$myrow['ans6'];
			//echo $myrow['var4'];
			$i=$i+1;
		}
		require_once "$_SERVER[DOCUMENT_ROOT]/Classes/PHPExcel.php";

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$active_sheet = $objPHPExcel->getActiveSheet();
		$objWriter = PHPExcel_IOFactory::createWriter( $objPHPExcel, 'Excel5' );

		$row_start = 1;
		$i = 0;
		foreach($exportData as $item) {
			$row_next = $row_start + $i;
			//echo $item[0];
			$active_sheet->setCellValue('A'.$row_next,$item[0]);
			$active_sheet->setCellValue('B'.$row_next,$item[1]);
			$active_sheet->setCellValue('C'.$row_next,$item[2]);
			$active_sheet->setCellValue('D'.$row_next,$item[3]);
			$active_sheet->setCellValue('E'.$row_next,$item[4]);
			$active_sheet->setCellValue('F'.$row_next,$item[5]);
			$active_sheet->setCellValue('G'.$row_next,$item[6]);
			$active_sheet->setCellValue('H'.$row_next,$item[7]);
			$active_sheet->setCellValue('I'.$row_next,$item[8]);
			$active_sheet->setCellValue('J'.$row_next,$item[9]);
			$active_sheet->setCellValue('K'.$row_next,$item[10]);
			$active_sheet->setCellValue('L'.$row_next,$item[11]);
			$active_sheet->setCellValue('M'.$row_next,$item[12]);
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
			$active_sheet->getStyle('F'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('F'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('F'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('F'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('G'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('G'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('G'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('G'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('H'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('H'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('H'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('H'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('I'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('I'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('I'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('I'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('J'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('J'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('J'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('J'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('K'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('K'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('K'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('K'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('L'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('L'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('L'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('L'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('M'.$row_next)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('M'.$row_next)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('M'.$row_next)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$active_sheet->getStyle('M'.$row_next)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$i++;
		}
		//$result = mysqli_query($db,"SELECT * FROM sub_themes WHERE id='".$numberSub."'")or die(mysql_error());
		//$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		//$sysFilename = iconv('UTF-8', 'CP1251//IGNORE', $myrow['name']);
		//$order = utf8_encode($myrow['name']);
		$objWriter->save('uploads/'.$numberSub.'.xls');
		//echo "<name>".$myrow['name']."</name>";
		exit;
	}
	if (isset($_POST['delete'])){
		$string = $_POST['delete'][0];
		$group = explode(",",$string);
		global $db;
		$count=count($group)-1;
		for ($i=0; $i<=$count; $i++){
			$group[$i]=$EFabc->user->sanitizeMySql($group[$i]);
			$result = mysqli_query($db,"SELECT * FROM question WHERE id='".$group[$i]."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$deleteImage=$myrow['image'];
			if ($deleteImage!=""){
				$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR;
				$uploadfile = $uploaddir . basename($deleteImage);
				unlink($path.$uploadfile);
			}
			mysqli_query($db,"DELETE FROM question WHERE id='".$group[$i]."'")or die(mysql_error());	
		}
	}
	if (isset($_POST['edit'])){
		global $db;
		$id=$_POST['id'];
		$id=$EFabc->user->sanitizeMySql($id);
		$result = mysqli_query($db,"SELECT * FROM question WHERE id='".$id."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (!empty($myrow['id'])){
			$ans = array(
			  "name" => $myrow['name'],
			  "var1" => $myrow['var1'],
			  "var2" => $myrow['var2'],
			  "var3" => $myrow['var3'],
			  "var4" => $myrow['var4'],
			  "var5" => $myrow['var5'],
			  "var6" => $myrow['var6'],
			  "ans1" => $myrow['ans1'],
			  "ans2" => $myrow['ans2'],
			  "ans3" => $myrow['ans3'],
			  "ans4" => $myrow['ans4'],
			  "ans5" => $myrow['ans5'],
			  "ans6" => $myrow['ans6'],
			  "image" => $myrow['image'],
			  "mesedit" => "Ok"
			);
			 
			echo json_encode( $ans );
		}else{
			$ans = array(
			  "mesedit" => "No"
			);
			 
			echo json_encode( $ans );
			//echo "<mesedit>No</mesedit>";
		}
		
	}
	if (isset($_POST['save'])){
		$EFabc = new EFabc();
		global $db;
		$id=$_POST['id'];
		$name=$_POST['name'];
		$var1=$_POST['var1'];
		$var2=$_POST['var2'];
		$var3=$_POST['var3'];
		$var4=$_POST['var4'];
		$var5=$_POST['var5'];
		$var6=$_POST['var6'];
		$ans1=$_POST['ans1'];
		$ans2=$_POST['ans2'];
		$ans3=$_POST['ans3'];
		$ans4=$_POST['ans4'];
		$ans5=$_POST['ans5'];
		$ans6=$_POST['ans6'];
		$id=$EFabc->user->sanitizeMySql($id);
		$name=$EFabc->user->sanitizeMySql($name);
		$var1=$EFabc->user->sanitizeMySql($var1);
		$var2=$EFabc->user->sanitizeMySql($var2);
		$var3=$EFabc->user->sanitizeMySql($var3);
		$var4=$EFabc->user->sanitizeMySql($var4);
		$var5=$EFabc->user->sanitizeMySql($var5);
		$var6=$EFabc->user->sanitizeMySql($var6);
		$ans1=$EFabc->user->sanitizeMySql($ans1);
		$ans2=$EFabc->user->sanitizeMySql($ans2);
		$ans3=$EFabc->user->sanitizeMySql($ans3);
		$ans4=$EFabc->user->sanitizeMySql($ans4);
		$ans5=$EFabc->user->sanitizeMySql($ans5);
		$ans6=$EFabc->user->sanitizeMySql($ans6);
		$result = mysqli_query($db,"SELECT * FROM question WHERE name='".$name."' and id_sub='".$EFabc->route->getId()."' and id<>'".$id."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (empty($myrow['id'])){
			$result = mysqli_query($db,"UPDATE question SET  name='".$name."'  ,var1='".$var1."',var2='".$var2."',var3='".$var3."',var4='".$var4."',var5='".$var5."',var6='".$var6."',ans1='".$ans1."',ans2='".$ans2."',ans3='".$ans3."',ans4='".$ans4."',ans5='".$ans5."',ans6='".$ans6."' WHERE id='".$id."'")or die(mysql_error());
			echo "<mesup>Ok</mesup>";
		}else{
			echo "<mesup>No</mesup>";
		}
	}
	if (isset($_POST['add'])){
		$EFabc = new EFabc();
		global $db;
		$name=$_POST['name'];
		$var1=$_POST['var1'];
		$var2=$_POST['var2'];
		$var3=$_POST['var3'];
		$var4=$_POST['var4'];
		$var5=$_POST['var5'];
		$var6=$_POST['var6'];
		$ans1=$_POST['ans1'];
		$ans2=$_POST['ans2'];
		$ans3=$_POST['ans3'];
		$ans4=$_POST['ans4'];
		$ans5=$_POST['ans5'];
		$ans6=$_POST['ans6'];
		//$id=$EFabc->user->sanitizeMySql($id);
		$name=$EFabc->user->sanitizeMySql($name);
		$var1=$EFabc->user->sanitizeMySql($var1);
		$var2=$EFabc->user->sanitizeMySql($var2);
		$var3=$EFabc->user->sanitizeMySql($var3);
		$var4=$EFabc->user->sanitizeMySql($var4);
		$var5=$EFabc->user->sanitizeMySql($var5);
		$var6=$EFabc->user->sanitizeMySql($var6);
		$ans1=$EFabc->user->sanitizeMySql($ans1);
		$ans2=$EFabc->user->sanitizeMySql($ans2);
		$ans3=$EFabc->user->sanitizeMySql($ans3);
		$ans4=$EFabc->user->sanitizeMySql($ans4);
		$ans5=$EFabc->user->sanitizeMySql($ans5);
		$ans6=$EFabc->user->sanitizeMySql($ans6);
		//Написать проверку на существование имени в данной подтеме
		$result = mysqli_query($db,"SELECT * FROM sub_themes WHERE id='".$EFabc->route->getId()."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (!empty($myrow['id'])){
			$result = mysqli_query($db,"SELECT * FROM question WHERE name='".$name."' and id_sub='".$EFabc->route->getId()."'")or die(mysql_error());
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if (empty($myrow['id'])){
				$result = mysqli_query($db,"INSERT INTO question (id_sub,name,var1,var2,var3,var4,var5,var6,ans1,ans2,ans3,ans4,ans5,ans6,image,extension) VALUES('".$EFabc->route->getId()."','".$name."','".$var1."','".$var2."','".$var3."','".$var4."','".$var5."','".$var6."','".$ans1."','".$ans2."','".$ans3."','".$ans4."','".$ans5."','".$ans6."','','')") or die(mysql_error());
				$result = mysqli_query($db,"SELECT * FROM question WHERE name='".$name."' and id_sub='".$EFabc->route->getId()."'")or die(mysql_error());
				$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
				echo "<id>".$myrow['id']."</id>";
				echo "<mesadd>Ok</mesadd>";
			}else{
				echo "<mesadd>No</mesadd>";
			}
		}
	}
}
?>