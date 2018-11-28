<?php
session_start();
require_once "bruno-config.php";
require_once "get-profileid.php";
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
			<form id="pageSelection" action="pageHome.php" method="post">
				<h1>Pages</h1>
				<h3>Select the PageID</h3>
				<tr>
					<td>Page</td>
					<td>
						<select name="PageID" id="recipient" style="color: black" value="">
						<?php
						require_once 'bruno-config.php';
  							$sql = mysqli_query($BrunoCONN, "SELECT P.PageID FROM Page as P WHERE CreatorID ='$PrID'");
							while ($row = $sql->fetch_assoc()){
							echo "<option>" . $row['PageID'] . "</option>";
							}
						?>
						</select>
						<!--<input type="submit" name="formSubmit" value="Submit" />-->
						<input type="hidden" name="action1" value="selectRecipient" id="action1" />
						<br>
					</td>
					<tr>
					<td>Page</td>
					<td>
						<form>
							<label for="username"><b>Enter the Page's ID:</b></label>
							<input type="text" placeholder="Enter PageID" name="pageid" minlength="8" maxlength="12">
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
