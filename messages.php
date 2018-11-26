<!DOCTYPE html>
<html>

<head>
	<title>BRUNO</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/anonymous-pro" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		#recipient {
			width: 150px;
			color: black;
		}
		#recipient option {
			width: 150;
			color: black;
		}
	</style>
</head>

<body>
	<section class="hero">
		<div class="hero-inner">
			<form action="sendMessage.php">
				<h1>MESSAGES</h1>
				<h3>Select the recipient</h3>
				<tr>
					<td>Recipient</td>
					<td>
						<select name="recipient" id="recipient" style="color: black">
						<?php 
						require_once 'bruno-config.php';
							$sql = mysqli_query($BrunoCONN, "SELECT P.Username FROM Profile as P WHERE Privacy = '1'");
							while ($row = $sql->fetch_assoc()){
							echo "<option value=\"owner1\">" . $row['username'] . "</option>";
							}
						?>
						</select>
					</td>
				</tr>
				<button type="submit" class="submitbtn">Submit</button>
			</form>
		</div>
	</section>

</body>

</html>
