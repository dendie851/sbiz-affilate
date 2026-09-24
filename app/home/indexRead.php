<?php
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	// a. Ringkasan penjualan affiliate
	$query = "select count(distinct so.id) as total_order,
				sum(sod.amount) as total_qty,
				sum(so.amount_sale) as total_sale,
				sum(so.amount_fee_affiliate) as total_fee
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataSaleSummary = $tmp->fetch_array();

	// b. Ringkasan penjualan yang sudah selesai
	$query = "select count(distinct so.id) as total_order_complete,
				sum(so.amount_sale) as total_sale_complete,
				sum(so.amount_fee_affiliate) as total_fee_complete
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			    and so.status_order = '3'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataSaleComplete = $tmp->fetch_array();

	// c. Ringkasan komisi yang sudah dicairkan
	$query = "select count(id) as total_withdraw,
				sum(total_withdraw) as total_withdraw_amount
			  from affiliate_withdraw_fee
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataWithdraw = $tmp->fetch_array();

	$totalFee = isset($dataSaleSummary['total_fee']) ? (float) $dataSaleSummary['total_fee'] : 0;
	$totalWithdrawAmount = isset($dataWithdraw['total_withdraw_amount']) ? (float) $dataWithdraw['total_withdraw_amount'] : 0;

	$dataCommissionInfo = array(
						'total_earned' => $totalFee,
						'total_withdraw' => isset($dataWithdraw['total_withdraw']) ? (int) $dataWithdraw['total_withdraw'] : 0,
						'total_withdraw_amount' => $totalWithdrawAmount,
						'balance' => $totalFee - $totalWithdrawAmount
					);

	// d. Ringkasan point
	$query = "select sum(sod.affiliate_point) as total_point
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			    and so.status_order = '3'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataPointSummary = $tmp->fetch_array();

	$query = "select sum(if(status_claim <> '4', points_spent, 0)) as total_spent,
				sum(if(status_claim = '0', points_spent, 0)) as total_pending
			  from affiliate_point_claim
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataPointClaim = $tmp->fetch_array();

	$totalPoint = isset($dataPointSummary['total_point']) ? (int) $dataPointSummary['total_point'] : 0;
	$totalSpent = isset($dataPointClaim['total_spent']) ? (int) $dataPointClaim['total_spent'] : 0;
	$totalPending = isset($dataPointClaim['total_pending']) ? (int) $dataPointClaim['total_pending'] : 0;

	$dataPointInfo = array(
						'total_point' => $totalPoint,
						'total_spent' => $totalSpent,
						'total_pending' => $totalPending,
						'sisa_point' => $totalPoint - $totalSpent
					);

	// e. Ringkasan produk & rekening bank
	$query = "select count(id) as total_product
			  from affiliate_stuff
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataProduct = $tmp->fetch_array();

	$query = "select count(id) as total_bank
			  from affiliate_bank
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataBank = $tmp->fetch_array();

	$dataDashboardInfo = array(
						'total_product' => isset($dataProduct['total_product']) ? (int) $dataProduct['total_product'] : 0,
						'is_bank_exist' => isset($dataBank['total_bank']) && (int) $dataBank['total_bank'] > 0 ? '1' : '0'
					);

	// f. Penjualan terakhir
	$query = "select so.id, so.no_order, so.name, so.date_order, so.amount_sale,
				so.amount_fee_affiliate, so.status_order
			  from sales_order as so
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			  order by so.date_order desc, so.id desc
			  limit 5";

	$dataLastOrder = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>

