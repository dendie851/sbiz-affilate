<?php 
	@session_start();
	auth::isToken('errorPage/general');

	include_once 'sbiz/lib/connection.php';
	include_once 'sbiz/lib/email.class.php';
	include_once 'forgotValidate.php';

	$email = general::secureInput(trim($_POST['email']));


	$query = "delete from marketing_reset_password
			  where email = '$email'";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
	$confirmResetCode = getCode($globalConDBMySQL);

	$query = "insert marketing_reset_password
			   set code = '$confirmResetCode',
			     email = '$email',			 
			     date_create = now()";

	$globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));

	include_once 'sbiz/lib/connection-close.php';

	// Email	
	$to = $email;
	$from = 'noreply@digivo.biz';
	$subject = "Digivo : Konfirmasi Reset Password";
	$message = "
	    <h2>Konfirmasi Reset Password</h2>
	    <p>Apakah Anda melakukan reset password, apabila TIDAK mohon abaikan konfirmasi email reset password ini, tetapi apabila Anda melakukan RESET PASSSWORD silakan tekan LINK di bawah ini.
	    </p>
		<p><a href='".$globalUrl."auth/reset?code=".$confirmResetCode."'><button style='height:40px; background-color:#24BF5A; cursor:pointer; border:0px; border-radius:10px; padding:10px; color:white; font-weight:bold'>KONFIRMASI RESET PASSWORD</button></a></p>";    				
    $email = new email();
   	$email->sendEmail($from,$to,$subject,$message,$config['app']['assets']); 	

    function getCode($globalConDBMySQL) {
		$confirmResetCode =  md5(rand(1000, 9999).'-'.rand(10000, 99990));

		$query = "select count(id) as jml from marketing_reset_password
				  where code = '$confirmResetCode'";

		$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
		$rst = $tmp->fetch_array();

		if($rst['jml'] == 0) {
			return $confirmResetCode;
		} else {
			getCode($globalConDBMySQL);
		}   	
    }

	header('Location: '.$globalUrl.'auth/forgotSuccess');

?>
