<?php
$EFabc = new EFabc();
if ($EFabc->user->privateRoleOnly()){
	if (is_numeric($this->values[2])){
		//global $db;
		//$result = mysqli_query($db,"SELECT * FROM sub_themes WHERE id='".$EFabc->route->getId()."'")or die(mysql_error());
		//$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		//$sysFilename = iconv('UTF-8', 'CP1251//IGNORE', $myrow['name']);
		file_force_download($_SERVER[DOCUMENT_ROOT].'/uploads/'.$EFabc->route->getId().'.xls') ;
		if (file_exists($_SERVER[DOCUMENT_ROOT].'/uploads/'.$EFabc->route->getId().'.xls')) {
			unlink($_SERVER[DOCUMENT_ROOT].'/uploads/'.$EFabc->route->getId().'.xls');
		}
		exit;
	}
}
function file_force_download($file) {
	
	
  if (file_exists($file)) {
    // ���������� ����� ������ PHP, ����� �������� ������������ ������ ���������� ��� ������
    // ���� ����� �� ������� ���� ����� �������� � ������ ���������!
    if (ob_get_level()) {
      ob_end_clean();
    }
	
    // ���������� ������� �������� ���� ���������� �����
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    // ������ ���� � ���������� ��� ������������
    readfile($file);
  }
}
?>