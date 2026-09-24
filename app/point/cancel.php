<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	$id = general::secureInput(trim($_GET['id']));

	$query = "update affiliate_point_claim
			   set is_delete = '1'
			  where id = '{$id}'
			    and affiliate_id = '{$userId}'
			    and status_claim = '0'";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'point/index?msg=cancelSuccess');

?>
