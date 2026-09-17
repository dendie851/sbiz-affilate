<?php 
	@session_start();

	include_once 'sbiz/lib/connection.php';
	include_once 'sbiz/lib/email.class.php';

	$code = general::secureInput(trim($_GET['code']));

	$query = "select count(id) as total
			  from marketing_reset_password 
			  where code = '$code'";
	$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$rst = $tmp->fetch_array();

	if($rst['total'] == '1') {
		$query = "select email
				  from marketing_reset_password 
				  where code = '$code'";

		$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
		$rst2 = $tmp->fetch_array();
		$email = $rst2['email'];

		$newPassword = rand(1000, 9999);	

		$query = "update marketing
				   set password = md5('$newPassword')
				  where email = '$email'
				    and is_delete = '0'";
		$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

		/*
		$query = "delete from marketing_reset_password
				  where code = '$code'";
		$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
		*/

		// Email	
		$to = $email;
		$from = 'noreply@digivo.biz';
		$subject = "Digivo : Reset Password";
		$message = "
		    <h2>Reset Password</h2>
			<p>Berikut ini adalah password baru Anda : <b style='color:black'>".$newPassword."</b></p>
	    	";    				
	    $email = new email();
	   $email->sendEmail($from,$to,$subject,$message,$config['app']['assets']); 

		include_once 'sbiz/lib/connection-close.php';

		header('Location: '.$globalUrl.'auth/resetSuccess');
	} else {
		header('Location: '.$globalUrl);
	}
?>
