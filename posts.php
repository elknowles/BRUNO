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
			<h1>POSTS</h1>
			<p><span id="datetime"></span></p>
			<script>
				var dt = new Date();
				document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
			</script>
		</div>
	</section>

</body>

</html>