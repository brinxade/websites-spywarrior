<?php 
    require_once "appcore/config.php";
    require_once CLIENT_HANDLER;
    require_once CLIENT_COMMONS;

	$status="";
	$user=new User();
	if(!$user->verify_auth())
		$user->redirect("index.php?destination=cms-events.php");

?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <title>Spywarrior - Manage Event</title>
		<?php echo $client_commons["head"]; ?>
	</head>
	<body>
        <header id="header" class="base-padding"></header>
        <nav id="main-nav"></nav>
        <section id="change-password"></section>

        <main class="cms-edit-events cms-main">
			<div class="inner padding">
                <section class="cms-subsection cms-event-uploader">
                    <h1 class="title nm-top">Upload Content</h1>
                    <div class="content">
                        <p>
                            For videos, only use <strong>.mp4</strong> format<br/>
                            For photos, only use <strong>.jpg or .png</strong> formats<br/>
                        </p><br/>
                        <input type="file" id="event-file" name="event-file" class="if-f-s1"/>
                        <button id="event-upload" class="btn-s1">Upload</button>
                        <span class="loader inline-loader"><img src="images/loaders/bar-blue.gif"/></span>
                    </div>
                    <p id="status-text" class="status-text-uploader"></p>
                </section>
				<section class="cms-subsection cms-event-photos">
                    <h1 class="title nm-top">Photos</h1>
                    <div class="content">
                        <div class="loader-visible"><img src="images/loaders/round-transparent.svg"/></div>
                    </div>
                </section>
                <section class="cms-subsection cms-event-videos">
                    <h1 class="title nm-top">Video</h1>
                    <div class="content">
                        <div class="loader-visible"><img src="images/loaders/round-transparent.svg"/></div>
                    </div>
                </section>
            </div>
        </main>

        <?php echo $client_commons["footer"]; ?>
        <script src="scripts/manage_events.js"></script>
	</body>
</html>