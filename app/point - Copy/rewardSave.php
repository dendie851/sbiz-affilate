<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$id = general::secureInput(trim($_REQUEST['id']));

	$query = "select id, title, points_required, daily_stock, is_active
			  from reward
			  where id = '{$id}'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$data = $tmp->fetch_array();

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'point/reward');

?>
