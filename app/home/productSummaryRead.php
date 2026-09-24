<?php
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	// a. Base link brosur affiliate
	$query = "select id, code, value
			  from affiliate_setting
			  where is_delete = '0'
			    and is_active = '1'
			    and code = '001'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataAffiliateSetting = $tmp->fetch_array();

	$affiliateSetting = isset($dataAffiliateSetting['value']) ? $dataAffiliateSetting['value'] : 'http://example.com';

	// b. Ringkasan jumlah produk affiliate
	$query = "select count(afs.id) as total_product,
				sum(if(s.stock > 0, 1, 0)) as total_product_stock,
				sum(if(s.stock < 1, 1, 0)) as total_product_empty,
				sum(afs.point) as total_point
			  from affiliate_stuff as afs
			  inner join stuff as s
			   on s.id = afs.stuff_id
			  where afs.affiliate_id = '{$userId}'
			    and afs.is_delete = '0'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataProductInfo = $tmp->fetch_array();

	// c. Daftar produk affiliate beserta performa penjualan
	$query = "select afs.id, afs.stuff_id, afs.link_product_brosur, afs.point, afs.price,
				afs.fee_affiliate_nominal, afs.fee_affiliate_percent,
				s.sku, s.name, s.stock,
				ifnull(sale.total_qty, 0) as total_qty,
				ifnull(sale.total_sale, 0) as total_sale,
				ifnull(sale.total_fee, 0) as total_fee
			  from affiliate_stuff as afs
			  inner join stuff as s
			   on s.id = afs.stuff_id
			  left join (select sod.stuff_id,
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
						  group by sod.stuff_id) as sale
			   on sale.stuff_id = afs.stuff_id
			  where afs.affiliate_id = '{$userId}'
			    and afs.is_delete = '0'
			  order by total_qty desc, s.name";

	$data = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	// d. Produk terlaris secara umum untuk rekomendasi
	$query = "select sod.stuff_id, sod.name, sum(sod.amount) as total_qty
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			    and so.status_order = '3'
			  group by sod.stuff_id, sod.name
			  order by total_qty desc
			  limit 5";

	$dataProductBest = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';
?>
