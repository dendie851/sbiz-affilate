<?php
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	// a. Total komisi yang diperoleh dari penjualan
	$query = "select sum(amount_fee_affiliate) as total_earned,
				sum(if(status_payment_commision_affiliate = '1', amount_fee_affiliate, 0)) as total_paid,
				sum(if(status_payment_commision_affiliate = '0', amount_fee_affiliate, 0)) as total_unpaid
			  from sales_order
			  where affiliate_id = '{$userId}'
			    and is_affiliate = '1'
			    and is_delete = '0'
			    and status_order = '3'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataEarned = $tmp->fetch_array();

	// b. Total komisi yang sudah dicairkan
	$query = "select count(afw.id) as total_withdraw,
				sum(afw.total_withdraw) as total_withdraw_amount
			  from affiliate_withdraw_fee as afw
			  where afw.affiliate_id = '{$userId}'
			    and afw.is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataWithdraw = $tmp->fetch_array();

	// c. Detail komisi yang sudah dicairkan
	$query = "select afw.id, afw.no_payment, afw.total_withdraw, afw.date_transfer, afw.date_input,
				ab.bank_name, ab.account_name, ab.account_number
			  from affiliate_withdraw_fee as afw
			  left join affiliate_bank as ab
			   on ab.id = afw.affiliate_bank_id
			  where afw.affiliate_id = '{$userId}'
			    and afw.is_delete = '0'
			  order by afw.date_transfer desc, afw.id desc";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	// d. Rekening bank affiliate
	$query = "select id, bank_name, account_name, account_number
			  from affiliate_bank
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataBankAffiliate = $tmp->fetch_array();

	$totalEarned = isset($dataEarned['total_earned']) ? (float) $dataEarned['total_earned'] : 0;
	$totalPaid = isset($dataEarned['total_paid']) ? (float) $dataEarned['total_paid'] : 0;
	$totalUnpaid = isset($dataEarned['total_unpaid']) ? (float) $dataEarned['total_unpaid'] : 0;
	$totalWithdrawAmount = isset($dataWithdraw['total_withdraw_amount']) ? (float) $dataWithdraw['total_withdraw_amount'] : 0;

	$dataCommissionInfo = array(
						'total_earned' => $totalEarned,
						'total_paid' => $totalPaid,
						'total_unpaid' => $totalUnpaid,
						'total_withdraw' => isset($dataWithdraw['total_withdraw']) ? (int) $dataWithdraw['total_withdraw'] : 0,
						'total_withdraw_amount' => $totalWithdrawAmount,
						'balance' => $totalPaid - $totalWithdrawAmount
					);

	include_once 'sbiz/lib/connection-close.php';
?>
