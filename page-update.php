<?php
session_start();
?>
<html>
<body>
<?php

require_once "bruno-config.php";

$ImageDir ="Images/Pages/";

$actPgId = $_SESSION['APgID'];
//echo ":". $actPgId;
$PageName = $_POST['pageName'];
$PageDesc = $_POST['description'];
$PageCat = $_POST['category'];
$PageImg = basename($_FILES["file"["name"]]);

$TargetFilePath = $ImageDir. $PageImg;

// if(move_uploaded_file($_FILES["file"]["tmp_name"],$TargetFilePath)){
//   //we good
// }
// else{
//   $_SESSION['Error'] = "File upload failed";
// }


$UpdatePgSQL = "UPDATE Page SET Name ='$PageName', Description = '$PageDesc', Category ='$PageCat', Image ='$PageImg' WHERE PageID='$actPgId'";
//prepare query statement
if($BrunoCONN->query($UpdatePgSQL) === TRUE){
  echo "execution completed";
   header("Location: http://localhost/BRUNO/pageHome.php");
    $BrunoCONN->close();
  }
  else{
    $_SESSION['Error'] = "Query failed to execute";
    //  header("Location: http://localhost/BRUNO/error.php");
    $BrunoCONN->close();
}

?>
</body>
</html>
