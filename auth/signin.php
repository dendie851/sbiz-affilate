<?php 
	@session_start();
	auth::isToken('errorPage/general');

	include_once 'sbiz/lib/connection.php';

	$username = general::secureInput(trim($_POST['username']));
	$password = md5(trim($_POST['password']));

	$query = "select count(username) as jml
		from member
		where username ='$username'
		  and password = '$password'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$data = $tmp->fetch_array();


	if($data['jml'] == 1) { 
		 $query = "select id,username,employee_id,member_access_id
		  from member
		  where username ='$username'";

		$tmp = $globalConDBMySQL ->query($query) or die (mysqli_error($globalConDBMySQL));
		$data = $tmp->fetch_array();
		$userId = $data['id'];
		$data['module_access'] = array(1,3,4);
		$arr = array('userId'=>$userId,'username'=>$data['id'],'employeeId'=>$data['employee_id'],'moduleAccess'=>$data['module_access']);
		$_SESSION['loginInfo'] = $arr;
		auth::signin($userId,$config['app']['name']);

		include_once 'sbiz/lib/connection-close.php';
		header('Location:'.$globalUrl.'home/dashboard');
	} else {
		include_once 'sbiz/lib/connection-close.php';
		header('Location: '.$globalUrl.'auth/login?msg=loginFailed');
	}
?>
