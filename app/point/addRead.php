<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	$query = "select id, bank_name, account_name, account_number
			  from affiliate_bank
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'";

	$tmpBank = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataBank = $tmpBank->fetch_array();

	$query = "select so.id, so.no_order, so.name, so.date_order, so.status_order,
				so.amount_sale, so.amount_fee_affiliate
			  from sales_order as so
			  where so.affiliate_id = '{$userId}'
			    and so.is_delete = '0'
			    and so.id not in (select afwd.sales_order_id
								  from affiliate_withdraw_fee_detail as afwd)
			  order by so.date_order desc, so.id desc";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
