<?php
session_start();
require_once "bruno-config.php";

$PgID = $_SESSION['APgID'];

$PageDeleteSQL = "DELETE FROM Page WHERE PageID = '$PgID'";

if($BrunoCONN->query($PageDeleteSQL)=== TRUE){
  echo "Your Page has been deleted";
  $BrunoCONN->close();
  header("Location: http://localhost/BRUNO/profileHome.php");
}
else{
    $_SESSION['Error'] = $PageDeleteSQL. "<br>" . $BrunoCONN->error;
      header("Location: http://localhost/BRUNO/error.php");
}
