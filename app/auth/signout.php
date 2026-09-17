<?php 
	auth::signout('',$config['app']['name']);
	header('Location: '.$globalUrl.'admin/login/index');
?>
