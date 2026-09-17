<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$query = "select id, name, phone
			  from company
			  where id = '1'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$data = $tmp->fetch_array();

	include_once 'sbiz/lib/connection-close.php';
?>
