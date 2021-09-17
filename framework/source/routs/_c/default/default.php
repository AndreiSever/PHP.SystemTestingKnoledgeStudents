<?php
	// PATH_TO_LIB_FILE
	require($path . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'library.php');

	if ($_GET[one] == '#ROUTE1#' && $_GET[two] == '#ROUTE2#' && $_GET[three] == '#ROUTE3#' && $introduction == '#NAME#')
		include($path . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . '#NAME#' . DIRECTORY_SEPARATOR . '#NAME#.php');
	else 
		$error['404'] = true;
?>