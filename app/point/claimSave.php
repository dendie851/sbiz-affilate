<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	$rewardId = general::secureInput(trim($_POST['rewardId']));
	$notes = general::secureInput(trim($_POST['notes']));

	// Ambil harga poin dari reward yang dipilih
	$query = "select id, title, points_required
			  from reward
			  where id = '{$rewardId}'
			    and is_delete = '0'
			    and is_active = '1'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataReward = $tmp->fetch_array();

	// Jumlah poin ditukar otomatis sebesar harga reward, jadi tidak ada input manual dari user
	$pointsSpent = isset($dataReward['points_required']) ? (int) $dataReward['points_required'] : 0;

	if(!$dataReward || $pointsSpent <= 0) {
		include_once 'sbiz/lib/connection-close.php';
		header('Location: '.$globalUrl.'point/claim?msg=claimFailed');
		exit;
	}

	// Sisa poin affiliate dihitung dari kolom affiliate_point pada sales order
	$query = "select sum(sod.affiliate_point) as total_point
			  from sales_order as so
			  inner join sales_order_detail as sod
			   on sod.sales_order_id = so.id
			  where so.affiliate_id = '{$userId}'
			    and so.is_affiliate = '1'
			    and so.is_delete = '0'
			    and so.status_order = '3'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataTotal = $tmp->fetch_array();
	$totalPoint = isset($dataTotal['total_point']) ? (int) $dataTotal['total_point'] : 0;

	$query = "select sum(points_spent) as total_spent
			  from affiliate_point_claim
			  where affiliate_id = '{$userId}'
			    and is_delete = '0'
			    and status_claim <> '4'";

	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$dataSpent = $tmp->fetch_array();
	$totalSpent = isset($dataSpent['total_spent']) ? (int) $dataSpent['total_spent'] : 0;

	$sisaPoin = $totalPoint - $totalSpent;

	// Validasi server side: poin ditukar otomatis sama dengan harga reward dan tidak melebihi sisa poin
	if($pointsSpent <> $dataReward['points_required'] || $pointsSpent > $sisaPoin) {
		include_once 'sbiz/lib/connection-close.php';
		header('Location: '.$globalUrl.'point/claim?msg=claimFailed');
		exit;
	}

	$noPointClaim = 'AP'.date('YmdHis').$userId;

	$query = "insert into affiliate_point_claim
			   set affiliate_id = '{$userId}',
			   	reward_id = '{$dataReward['id']}',
			   	no_point_claim = '{$noPointClaim}',
			   	points_spent = '{$pointsSpent}',
			   	points_price_reward = '{$dataReward['points_required']}',
			   	status_claim = '0',
			   	notes = '{$notes}',
			   	date_request = curdate()";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'point/index?msg=addSuccess');

?>
