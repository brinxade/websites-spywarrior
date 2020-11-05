<?php 
if(session_id()=='')
	session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/admin/appcore/config.php';
require_once DB_HANDLER;

class User
{
	private $hash_algo="sha256";
	private $db_connection;
	private $destination="/";
	private $user_name;
	private $user_id;
	public $logged_in=0;
	
	function __construct()
	{
		if(isset($_GET['destination']))
			$this->destination=$_GET['destination'];
		else
			$this->destination='/';
		
		$this->db_connection=new DatabaseConnection();
		$this->verify_auth();
	}

	function login($username, $password)
	{
		$db=$this->db_connection;
		$q="SELECT `id` from `admin_accounts` WHERE `username`='$username' AND `password`='$password'";
		$result=$db->query($q);

		if($result->num_rows==1)
		{
			$_SESSION['user-id']=$result->fetch_assoc()['id'];
			$_SESSION['user-name']=$username;
			$_SESSION['user-logged-in']=1;
			$this->logged_in=1;
			$this->user_name=$username;

			$this->redirect($this->destination);
			return "Logging In";
		}
		else
		{
			return "Invalid Credentials";
		}
	}

	function verify_auth()
	{
		if(isset($_SESSION['user-id']) && isset($_SESSION['user-name']) && isset($_SESSION['user-logged-in']))
		{
			$this->logged_in=1;
			$this->user_name=$_SESSION['user-name'];
			$this->user_id=$_SESSION['user-id'];
			return true;
		}
		else
		{
			$this->logged_in=0;
			return false;
		}
	}

	function change_password($current_password, $new_password)
	{
		$db=$this->db_connection;
		$q="UPDATE admin_accounts SET `password`='$new_password' WHERE `username`='$this->user_name' AND `password`='$current_password'";
		$result=$db->query($q);

		if($db->conn->affected_rows==1)
			return true;
		else
			return false;
	}

	function redirect($url, $status_code = 303)
	{
		header('Location: ' . $url, true, $status_code);
		die();
	}
}

?>