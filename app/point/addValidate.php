<?php 
	@session_start();
	auth::isAuth($globalUrl.'auth/login/index',$config['app']['name']);

	include_once 'sbiz/lib/connection.php';

	$loginInfo = $_SESSION['loginInfo'];
	$userId = $loginInfo['userId'];

	$statusError = 0;
	$messageError = '';

	$affiliateBankId = general::secureInput(trim($_POST['affiliateBankId']));
	$salesOrderId = isset($_POST['salesOrderId']) ? $_POST['salesOrderId'] : array();

	if(!is_array($salesOrderId) || count($salesOrderId) < 1) {
		$statusError = 1;
		$messageError = base64_encode("Data sales order belum dipilih");
	}

	if($affiliateBankId == '') {
		$statusError = 1;
		$messageError = base64_encode("Data rekening belum tersedia");
	}

	if($statusError == 0) {
		$query = "select count(id) as total
				  from affiliate_bank
				  where id = '{$affiliateBankId}'
				    and affiliate_id = '{$userId}'
				    and is_delete = '0'";

		$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
		$rst = $tmp->fetch_array();

		if($rst['total'] == 0) {
			$statusError = 1;
			$messageError = base64_encode("Data rekening tidak ditemukan");
		}
	}

	if($statusError == 0) {
		foreach($salesOrderId as $val) {
			$val = general::secureInput(trim($val));

			$query = "select count(so.id) as total
					  from sales_order as so
					  where so.id = '{$val}'
					    and so.affiliate_id = '{$userId}'
					    and so.is_delete = '0'
					    and so.id not in (select afwd.sales_order_id
										  from affiliate_withdraw_fee_detail as afwd)";

			$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
			$rst = $tmp->fetch_array();

			if($rst['total'] == 0) {
				$statusError = 1;
				$messageError = base64_encode("Terdapat data sales order yang tidak valid");
				break;
			}
		}
	}

	if($statusError == 1) {
		$messageError = urlencode(($messageError));
		header('Location: '.$globalUrl.'commission/add?msg=addFailed&messageError='.$messageError);
		exit;
	} 

	include_once 'sbiz/lib/connection-close.php';
?>
