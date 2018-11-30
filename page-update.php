<?php
session_start();
?>

<?php

require_once "bruno-config.php";
//<html>
//<body>
$ImageDir ="Images/Pages/";

$actPgId = $_SESSION['APgID'];
$PageName = $_POST['Name'];
$PageDesc = $_POST['Description'];
$PageCat = $_POST['Category'];
$PageImg = basename($_FILES["file"["name"]]);

$TargetFilePath = $ImageDir. $PageImg;

// if(move_uploaded_file($_FILES["file"]["tmp_name"],$TargetFilePath)){
//   //we good
// }
// else{
//   $_SESSION['Error'] = "File upload failed";
// }


$UpdatePgSQL = "UPDATE Page SET Name =?, Description = ?, Category =?, Image =? WHERE PageID= ?";
//prepare query statement
if($UpdatePage = $BrunoCONN->prepare($UpdatePgSQL)){

  $UpdatePage->bind_param("sssss",$ParamPgName,$ParamPgDesc,$ParamPgCat,$ParamPgImg,$ParamPgID);
  //Designate variable for pageid binding
  $ParamPgID = $actPgId;
  $ParamPgDes =$PageDesc;
  $ParamPgCat = $PageCat;
  $ParamPgName = $PageName;
  $ParamPgImg = $PageImg;
  if($UpdatePage->execute()){
    //execute Query
    header("Location: http://localhost/BRUNO/pageHome.php");
    $BrunoCONN->close();
  }
  else{
    $_SESSION['Error'] = "Query failed to execute";
    $BrunoCONN->close();
  }
}
else{
  $_SESSION['Error'] = "Error preparing";
}

?>
</body>
</html>
