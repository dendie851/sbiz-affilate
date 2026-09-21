<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];
	
	$query = "select afw.id, afw.affiliate_id, afw.affiliate_bank_id, afw.no_payment, afw.from_bank,
				afw.total_withdraw, afw.date_transfer, afw.date_input,
				ab.bank_name, ab.account_name, ab.account_number, 
				afw.from_bank
			  from affiliate_withdraw_fee as afw
			  left join affiliate_bank as ab
			   on ab.id = afw.affiliate_bank_id
			  where afw.affiliate_id = '{$userId}'
			    and afw.is_delete = '0'
			  order by afw.date_input desc";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
