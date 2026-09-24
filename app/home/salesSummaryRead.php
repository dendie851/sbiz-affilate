<?php
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	// a. Ringkasan jumlah order per status
	$query = "select count(id) as total_order,
				sum(if(status_order = '0', 1, 0)) as total_order_new,
				sum(if(status_order = '1', 1, 0)) as total_order_process,
				sum(if(status_order = '2', 1, 0)) as total_order_shipping,
				sum(if(status_order = '3', 1, 0)) as total_order_complete,
				sum(if(status_order = '4', 1, 0)) as total_order_cancel,
				sum(if(status_order = '0', amount_sale, 0)) as total_sale_new,
				sum(if(status_order = '1', amount_sale, 0)) as total_sale_process,
				sum(if(status_order = '2', amount_sale, 0)) as total_sale_shipping,
				sum(if(status_order = '3', amount_sale, 0)) as total_sale_complete,
				sum(if(status_order = '4', amount_sale, 0)) as total_sale_cancel
			  from sales_order
			  where affiliate_id = '{$userId}'
			    and is_affiliate = '1'
			    and is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataStatus = $tmp->fetch_array();

	// b. Tren penjualan per bulan pada tahun berjalan
	$year = date('Y');

	$query = "select date_format(date_order,'%m') as bulan,
				count(id) as total_order,
				sum(amount_sale) as total_sale,
				sum(amount_fee_affiliate) as total_fee
			  from sales_order
			  where affiliate_id = '{$userId}'
			    and is_affiliate = '1'
			    and is_delete = '0'
			    and year(date_order) = '{$year}'
			  group by date_format(date_order,'%m')
			  order by bulan";

	$dataMonthly = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	// c. Produk terlaris milik affiliate
	$query = "select sod.stuff_id, sod.name,
				sum(sod.amount) as total_qty,
				sum(sod.amount * sod.price) as total_sale,
				sum(sod.affiliate_fee_nominal) as total_fee
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			    and so.status_order = '3'
			  group by sod.stuff_id, sod.name
			  order by total_qty desc
			  limit 10";

	$dataProduct = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	// d. Riwayat penjualan terakhir
	$query = "select so.id, so.no_order, so.name, so.date_order, so.amount_sale,
				so.amount_fee_affiliate, so.status_order
			  from sales_order as so
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			  order by so.date_order desc, so.id desc
			  limit 10";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
