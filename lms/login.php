<?php

require_once('../config.php');

if(isset($_POST['action']) && $_POST['action']=='login'){

$id = $_POST['username'];
$password = $_POST['password'];

$sql="select * from user where username='".$id."' and password='".$password."'";

$result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      if($count == 1){
      	$row =$result->fetch_assoc();
      	$_SESSION['id'] = $row['id'];
      	header('location:report.php');
	     }
	     else{
	     	$_SESSION['error'] = "Username or Password is not valid, Please try again";
	     	header('location:index.php');
	     }

}
else{
	header('location:index.php');
}

?>