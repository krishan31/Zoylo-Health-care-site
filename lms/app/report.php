<?php

require_once('../../config.php');

$invtsq="";
$status="";

if(isset($_POST['action']) && $_POST['action']=='report')
        {
        	$msg = "";
	   		$from 	= $_POST['datefrom'].' 00:00:00';
	   		$to 	= $_POST['dateto'].' 23:59:59';
	   
             if(isset($_POST['status']))
              {
              	if($_POST['status']!='All'){
	                $status=$_POST['status'];
	                $status="and status='".$_POST['status']."'";
            	}
             }

            
             
	
	if($from!=null && $to!=null){
		 $sql="select * from lead where tm >='".$from."' and tm <='".$to."' "."".$status.""."".$invtsq." order by tm DESC";
		 $_SESSION['report'] = $sql;
		//echo "sql = ".$sql;
		$count = 1;
		//$sql="select * from breathelms where lp1='source'";

		$result = mysqli_query($conn,$sql);
		 $rowcount = $result->num_rows;
		 if ($rowcount > 0) {
		// 	$msg = "";
		while($row = mysqli_fetch_assoc($result)) {
			$msg .= "<tr>
			<td>".$count."</td>
			<td>".$row['id']."</td>
			<td>".$row['name']."</td>
			<td>".$row['mobile']."</td>
			<td>".$row['email']."</td>
			<td>".$row['address']."</td>
			<td>".$row['query']."</td>
			<td>".$row['source']."</td>
			<td>".$row['tm']."</td>
			<td>".$row['status']."</td>
			</tr>
			";
			$count++;
		}
		$msg .='<tr><td align="center" colspan="7"><a href="excel.php" class="btn btn-primary"><i class="fa fa-download"></i> Download</a></td></tr>';
		$success = 1;
	 }
	 else{
	 	$msg = '<tr><td align="center" colspan="7">No Data Found..!</td></tr>';
	 	$success = 0;
	 }
		
	}
	
	
	 $responce = array('response'=> $success, 'msg'=> $msg);
	 echo json_encode($responce);
}


?>