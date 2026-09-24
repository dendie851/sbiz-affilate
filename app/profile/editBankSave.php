<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';
	include_once 'editBankValidate.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	$id = general::secureInput(trim($_POST['id']));
	$bankName = general::secureInput(trim($_POST['bankName']));
	$accountName = general::secureInput(trim($_POST['accountName']));
	$accountNumber = general::secureInput(trim($_POST['accountNumber']));

	$query = "select count(id) as total
			  from affiliate_bank
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$rst = $tmp->fetch_array();

	mysqli_autocommit($globalConDBMySQL,FALSE);

	if($rst['total'] < 1) {
		$query = "insert into affiliate_bank
				   set affiliate_id = '{$userId}',
				   	bank_name = '{$bankName}',
				   	account_name = '{$accountName}',
				   	account_number = '{$accountNumber}'";
	}
	else {
		$query = "update affiliate_bank 
				   set bank_name = '{$bankName}',
				   	 account_name = '{$accountName}',
				   	 account_number = '{$accountNumber}'
				   where affiliate_id = '{$userId}'
				     and is_delete = '0'";
	}

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	mysqli_commit($globalConDBMySQL);

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'profile/profile?msg=editBankSuccess');

?>
