<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];
	
	$query = "select a.id, a.affiliate_id, a.reward_id, a.no_point_claim, a.points_spent, a.points_price_reward,
				a.status_claim, a.notes, a.date_request, a.date_approve, a.date_process, a.date_complete, a.date_reject,
				a.is_delete, r.title as reward_name,
				date_format(date_request,'%d-%m-%Y') as date_request_frm,
				date_format(date_approve,'%d/%m/%Y') as date_approve_frm,
				date_format(date_process,'%d/%m/%Y') as date_process_frm,
				date_format(date_complete,'%d/%m/%Y') as date_complete_frm,
				date_format(date_reject,'%d/%m/%Y') as date_reject
			  from affiliate_point_claim as a
			  left join reward as r
			   on a.reward_id = r.id
			  where a.affiliate_id = '{$userId}'
			    and a.is_delete = '0'
			  order by a.date_request desc";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	// Total poin yang diperoleh dari penjualan (kolom affiliate_point pada sales_order_detail)
	$query = "select count(distinct so.id) as jml_transaksi, sum(sod.affiliate_point) as total_point
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			    and so.status_order = '3'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataPoint = $tmp->fetch_array();

	// Total poin yang sudah ditukarkan (status_claim selain ditolak)
	$query = "select sum(points_spent) as total_spent
			  from affiliate_point_claim
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'
			    and status_claim <> '4'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataSpent = $tmp->fetch_array();

	// Total poin yang masih dalam proses pengajuan
	$query = "select sum(points_spent) as total_pending
			  from affiliate_point_claim
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'
			    and status_claim = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataPending = $tmp->fetch_array();

	$totalPoint = isset($dataPoint['total_point']) ? (int) $dataPoint['total_point'] : 0;
	$totalSpent = isset($dataSpent['total_spent']) ? (int) $dataSpent['total_spent'] : 0;
	$totalPending = isset($dataPending['total_pending']) ? (int) $dataPending['total_pending'] : 0;

	$dataPointInfo = array(
						'jml_transaksi' => isset($dataPoint['jml_transaksi']) ? (int) $dataPoint['jml_transaksi'] : 0,
						'total_point' => $totalPoint,
						'total_spent' => $totalSpent,
						'total_pending' => $totalPending,
						'sisa_point' => $totalPoint - $totalSpent
					);

	include_once 'sbiz/lib/connection-close.php';
?>
