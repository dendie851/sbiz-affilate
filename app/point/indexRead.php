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

	include_once 'sbiz/lib/connection-close.php';
?>
