<?php
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	// a. Total point yang diperoleh dari penjualan
	$query = "select count(distinct so.id) as jml_transaksi,
				sum(sod.affiliate_point) as total_point
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			    and so.status_order = '3'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataPoint = $tmp->fetch_array();

	// b. Total point yang ditukarkan & dalam pengajuan
	$query = "select sum(if(status_claim <> '4', points_spent, 0)) as total_spent,
				sum(if(status_claim = '0', points_spent, 0)) as total_pending,
				sum(if(status_claim = '3', points_spent, 0)) as total_complete
			  from affiliate_point_claim
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataClaim = $tmp->fetch_array();

	$totalPoint = isset($dataPoint['total_point']) ? (int) $dataPoint['total_point'] : 0;
	$totalSpent = isset($dataClaim['total_spent']) ? (int) $dataClaim['total_spent'] : 0;
	$totalPending = isset($dataClaim['total_pending']) ? (int) $dataClaim['total_pending'] : 0;

	$dataPointInfo = array(
						'jml_transaksi' => isset($dataPoint['jml_transaksi']) ? (int) $dataPoint['jml_transaksi'] : 0,
						'total_point' => $totalPoint,
						'total_spent' => $totalSpent,
						'total_pending' => $totalPending,
						'total_complete' => isset($dataClaim['total_complete']) ? (int) $dataClaim['total_complete'] : 0,
						'sisa_point' => $totalPoint - $totalSpent
					);

	// c. Riwayat penukaran point
	$query = "select a.id, a.no_point_claim, a.points_spent, a.status_claim,
				a.date_request, r.title as reward_name
			  from affiliate_point_claim as a
			  left join reward as r
			   on a.reward_id = r.id
			  where a.affiliate_id = '{$userId}'
			    and a.is_delete = '0'
			  order by a.date_request desc, a.id desc";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
