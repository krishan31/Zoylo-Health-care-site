<?php 
require_once('config.php');
if(isset($_POST['action']) && $_POST['action']=='queryform')
{
	$name 		= $_POST['name'];
	$email 		= $_POST['email'];
	$phone 		= $_POST['phone'];
	$address 	= $_POST['city'];
	$query1 	= $_POST['query'];
	$source 	= $_POST['source'];
	$medium 	= $_POST['medium'];
	$tmp 		= date('Y-m-d H:i:s');
	$otp 		= $_POST['otp'];
	$sts 		= "Verified";
	if(empty($otp)){
	    	$response = array('success'=>2, 'msg'=>"Invalid otp");
	}
	else{
		//VERIFY OTP
		$curl = curl_init();
		$YourAPIKey = 'd4429fee-21e8-11e8-a895-0200cd936042';
		$SessionId  = $_SESSION['OTPSessionId'];

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://2factor.in/API/V1/$YourAPIKey/SMS/VERIFY/$SessionId/$otp",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded"
		  ),
		));

		$Response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$Response_json=json_decode($Response,false);
		$apistatus=$Response_json->Status;
			if($apistatus=="Success"){

			$sql1="INSERT INTO `lead` (`name`,`email`,`mobile`,`address`,`query`,`source`,`medium`,`status`,`tm`,`lp3`) VALUES('$name', '$email', '$phone', '$address','$query1','$source','$medium','$sts','$tmp','$LeadId')";

		 	if (mysqli_query($conn, $sql1)) {
		 	    $insert_id = mysqli_insert_id($conn);
				$_SESSION['insert_id']=$insert_id;
		    	$response = array('success'=>1, 'msg'=>"Thank You for showing your interest, we will get back to you shortly");
			} else {
			    // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		    	//$response = array('success'=>0, 'msg'=>mysqli_error($conn));
		    	$response = array('success'=>0, 'msg'=>'<Strong class="text-danger">Mobile number already registred with us</strong>');
			}
		}
		else{
		    	$response = array('success'=>2, 'msg'=>"Invalid OTP");
		}
	 	
	}
echo json_encode($response);  
}

 ?>