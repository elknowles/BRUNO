<?php
session_start();
?>
<!DOCTYPE html>
<?php
  $_SESSION['RecipUsr'] =$_POST['recipient'];
 ?>
<html>

<head>
	<title>BRUNO</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/anonymous-pro" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>



<body>
	<div id="Text">
		<h1><?php echo $_POST['recipient']?></h1>
 		<img src="profilePlaceholder.png" style="position: fixed; top: 50px; left: 50px; width: 128px; height: 128px; border-radius: 50%;">
			<form action="message-insert.php" method="post">
				<input type="text" name="TContent" style="left: 200px; width: 600px; height: 600px; border-radius: 50%;">
				<input type="submit" value="Send" style="width: 128px; height: 128px; border-radius: 50%;">
			</form>
	</div>
</body>
</html>
