<?php
	$globalModul = globalFunctionUri(2);	
	$globalModul = str_replace(explode('/',$config['app']['path']), '', $globalModul);

	if(strlen(str_replace('/', '', $globalModul)) < 1) {
		$globalModul = $config['app']['homepage'];
	}

	switch ($globalModul) {		
	case (globalFunctionUri(2) == 'auth/login'):
			language::set($config['app']['language']);
			$globalModulActive = 'auth';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/auth/index.php';
		break;	
	case (globalFunctionUri(2) == 'auth/signin'):
			language::set($config['app']['language']);
			$globalModulActive = 'auth';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/auth/signin.php';
		break;	
	case (globalFunctionUri(2) == 'auth/sigout'):
			language::set($config['app']['language']);
			$globalModulActive = 'auth';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/auth/signout.php';
		break;	
	case (globalFunctionUri(2) == 'home/dashboard'): 
			language::set($config['app']['language']);
			$globalModulActive = 'home';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/home/index.php';
		break;		
  	case (globalFunctionUri(2) == 'changePassword/edit'):
			language::set($config['app']['language']);
			$globalModulActive = 'changePassword';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/changePassword/edit.php';
	break;			
   	case (globalFunctionUri(2) == 'changePassword/editSave'):
			language::set($config['app']['language']);
			$globalModulActive = 'changePassword';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/changePassword/editSave.php';
	break;		
  	case (globalFunctionUri(2) == 'profile/profile'):
			language::set($config['app']['language']);
			$globalModulActive = 'profile';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/profile/profile.php';
	break;		
  	case (globalFunctionUri(2) == 'product/index'):
			language::set($config['app']['language']);
			$globalModulActive = 'product';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/product/index.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/index'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/commission/index.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/detail'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/commission/detail.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/add'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/commission/add.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/addSave'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/commission/addSave.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/print'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuDashboard';
			include_once 'app/commission/print.php';
	break;	
	break;			
		default:
		include_once 'app/auth/index.php';
	break;
	}


	function globalFunctionUri($indexLast,$position=0) {
		$globalUri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		if($indexLast == 4) {
			$globalModul = $globalUri[count($globalUri)-4].'/'.$globalUri[count($globalUri)-3].'/'.$globalUri[count($globalUri)-2].'/'.$globalUri[count($globalUri)-1];
		}			

		if($indexLast == 3) {
			$globalModul = $globalUri[count($globalUri)-3].'/'.$globalUri[count($globalUri)-2].'/'.$globalUri[count($globalUri)-1];
		}			
		if($indexLast == 2) {
			$globalModul = $globalUri[count($globalUri)-2].'/'.$globalUri[count($globalUri)-1];
		}			

		if($indexLast == 1) {
			$globalModul = $globalUri[count($globalUri)-1];
		}	

		if($position != 0) {
		  	$tmp = explode('/',$globalModul);	
		  	$globalModul = $tmp[$position-1];
		}		

		return $globalModul;
	}	

?>


