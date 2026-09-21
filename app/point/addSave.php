<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';
	include_once 'addValidate.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	// re-assign karena variable $_POST bisa tertimpa oleh include sebelumnya
	$affiliateBankId = general::secureInput(trim($_POST['affiliateBankId']));
	$salesOrderId = isset($_POST['salesOrderId']) ? $_POST['salesOrderId'] : array();

	mysqli_autocommit($globalConDBMySQL,FALSE);

	$totalWithdraw = 0;
	$dataOrder = array();

	foreach($salesOrderId as $val) {
		$val = general::secureInput(trim($val));

		$query = "select id, no_order, amount_fee_affiliate
				  from sales_order
				  where id = '{$val}'";

		$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
		$rst = $tmp->fetch_array();

		$totalWithdraw = $totalWithdraw + $rst['amount_fee_affiliate'];

		$dataOrder[] = $rst;
	}

	$noPayment = 'CA'.date('ymdHis');

	$query = "insert into affiliate_withdraw_fee
			   set affiliate_id = '{$userId}',
				   affiliate_bank_id = '{$affiliateBankId}',
				   no_payment = '{$noPayment}',
				   from_bank = 'Pencairan Komisi',
				   total_withdraw = '{$totalWithdraw}',
				   date_transfer = curdate(),
				   date_input = now()";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	$affiliateWithdrawFeeId = mysqli_insert_id($globalConDBMySQL);

	foreach($dataOrder as $val) {
		$query = "insert into affiliate_withdraw_fee_detail
				   set affiliate_withdraw_fee_id = '{$affiliateWithdrawFeeId}',
					   sales_order_id = '{$val['id']}',
					   sales_order_number = '{$val['no_order']}',
					   amount_fee_affiliate = '{$val['amount_fee_affiliate']}'";

		$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	}

	mysqli_commit($globalConDBMySQL);

	include_once 'sbiz/lib/connection-close.php';

	header('Location: '.$globalUrl.'commission/index?msg=addSuccess');

?>
