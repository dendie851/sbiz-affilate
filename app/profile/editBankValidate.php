<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$bankName = general::secureInput(trim($_POST['bankName']));
	$accountName = general::secureInput(trim($_POST['accountName']));
	$accountNumber = general::secureInput(trim($_POST['accountNumber']));

	$statusError = 0;
	$messageError = '';

	if(strlen($bankName) < 1) {
		$statusError = 1;
		$messageError = base64_encode("Nama Bank harus diisi");				
	}

	if(strlen($accountName) < 1) {
		$statusError = 1;
		$messageError = base64_encode("Nama Pemilik Rekening harus diisi");				
	}

	if(strlen($accountNumber) < 1) {
		$statusError = 1;
		$messageError = base64_encode("Nomor Rekening harus diisi");				
	}

	if($statusError == 1) {
		$messageError = urlencode(($messageError));
		header('Location: '.$globalUrl.'profile/editBank?msg=addFailed&messageError='.$messageError);
		exit;
	} 

	include_once 'sbiz/lib/connection-close.php';
?>
