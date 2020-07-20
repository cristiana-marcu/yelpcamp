<?php
// Start the session
session_start();
$_SESSION['logged']="false";
?>


<!DOCTYPE html>
<html>
	<head>
		<title>YelpCamp</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous">
		<link  rel ="stylesheet" href="../public/stylesheets/landing.css">
	</head>
	<body>
        <div id="landing-header">
            <h1 class="display-4">Welcome to YelpCamp!</h1>
            <a href="campgrounds/index.php">View all campgrounds</a>
            <a href="/login" class="btn btn-light btn-lg">Log In</a>
        </div>
        <div id="cookieConsent">
            <div id="closeCookieConsent">x</div>
            This website is using cookies. <a href="legal/cookies.html" target="_blank">More info</a>. <a class="cookieConsentOK">Ok</a>
        </div>
        <ul class="slideshow">
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>

	</body>
</html>