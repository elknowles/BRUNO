<?php
session_start();


$Username = $_SESSION['Username'];

$ProfileIDSQL = "SELECT ProfileID FROM Profile WHERE Username =?";
if($GetProfileID = $BrunoCONN->prepare($ProfileIDSQL)){
  $GetProfileID->bind_param("s",$ParamUsr);
  $ParamUsr =$Username;
  if($GetProfileID->execute()){
    $GetProfileID->store_result();
    if($GetProfileID->num_rows == 1){
      $GetProfileID->bind_result($PrID);
      if($GetProfileID->fetch()){
        // ProfileID stored in $PrID variable
      }
    }else{
      $lgerror = 'Username not located in database';
      $_SESSION['Error'] =$lgerror;
      header("Location: http://localhost/BRUNO/error.php");
    }
  }else{
    $lgerror = 'Query failed to execute';
    $_SESSION['Error'] =$lgerror;
    header("Location: http://localhost/BRUNO/error.php");
  }
}
$GetProfileID->close();

$PageIDSQL ="SELECT PageID FROM Page WHERE CreatorID= ?";
if($GetPageID = $BrunoCONN->prepare($PageIDSQL)){
  $GetPageID->bind_param("s",$ParamPrID);
  $ParamPrID = $PrID;
  if($GetPageID->execute()){
    $GetPageID->store_result();
    if($GetPageID->num_rows == 1 ){
      $GetPageID->bind_result($PgID);
      if($GetPageID->fetch()){
        //PageID stored in $PaID variable
      }
    }else{
      $lgerror = 'Page not located in database';
      $_SESSION['Error'] =$lgerror;
      header("Location: http://localhost/BRUNO/error.php");
    }
  }
  else{
    $lgerror = 'Query unable to execute';
    $_SESSION['Error'] =$lgerror;
    header("Location: http://localhost/BRUNO/error.php");
  }
}
$GetPageID->close();

?>
