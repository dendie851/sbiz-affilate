<?php
	@session_start();
	auth::isAuth($globalUrl.'errorPage/general',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';


	include_once 'sbiz/lib/connection-close.php';
 ?>

