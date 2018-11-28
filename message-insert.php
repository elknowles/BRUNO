<?php
session_start();
?>
<html>
<body>
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
  $ID = $idroot->getElementsByTagName('msgid')->item(0)->textContent;
  if($mode === 0){
    ++$ID;
  }
  else{
    --$ID;
  }
  $idroot->getElementsByTagName('msgid')->item(0)->textContent = $ID;
  $idfile->save('id.xml');
  return $ID;
}
$MessageID = generateMsgID(0);
$CreationDate = date('Y-m-d H:i:s');
$Content = $_POST['TContent'];
$RecipUsername = $_SESSION['RecipUsr'];
$RecipientIDSQL = "SELECT ProfileID FROM Profile WHERE Username =?";
if($GetUserInfo = $BrunoCONN->prepare($RecipientIDSQL)){
	  $GetUserInfo->bind_param("s",$ParamUsr);
	  //Designate variable for username binding
	  $ParamUsr =$RecipUsername;
	  //Actually pass the username into the bound variable
	  if($GetUserInfo->execute()){
	    //Execute query
	      $GetUserInfo->store_result();
	      //Store result of query
	      if($GetUserInfo->num_rows == 1){
	        //See if username found in database
	        $GetUserInfo->bind_result($RecipPrID);
          if($GetUserInfo->fetch()){
            //RecipientID stored in $RecipPrID variable
          }
	      }else {
	        $lgerror = 'Username not located in database';
	        $_SESSION['Error'] =$lgerror;
          generateMsgID(-1);
	      }
	  }
	}
  require_once "get-profileid.php";
$InsertMessage =" INSERT INTO Message(MessageID, SenderID, RecipientID, `TimeStamp`, `Text`)
VALUES('$MessageID','$PrID','$RecipPrID','$CreationDate','$Content')";
if($BrunoCONN->query($InsertMessage) === TRUE){
  echo "message sent to ",$RecipUsername. "<br>";
  $BrunoCONN->close();
}else{
  $_SESSION['Error'] = "Error: ".$InsertMessage. "<br>". $BrunoCONN->error;
  header("Location: http://localhost/BRUNO/error.php");
  $BrunoCONN->close();
  generateMsgID(-1);
}
?>
</body>
</html>
