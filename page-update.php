<?php
session_start();
?>

<?php

require_once "bruno-config.php";
//<html>
//<body>
$actPgId = $_SESSION['ActivePageID'];
$PageName = $_POST['Name'];
$PageDesc = $_POST['Description'];
$PageCat = $_POST['Category'];
$PageImg = $_POST['img'];

$UpdatePgSQL = "UPDATE Page SET Name =?, Description = ?, Category =?, Image =? WHERE PageID= ?";
//prepare query statement
if($UpdatePage = $BrunoCONN->prepare($UpdatePgSQL)){
  $UpdatePage->bind_param("sssss",$ParamPgName,$ParamPgDesc,$ParamPgCat,$ParamPgImg,$ParamPgID);
  //Designate variable for pageid binding
  $ParamPgID = $actPgId;
  $paramPgDes =$PageDesc;
  //Actually pass the username into the bound variable
  if($UpdatePage->execute()){
    //execute Query

  }
}


//</body>
//</html>
