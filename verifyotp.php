<?php

$curl = curl_init();
$YourAPIKey = 'd4429fee-21e8-11e8-a895-0200cd936042';
$SessionId  = 'd7745416-2367-11e8-a895-0200cd936042';
$otp        = '58875';

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

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
echo $response; 
// if ($err) {
//   // echo "cURL Error #:" . $err;
//   echo "ram";
// } else {
//   echo $response;
// }


?>