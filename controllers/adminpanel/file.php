<?php
$EFabc = new EFabc();
if ($EFabc->user->privateRoleOnly()){
	if (is_numeric($this->values[2])){
		
		file_force_download($_SERVER[DOCUMENT_ROOT].'/uploads/'.$EFabc->route->getId().'.xls') ;
		if (file_exists($_SERVER[DOCUMENT_ROOT].'/uploads/'.$EFabc->route->getId().'.xls')) {
			unlink($_SERVER[DOCUMENT_ROOT].'/uploads/'.$EFabc->route->getId().'.xls');
		}
		exit;
	}
}
function file_force_download($file) {
	
	
  if (file_exists($file)) {
    // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
    // если этого не сделать файл будет читаться в память полностью!
    if (ob_get_level()) {
      ob_end_clean();
    }
	
    // заставляем браузер показать окно сохранения файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    // читаем файл и отправляем его пользователю
    readfile($file);
  }
}
?>