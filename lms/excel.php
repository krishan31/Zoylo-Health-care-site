<?php
require_once('../config.php');
if(!isset($_SESSION['id'])){
  header('location:index.php');
} 



// Check connection

   
    
   $sql=$_SESSION['report'];
	 
  $result=$conn->query($sql);

  
    
 
 $op='
 <br><br><br>Polyvalent Digital Services <br><br>
       <table width="100%" border="1" style="border:1px solid black; text-align:center; font-weight:100; font-size:18px;">
	      <tr>
            <th>Lead ID</th>
             <th>Name</th>
             <th>Mobile</th>
             <th>Email</th>
             <th>Address</th>              
             <th>Eldest Member</th>              
             <th>Source</th>       
             <th>TimeStamp</th>
             <th>Status</th>
          </tr>
   ';


	while($row = $result->fetch_assoc())
	 {
		 $op .= '
		<tr>
		   <td>
		       '.$row["id"].'
		   </td>
		   <td>
		    '.$row["name"].'
           </td>
           <td>
		      '.$row["mobile"].'

		   </td>
		   <td>
		     '.$row["email"].'
		 </td>
		 <td>
		    '.$row["address"].'
		</td>
		<td>
		    '.$row["query"].'
		</td>
		<td>
		    '.$row["source"].'
		</td>
		<td>
		   '.$row["tm"].'
		</td>
		<td>
		   '.$row["status"].'
		</td>
		</tr>';
	 }
	 $op .= '</table>' ;
        header("content-Type: application/xls");
	header("content-Disposition: attachment; filename=report.xls");
	echo "$op";
	 

?>