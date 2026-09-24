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

	$queryBank = "select id, affiliate_id, bank_name, account_name, account_number
			  	  from affiliate_bank
			  	  where affiliate_id = '{$userId}'
			  	    and is_delete = '0'";

	$tmpBank = $globalConDBMySQL->query($queryBank) or die (mysqli_error($globalConDBMySQL));
	$dataBank = $tmpBank->fetch_array();

	$isBankExist = mysqli_num_rows($tmpBank) < 1 ? '0' : '1';

	include_once 'sbiz/lib/connection-close.php';
?>
