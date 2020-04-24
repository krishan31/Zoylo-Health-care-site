<?php 
require_once('config.php');
if(isset($_POST['action']) && $_POST['action']=='queryform')
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = '91'.$_POST['phone'];
	$address = $_POST['address'];
	$source = $_POST['source'];
	$medium = $_POST['medium'];
	$tmp = date('Y-m-d H:i:s');
	$otp 	= $_POST['otp'];
    $ip = $_SERVER['REMOTE_ADDR'];

	if(empty($otp)){
	    	$response = array('success'=>2, 'msg'=>"Invalid otp");
	}
	else{
		//GET MESSAGE DELIVERY STATUS
		$sql = "SELECT `msg_status` FROM `breathelms` where lmob=$phone";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
    		$row = $result->fetch_row();
        	$status = $row[0];
		}
		
			if($status=="DELIVERED"){
				if((isset($_SESSION['OTP'])) && ($_SESSION['OTP']==$otp)){
					$sql="UPDATE `breathelms` SET lname='$name', leml='$email', lmob='$phone', laddrs='$address', source='$source', medium='$medium',ip='$ip',status='Verified' WHERE lmob='$phone'";
					 	if (mysqli_query($conn, $sql)) {
					    	$response = array('success'=>1, 'msg'=>"Thank You for showing your interest in LSAT-India, we will get back to you shortly");
						} else {
						    // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					    	$response = array('success'=>0, 'msg'=>mysqli_error($conn));
						}
					}

				else{
		    	$response = array('success'=>2, 'msg'=>"OTP Mismatch...!");
				}
		}
		else{
		    	$response = array('success'=>2, 'msg'=>"OTP not delivered...!");
		}
	 	
	}
echo json_encode($response);  
}

 ?>