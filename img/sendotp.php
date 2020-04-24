
<?php 

require_once('config.php');

if(isset($_POST['mobile'])){
	$SentTo='91'.$_POST['mobile'];
	$sql = "SELECT `lid` FROM `breathelms` where lmob=$SentTo AND status='Verified'";
	$result = mysqli_query($conn,$sql);
	$rowcount = $result->num_rows;
	if ($rowcount > 0){
		   $response = array('Status'=>"Error", 'Details'=>"Number allready registered");
	}
	else{
		unset($_SESSION["mobile"]);
		unset($_SESSION["msg_id"]);
		unset($_SESSION["OTP"]);
 
$id 		= 'LSAT18';
$username 	= 'democts';
$pwd 		= 'SXWztztvp';
$otp 		= mt_rand(100000, 999999);

$msg 	 =  $otp;
$msg 	.= ' is your one time password(OTP) for phone verification.';
$msg 	.= ' Thankyou for showing your interest in LSAT-India. ';

$msg = urlencode($msg);

$tmp = date('Y-m-d H:i:s');

$url = "https://smsapp.mx9.in/smpp/?username=$username&password=$pwd&from=$id&to=$SentTo&text=$msg";

$tm = date('Y-m-d H:i:s');

$ch = curl_init( $url );
// curl_setopt( $ch, CURLOPT_POST, 1);
// curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
// curl_setopt( $ch, CURLOPT_HEADER, 0);
 curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt( $ch, CURLOPT_HEADER, 0);

$response = curl_exec( $ch );

curl_close($ch);
echo "res = ".$response;


$mobile = substr($response,0,12);
$msg_id = substr($response,15);

$_SESSION['mobile'] = $SentTo;
$_SESSION['msg_id'] = $msg_id;
$_SESSION['OTP'] = $otp;

print_r($_SESSION);


		$sql="INSERT INTO `breathelms` (`lmob`,`msg_id`,`tm`,`status`) VALUES('$SentTo', '$msg_id', '$tm', 'Not Verified')";

		 	if (mysqli_query($conn, $sql)) {
		 		//$_SESSION['OTP'] = $otp;
		    	$response = array('Status'=>"Success", 'Details'=>"OTP Sent");
		    }
		    else{

		    	$response = array('Status'=>"Error", 'Details'=>"OTP Resent");
		    }

}
echo json_encode($response);  
}

?>