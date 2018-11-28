<?php
session_start();
?>

<html>
<body>
<?php

require_once 'bruno-config.php';
require_once 'get-profileid.php';

$UsrMessagesSQL = "SELECT M.MessageID, M.TimeStamp, M.Text, P.Username FROM Message as M JOIN Profile as P ON P.ProfileID = M.SenderID WHERE RecipientID =?";
if($Mymsgs = $BrunoCONN->prepare($UsrMessagesSQL)){
  $Mymsgs->bind_param("s",$ParamID);
  $ParamID = $PrID;
  if($Mymsgs->execute()){
    $Mymsgs->store_result();
    if($Mymsgs->num_rows >0){
      $Mymsgs->bind_result($MSGID,$CreationDate,$Content,$SenderUsr);
      while ($Mymsgs->fetch()) {
          echo $SenderUsr ."<br>";
          echo $Content. "<br>";
          echo "At :". $CreationDate. "<br>";
          echo $MSGID. "<br>";
          echo "-----STOP-----<br><br>";
      }
    }
    else{
      echo "No Messages :(";
      }
  }else{
    $_SESSION['Error'] = "Error executing ???";
    header("Location: http://localhost/BRUNO/error.php");
  }
}
else {
$_SESSION['Error'] = "Error preparing???";
header("Location: http://localhost/BRUNO/error.php");
}

?>
</body>
</html>
