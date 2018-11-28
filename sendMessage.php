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
	<div id="Text">
		<h1><?php echo $_SESSION['Recipient'] ?></h1>
 		<img src="profilePlaceholder.png" style="position: fixed; top: 50px; left: 50px; width: 128px; height: 128px; border-radius: 50%;">
			<form>
				<input type="text" name="TContent" style="left: 200px; width: 600px; height: 600px; border-radius: 50%;">
				<input type="submit" value="Send" style="width: 128px; height: 128px; border-radius: 50%;">
			</form>
	</div>
</body>
</html>

<?php
require_once "bruno-config.php";

function generateMsgID($mode) {
  $idfile = new DOMDocument();
  $idfile->load('id.xml');
  if ($idfile === FALSE) {
    echo "database key file missing, error";
    exit();
  }
  $idroot = $idfile->documentElement;
  $ID = $idroot->getElementsByTagName('messageid')->item(0)->textContent;
  if($mode === 0){
    ++$ID;
  }
  else{
    --$ID;
  }
  $idroot->getElementsByTagName('messageid')->item(0)->textContent = $ID;
  $idfile->save('id.xml');
  return $ID;
}

$_POST['TContent'];

?>