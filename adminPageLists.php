<?php
session_start();
?>
<html>
<body>
<?php
require_once "bruno-config.php";

$AllPageInfoSQL ="SELECT * FROM Page";

if($AdminPgInfo = $BrunoCONN->prepare($AllPageInfoSQL)){

  if($AdminPgInfo->execute()){
      $AdminPgInfo->store_result();
      $AdminPgInfo->bind_result($PgID,$PgName,$PgDesc,$PgCat,$PgImg,$PgCreatorID);
      $Rowcount = $AdminPgInfo->num_rows;

      while ($AdminPgInfo->fetch()) {
        echo 'PageID: ' .$PgID. "<br>";
        echo 'PageName: ' .$PgName. "<br>";
        echo 'PageDescription: ' .$PgDesc. "<br>";
        echo 'PageCategory: ' .$PgCat. "<br>";
        echo 'CreatorID: ' .$PgCreatorID. "<br>";
        echo 'PageImage: '.$PgImg. "<br>";
        echo "--PAGE-- <br>";
      }
    }
    else{
      $_SESSION['Error'] = "Error executing ???";
      header("Location: http://localhost/BRUNO/error.php");
    }
}
else {
  $_SESSION['Error'] = "Error preparing???";
  header("Location: http://localhost/BRUNO/error.php");
}



?>
