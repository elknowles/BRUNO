<?php

require_once "bruno-config.php";

require_once "get-profileid.php";

$ProfileDeleteSQL = "DELETE FROM Profile WHERE ProfileID = '$PrID'";

if($BrunoCONN->query($ProfileDeleteSQL) === TRUE){
  echo "Your Profile has been terminated";
  $BrunoCONN->close();
  header("Location: http://localhost/BRUNO/");
}else{
    $_SESSION['Error'] = $ProfileDeleteSQL. "<br>" . $BrunoCONN->error;
  }

  session_unset();
  session_destroy();
?>
