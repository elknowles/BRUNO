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
			<form>
				<h1>MESSAGES</h1>
				<h3>Select the recipient</h3>
				<tr>
					<td>Recipient</td>
					<td>
						<label for="username"><b>Enter the Recipient's Username:</b></label>
						<input type="text" placeholder="Enter Username" name="recipient" minlength="8" maxlength="12" required="1">
					</td>
				</tr>
				<button type="submit" class="submitbtn">Submit</button>
			</form>
		</div>
	</section>

</body>

<?php
	require_once "bruno-config.php";
	$Recipient = $_POST['recipient'];
	$RecipientIDSQL = "SELECT ProfileID FROM Profile WHERE Username =?";

	if($GetUserInfo = $BrunoCONN->prepare($UserInfoSQL)){
	  $GetUserInfo->bind_param("s",$ParamUsr);
	  //Designate variable for username binding
	  $ParamUsr =$Username;
	  //Actually pass the username into the bound variable
	  if($GetUserInfo->execute()){
	    //Execute query
	      $GetUserInfo->store_result();
	      //Store result of query
	      if($GetUserInfo->num_rows == 1){
	        //See if username found in database
	        $GetUserInfo->bind_result($Username,$AvatarFile);
	        header("sendMessage.php");
	      }else {
	        $lgerror = 'Username not located in database';
	        $_SESSION['Error'] =$lgerror;
	      }
	  }
	}
?>

</html>
