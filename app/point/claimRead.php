<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	// Total poin yang diperoleh dari penjualan (kolom affiliate_point pada sales_order_detail)
	$query = "select count(distinct so.id) as jml_transaksi, sum(sod.affiliate_point) as total_point
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
				and so.status_order != '4'
			    and so.status_payment = '1'";

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

	// Pilihan reward yang bisa ditukarkan
	$query = "select id, title, points_required, daily_stock
			  from reward
			  where is_delete = '0'
			    and is_active = '1'
			  order by points_required";

	$cmbReward = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	// Riwayat poin: poin masuk dari penjualan (affiliate_point) dan poin keluar dari penukaran
	$query = "select 'masuk' as tipe, sod.id, so.no_order as ref, so.date_order as date_row,
				date_format(so.date_order,'%d/%m/%Y') as date_frm,
				concat('Poin dari penjualan ', so.no_order, ' - ', sod.name) as ket,
				sod.affiliate_point as point_in, 0 as point_out,
				'' as notes, '' as status, so.id as sort_order
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			    and so.status_payment = '1'
			  union all
			  select 'keluar' as tipe, apc.id, apc.no_point_claim as ref, apc.date_request as date_row,
				date_format(apc.date_request,'%d/%m/%Y') as date_frm,
				(select concat('Penukaran poin ', rw.title) from reward as rw where rw.id = apc.reward_id) as ket,
				0 as point_in, apc.points_spent as point_out,
				apc.notes,
				case apc.status_claim
					when '0' then 'PENGAJUAN'
					when '1' then 'DI SETUJUI'
					when '2' then 'PROSES PENYERAHAN'
					when '3' then 'SELESAI'
					when '4' then 'DI TOLAK'
				end as status,
				apc.id as sort_order
			  from affiliate_point_claim as apc
			  where apc.affiliate_id = '{$userId}'
			    and apc.is_delete = '0'
			  order by date_row desc, sort_order desc, id";

	$riwayat = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
