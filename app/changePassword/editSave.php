<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';
	include_once 'editValidate.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	mysqli_autocommit($globalConDBMySQL,FALSE);

	$password = general::secureInput(trim($_POST['newPassword']));	
	$password = md5($password);

	$query = "update affiliate
		set password  = '{$password}'
		where id = '{$userId}' ";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	mysqli_commit($globalConDBMySQL);

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'changePassword/edit?msg=addSuccess');
?>
