<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	$id = general::secureInput(trim($_GET['id']));

	$query = "select afw.id, afw.affiliate_id, afw.affiliate_bank_id, afw.no_payment, afw.from_bank,
				afw.total_withdraw, afw.date_transfer, afw.date_input,
				ab.bank_name, ab.account_name, ab.account_number
			  from affiliate_withdraw_fee as afw
			  left join affiliate_bank as ab
			   on ab.id = afw.affiliate_bank_id
			  where afw.id = '{$id}'
			    and afw.affiliate_id = '{$userId}'
			    and afw.is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$data = $tmp->fetch_array();

	if(!$data) {
		header('Location: '.$globalUrl.'commission/index');
		exit;
	}

	$query = "select afwd.id, afwd.sales_order_id, afwd.sales_order_number, afwd.amount_fee_affiliate,
				so.name, so.date_order
			  from affiliate_withdraw_fee_detail as afwd
			  left join sales_order as so
			   on so.id = afwd.sales_order_id
			  where afwd.affiliate_withdraw_fee_id = '{$id}'
			  order by afwd.id";

	$dataDetail = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
