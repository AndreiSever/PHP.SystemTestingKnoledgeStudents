<?php	
	// PATH_TO_CONFIG
	require($path.'/framework/configuration/configuration.php');
	
	// PATH_TO_LAGUAGES
	require($path.'/languages/' . $config['path']['languages'] . '/lang.php');
	
	// PATH_TO_USER_CLASS
	require($path.'/framework/classes/user.php');
	
	// PATH_TO_AUTH_CLASS
	require($path.'/framework/classes/auth.php');
	
	// PATH_TO_ROUTE_CLASS
	require($path.'/framework/classes/route.php');
	
	// ADD_NEW_PATH
?>