<?php 
if(session_id()=='')
	session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/admin/appcore/config.php';
require_once CLIENT_HANDLER;

if(!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password_confirm']))
{
	$user=new User();
	if($_POST['new_password']==$_POST['new_password_confirm'])
	{
		if($user->change_password($_POST['current_password'],$_POST['new_password']))
			echo json_encode("Password changed successfully");
		else
			echo json_encode("Failed to change password");
	}
	else
	{
		echo json_encode("New Passwords do not match");
	}
}
else
{
	echo json_encode("Please fill in all the fields");
}
?>