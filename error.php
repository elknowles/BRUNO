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
			<h1>ERROR</h1>
			 	<div class="row">  <?php echo $_SESSION['Error']; ?></div>
			<p>Sorry about that mate, try again later?</p>
			<br>
      <p>This session handling stuff is complicated... <a href="index.html" style="color:red">Go back?</a>.</p>
    </div>
</section>

</body>

</html>
