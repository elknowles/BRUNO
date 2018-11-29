<?php
session_start();
?>
<!DOCTYPE html>
<?php
$_SESSION['ActivePageID'] = $_POST['pageid'];
require_once 'bruno-config.php';
//require_once 'get-pagename.php';
?>
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
			<h1> <?php echo $PGname ?> </h1>
			<p><span id="datetime"></span></p>
			<script>
				var dt = new Date();
				document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
			</script>
			<div id="outer">
				<div class="inner"><button onclick="window.location.href='pageSettings.html'" class="btn circ" style="background-color: transparent; width: 125px; height: 125px; border: 2px solid white; color: white; padding: 8px 20px; border-radius: 50%; font-size: 20px; font-weight: bold;text-align: center;">Settings</button></div>
			</div>
		</div>
		<ul>
			<li><a href="index.html" style="color:white">Sign Out</a></li>
		</ul>
	</section>

	<section class="postHistory">
		<p>You are a page</p>
	</section>



</body>

</html>
