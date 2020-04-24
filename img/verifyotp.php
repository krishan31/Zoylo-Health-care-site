<?php
require_once('config.php');

if((isset($_GET['qMsgRef'])) && (isset($_GET['qStatus'])) && (isset($_GET['qMobile'])) && (isset($_GET['qDTime'])))
{
$msg_id   = $_GET['qMsgRef'];
$status   = $_GET['qStatus'];
$mobile   = $_GET['qMobile'];
$dtime    = $_GET['qDTime'];

$data = 'msg_id='.$msg_id.', status='.$status.', mobile='.$mobile.', time='.$dtime.'';

$sql="UPDATE `breathelms` SET msg_status='$status' WHERE lmob='$mobile'";
//$sql="UPDATE `breathelms` SET status='$data' WHERE 1=1";

		 	if (mysqli_query($conn, $sql)) {
		    	$response = array('success'=>1, 'msg'=>"Success");
		    }
		    else{
		    	$response = array('success'=>0, 'msg'=>"Error");
		    }
$response = $data;
$response = json_encode($response);
echo $response;
}

 

?>