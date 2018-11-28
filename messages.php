<?php
session_start();
?>
<?php
	require_once "bruno-config.php";
	//$Recipient = $_POST['Recipient'];
	//$_SESSION['Recipient'] =$Recipient;
	//echo $Recipient;
	//$_POST['recipent'];
?>
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
			<form id="recipentSelection" action="sendMessage.php" method="post">
				<h1>MESSAGES</h1>
				<h3>Select the recipient</h3>
				<tr>
					<td>Recipient</td>
					<td>
						<select name="recipient" id="recipient" style="color: black" value="">
						<?php
						require_once 'bruno-config.php';
  							$sql = mysqli_query($BrunoCONN, "SELECT P.Username FROM Profile as P WHERE Privacy = '1'");
							while ($row = $sql->fetch_assoc()){
							echo "<option>" . $row['Username'] . "</option>";
							}
						?>
						</select>
						<!--<input type="submit" name="formSubmit" value="Submit" />-->
						<input type="hidden" name="action1" value="selectRecipient" id="action1" />
						<h1><?php echo $_SESSION['Recipient'] ?></h1>
					</td>
					<tr>
					<td>Recipient</td>
					<td>
						<form>
							<label for="username"><b>Enter the Recipient's Username:</b></label>
							<input type="text" placeholder="Enter Username" name="recipient" minlength="8" maxlength="12">
							<input type="submit" value="Send" style="width: 128px; height: 128px; border-radius: 50%;">
						</form>
					</td>
				</tr>
				</tr>
			</form>
		</div>
	</section>

</body>

</html>
