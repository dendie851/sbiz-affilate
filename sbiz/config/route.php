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
	case (globalFunctionUri(2) == 'home/salesSummary'): 
			language::set($config['app']['language']);
			$globalModulActive = 'home';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/home/salesSummary.php';
	break;		
	case (globalFunctionUri(2) == 'home/commissionSummary'): 
			language::set($config['app']['language']);
			$globalModulActive = 'home';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/home/commissionSummary.php';
	break;		
	case (globalFunctionUri(2) == 'home/pointSummary'): 
			language::set($config['app']['language']);
			$globalModulActive = 'home';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/home/pointSummary.php';
	break;		
	case (globalFunctionUri(2) == 'home/productSummary'): 
			language::set($config['app']['language']);
			$globalModulActive = 'home';
			$globalViewScroolGroupMenu = 'grupMenuDashboard';												
			include_once 'app/home/productSummary.php';
	break;		

  	case (globalFunctionUri(2) == 'changePassword/edit'):
			language::set($config['app']['language']);
			$globalModulActive = 'changePassword';	
			$globalViewScroolGroupMenu = 'grupMenuChangePassword';
			include_once 'app/changePassword/edit.php';
	break;			
   	case (globalFunctionUri(2) == 'changePassword/editSave'):
			language::set($config['app']['language']);
			$globalModulActive = 'changePassword';	
			$globalViewScroolGroupMenu = 'grupMenuChangePassword';
			include_once 'app/changePassword/editSave.php';
	break;		
  	case (globalFunctionUri(2) == 'profile/profile'):
			language::set($config['app']['language']);
			$globalModulActive = 'profile';	
			$globalViewScroolGroupMenu = 'grupMenuProfile';
			include_once 'app/profile/profile.php';
	break;		
  	case (globalFunctionUri(2) == 'profile/editBank'):
			language::set($config['app']['language']);
			$globalModulActive = 'profile';	
			$globalViewScroolGroupMenu = 'grupMenuProfile';
			include_once 'app/profile/editBank.php';
	break;		
  	case (globalFunctionUri(2) == 'profile/editBankSave'):
			language::set($config['app']['language']);
			$globalModulActive = 'profile';	
			$globalViewScroolGroupMenu = 'grupMenuProfile';
			include_once 'app/profile/editBankSave.php';
	break;		
  	case (globalFunctionUri(2) == 'product/index'):
			language::set($config['app']['language']);
			$globalModulActive = 'product';	
			$globalViewScroolGroupMenu = 'grupMenuProduct';
			include_once 'app/product/index.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/index'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuCommision';
			include_once 'app/commission/index.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/detail'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuCommision';
			include_once 'app/commission/detail.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/add'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuCommision';
			include_once 'app/commission/add.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/addSave'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuCommision';
			include_once 'app/commission/addSave.php';
	break;		
  	case (globalFunctionUri(2) == 'commission/print'):
			language::set($config['app']['language']);
			$globalModulActive = 'commision';	
			$globalViewScroolGroupMenu = 'grupMenuCommision';
			include_once 'app/commission/print.php';
	break;	
	case (globalFunctionUri(2) == 'salesOrder/index'):
			language::set($config['app']['language']);
			$globalModulActive = 'salesOrder';	
			$globalViewScroolGroupMenu = 'grupMenuSalesOrder';
			include_once 'app/salesOrder/index.php';
	break;	
	case (globalFunctionUri(2) == 'point/index'):
			language::set($config['app']['language']);
			$globalModulActive = 'spoint';	
			$globalViewScroolGroupMenu = 'grupMenuPoint';
			include_once 'app/point/index.php';
	break;	
	case (globalFunctionUri(2) == 'point/claim'):
			language::set($config['app']['language']);
			$globalModulActive = 'spoint';	
			$globalViewScroolGroupMenu = 'grupMenuPoint';
			include_once 'app/point/claim.php';
	break;	
	case (globalFunctionUri(2) == 'point/claimSave'):
			language::set($config['app']['language']);
			$globalModulActive = 'spoint';	
			$globalViewScroolGroupMenu = 'grupMenuPoint';
			include_once 'app/point/claimSave.php';
	break;	
	case (globalFunctionUri(2) == 'point/cancel'):
			language::set($config['app']['language']);
			$globalModulActive = 'spoint';	
			$globalViewScroolGroupMenu = 'grupMenuPoint';
			include_once 'app/point/cancel.php';
	break;
	case (globalFunctionUri(2) == 'point/reward'):
			language::set($config['app']['language']);
			$globalModulActive = 'spoint';	
			$globalViewScroolGroupMenu = 'grupMenuPoint';
			include_once 'app/point/reward.php';
	break;	
	case (globalFunctionUri(2) == 'point/rewardSave'):
			language::set($config['app']['language']);
			$globalModulActive = 'spoint';	
			$globalViewScroolGroupMenu = 'grupMenuPoint';
			include_once 'app/point/rewardSave.php';
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


