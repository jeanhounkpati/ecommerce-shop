<?php
if(isset($_SESSION['auth']))
{
	if($_SESSION['role_as']!=1)
	{
		$_SESSION['message'] = "you are not authorized to access this page";
		header('location:../index1.php');
	}
}
else{
	$_SESSION['messsage'] = "login to continue";
	header('location:../login.php');


}