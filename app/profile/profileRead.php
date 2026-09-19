<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';
	
	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];
	
	$query = "select id, username, name, country_code, phone_number, email, city
			  from affiliate 
			  where id = '{$userId}'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$data = $tmp->fetch_array();



	include_once 'sbiz/lib/connection-close.php';
?>
