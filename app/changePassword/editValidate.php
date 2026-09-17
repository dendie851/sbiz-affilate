<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);
	
	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	$statusError = 0;
	$messageError = '';

	$password = general::secureInput(trim($_POST['password']));	
	$newPassword = general::secureInput(trim($_POST['newPassword']));	
	$confPassword = general::secureInput(trim($_POST['confPassword']));	

	if($newPassword != $confPassword) {
		$statusError = 1;
		$messageError = base64_encode("Konfirmasi Password tidak sama");		
	}

	$password = md5($password);
	$query = "select count(id) as total 
		from affiliate
		where id = '{$userId}' 
		  and password  = '{$password}'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$rst = $tmp->fetch_array();

	if($rst['total'] == 0) {
		$statusError = 1;
		$messageError = base64_encode("Password sekarang salah");				
	}

	if($statusError == 1) {
		$messageError = urlencode(($messageError));
		header('Location: '.$globalUrl.'changePassword/edit?msg=addFailed&messageError='.$messageError);
		exit;
	} 
?>