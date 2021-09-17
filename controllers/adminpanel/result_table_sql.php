<?php
$EFabc = new EFabc();
if ($EFabc->user->privateRoleOnly()){ 
	if (isset($_POST['saveToFile'])){
		//$exportData = $_POST['array'];
		global $db;
		$numberSub=$_POST['numberTest'];
		$numberSub=$EFabc->user->sanitizeMySql($numberSub);
		$exportData = $_POST['array'];
		require_once "$_SERVER[DOCUMENT_ROOT]/Classes/PHPExcel.php";

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$active_sheet = $objPHPExcel->getActiveSheet();
		$objWriter = PHPExcel_IOFactory::createWriter( $objPHPExcel, 'Excel5' );

		$row_start = 1;
		$i = 0;
		foreach($exportData as $item) {
			$row_next = $row_start + $i;
			echo $item[0];
			$active_sheet->setCellValue('A'.$row_next,$item[0]);
			$active_sheet->setCellValue('B'.$row_next,$item[1]);
			$active_sheet->setCellValue('C'.$row_next,$item[2]);
			$active_sheet->setCellValue('D'.$row_next,$item[3]);
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
			$i++;
		}

		$objWriter->save('uploads/'.$numberSub.'.xls');
		exit;
	}
	if (isset($_POST['view'])){
		global $db;
		$id=$_POST['id'];
		$id=$EFabc->user->sanitizeMySql($id);
		$result = mysqli_query($db,"SELECT * FROM result_test WHERE id='".$id."'")or die(mysql_error());
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (!empty($myrow['id'])){
			$result1 = mysqli_query($db,"SELECT * FROM view_quest_result WHERE id_result='".$id."'")or die(mysql_error());
			$i=0;
			while($myrow1 =  mysqli_fetch_array($result1, MYSQLI_ASSOC)){ 
				$ans[$i]= array(
				  "name" => $myrow1['name_quest'],
				  "var1" => $myrow1['var1'],
				  "var2" => $myrow1['var2'],
				  "var3" => $myrow1['var3'],
				  "var4" => $myrow1['var4'],
				  "var5" => $myrow1['var5'],
				  "var6" => $myrow1['var6'],
				  "ans1" => $myrow1['ans1'],
				  "ans2" => $myrow1['ans2'],
				  "ans3" => $myrow1['ans3'],
				  "ans4" => $myrow1['ans4'],
				  "ans5" => $myrow1['ans5'],
				  "ans6" => $myrow1['ans6'],
				  "ans" => $myrow1['ans'],
				  "image" => $myrow1['image'],
				);
				$i+=1;
			}
			$ans+= array(
			  "mesedit" => "Ok",
			  "length" =>$i
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
}
?>