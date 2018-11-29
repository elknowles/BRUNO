<?php
session_start();

$PgID = $_SESSION['ActivePageID'];

$PageNameSQL = "SELECT Name FROM Page WHERE PageID =? ";
if($GetPageName = $BrunoCONN->prepare($PageNameSQL)){
  $GetPageName->bind_param("s",'$pramPgID');
  $paramPgID = $PgID;
    if($GetPageName->execute()){
      $GetPageName->store_result();
      if($GetPageName->num_rows == 1){
        $GetPageName->bind_result($PGname);
        if($GetPageName->fetch()){
          // Name stored in $PGname
      }
    }else{
      $lgerror = 'Page not located in database';
      $_SESSION['Error'] =$lgerror;
      header("Location: http://localhost/BRUNO/error.php");
    }
  }else{
    $lgerror = 'Query failed to execute';
    $_SESSION['Error'] =$lgerror;
    header("Location: http://localhost/BRUNO/error.php");
  }
}
$GetPageName->close();
?>
