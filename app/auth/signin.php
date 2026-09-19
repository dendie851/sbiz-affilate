<?php 
	@session_start();
	auth::isToken('errorPage/general');

	include_once 'sbiz/lib/connection.php';

	$username = general::secureInput(trim($_POST['username']));
	$password = md5(trim($_POST['password']));

	echo $query = "select count(username) as jml
		from affiliate
		where username ='$username'
		  and password = '$password'";
	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$data = $tmp->fetch_array();


	if($data['jml'] == 1) { 
		 $query = "select id,username,name
		  from affiliate
		  where username ='$username'";

		$tmp = $globalConDBMySQL ->query($query) or die (mysqli_error($globalConDBMySQL));
		$data = $tmp->fetch_array();
		$userId = $data['id'];
		$arr = array('userId'=>$userId,'username'=>$data['id'],'affiliateId'=>$data['id']);
		$_SESSION['loginInfo'] = $arr;
		auth::signin($userId,$config['app']['name']);
		include_once 'sbiz/lib/connection-close.php';
		header('Location:'.$globalUrl.'home/dashboard');
	} else {
		include_once 'sbiz/lib/connection-close.php';
		header('Location: '.$globalUrl.'auth/login?msg=loginFailed');
	}
?>
