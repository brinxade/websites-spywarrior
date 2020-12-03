<?php
require_once "appcore/config.php";
require_once CLIENT_HANDLER;

$status="";
$user=new User();
if(!$user->verify_auth())
	$user->redirect("index.php");

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
		<header id="header" class="base-padding">
		</header>
		<nav id="main-nav"></nav>
		<section id="change-password"></section>
		<main class="welcome-message">
			<p><span>Welcome <?php echo $_SESSION['user-name']; ?>,</span> <br/><br/>If you find any problems in managing your website<br/> you can ask for help <a href="mailto:brinxade@gmail.com">here</a>.</p>
		</main>
		<footer id="footer" class="base-padding"></footer>
		<script src="scripts/loader.js"></script>
		<script src="scripts/ui.js"></script>
		<script src="https://kit.fontawesome.com/6f67bd47b3.js" crossorigin="anonymous"></script>
	</body>
</html>