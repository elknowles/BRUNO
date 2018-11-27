<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>BRUNO</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/anonymous-pro" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<section class="hero">
		<div class="hero-inner">
			<h1><?php echo $_SESSION['Username'] ?></h1>
			<p><span id="datetime"></span></p>
			<script>
				var dt = new Date();
				document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
			</script>
			<div id="outer">
				<div class="inner"><button onclick="window.location.href='posts.html'" class="btn circ" style="background-color: transparent; width: 125px; height: 125px; border: 2px solid white; color: white; padding: 8px 20px; border-radius: 50%; font-size: 20px; font-weight: bold;text-align: center;">Feed</button></div>
				<div class="inner"><button onclick="window.location.href='messages.php'" class="btn circ" style="background-color: transparent; width: 125px; height: 125px; border: 2px solid white; color: white; padding: 8px 20px; border-radius: 50%; font-size: 20px; font-weight: bold;text-align: center;">Messages</button></div>
				<div class="inner"><button onclick="window.location.href='alerts.html'" class="btn circ" style="background-color: transparent; width: 125px; height: 125px; border: 2px solid white; color: white; padding: 8px 20px; border-radius: 50%; font-size: 20px; font-weight: bold;text-align: center;">Alerts</button></div>
				<div class="inner"><button onclick="window.location.href='settings.html'" class="btn circ" style="background-color: transparent; width: 125px; height: 125px; border: 2px solid white; color: white; padding: 8px 20px; border-radius: 50%; font-size: 20px; font-weight: bold;text-align: center;">Settings</button></div>
			</div>
		</div>
		<ul>
			<li><a href="index.html" style="color:white">Sign Out</a></li>
		</ul>
	</section>

	<section class="postHistory">
		<p>You can view your post history</p>
		<p>Lots and lots and lots of post history</p>
		<p>Just keep scrolling</p>
		<p>Everything in BRUNO has 4 columns</p>
		<p>Not that I can figure out columns</p>
		<p>BRUNO's dark blue color is #000034</p>
		<p>It does still need a lighter color compliment</p>
	</section>



</body>

</html>
