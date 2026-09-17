<?php 
	@session_start();
	//auth::isToken('errorPage/general');

	$status = true;
	$msgError = array();

	$email = general::secureInput(trim($_POST['email']));

	$query = "select count(id) as jml 
			  from marketing
			  where email = '$email'
			  and is_delete = '0' ";

	$rst = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$data = $rst->fetch_array();

	if($data['jml'] < 1) {
		$status = false;
		$msgError['email'] = 'Mohon maaf email tidak terdaftar';

	}

	if($status == false) {
		include 'forgot.php';
		include_once 'sbiz/lib/connection-close.php';
		exit;
	}

?>
