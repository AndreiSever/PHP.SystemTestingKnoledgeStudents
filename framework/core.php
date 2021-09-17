<?php	
	// PATH_TO_LIB_FILE
	require($path . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'library.php');
	
	// CONECT_TO_DATABASE
	$db = mysqli_connect($config['mysql']['host'], $config['mysql']['user'], $config['mysql']['pass'],$config['mysql']['db']);
	mysqli_set_charset($db,$config['mysql']['charset']);
	error_reporting(E_ALL & ~E_NOTICE);
	class EFabc
	{		
		public $route = null;
		public $user = null;
		public $auth = null;
		
		function EFabc()
		{
			$this->route = new route();
			$this->auth = new auth();
			$this->user = new user();
		}
	}
	
	$EFabc = new EFabc();
	$EFabc->route->startController();
	
	// PATH_TO_TEMPLATE
	if ($config['framework']['development'] == 'true')
		require($path . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'console.php');
	else
		require($path . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $config['path']['template'] . DIRECTORY_SEPARATOR . 'index.php');
?>