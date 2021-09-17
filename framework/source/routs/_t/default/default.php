<?php
	// PATH_TO_LIB_FILE
	require($path . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'library.php');

	if ($_GET[one] == '#ROUTE1#' && $_GET[two] == '#ROUTE2#' && $_GET[three] == '#ROUTE3#' && $introduction == '#NAME#')
	{
		//if (Authification::permission(array('ADMIN', 'USER')))
			include($path . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $config[path][template] . DIRECTORY_SEPARATOR . '#NAME#' . DIRECTORY_SEPARATOR . '#NAME#.php');
		//else
		//	$error['access'] = true;
	}
	else 
	{
		$error['404'] = true;
	}
?>