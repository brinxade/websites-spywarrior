<?php
require_once "appcore/config.php";
require_once CLIENT_HANDLER;

$status="";
$user=new User();
$destination=(!empty($_GET['destination']))?$_GET['destination']:"cms.php";
if($user->verify_auth())
	$user->redirect($destination);
if(!empty($_POST['username']) && !empty($_POST['password']))
	$status=$user->login($_POST['username'], $_POST['password']);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
		<title>Spywarrior - Admin Panel</title>
		
		<link rel="icon" type="image/png" href="favicon.png">
		<link href="css/core.css" rel="stylesheet" type="text/css">
		<link href="css/common.css" rel="stylesheet" type="text/css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<div style="padding:5px;" class="form-container size-full-view">
			<a href="/" style="display:block;color:White;max-width:200px;font-size:20px;text-align:center;margin:20px auto 0 auto;padding:15px;background:black;">Go to <strong>SpyWarrior</strong></a>
			<form id="login" class="form-s1 align-center" action="<?php echo $_SERVER['PHP_SELF']."?destination=".$destination; ?>" enctype="multipart/form-data" method="POST">
				<div class="inner">
					<h1 class="title">Login</h1>
					<div class="field-group">
						<input class="if-s1" type="text" placeholder="Username" name="username"/>
						<input class="if-s1" type="password" placeholder="Password" name="password"/>
					</div>
					<div class="field-group">
						<p class="status-text error"><?php echo $status; ?></p>
						<button class="btn-s1" form="login">Login</button>
					</div>
				</div>
			</form>
		</div>
		<script src="https://kit.fontawesome.com/6f67bd47b3.js" crossorigin="anonymous"></script>
	</body>
</html>