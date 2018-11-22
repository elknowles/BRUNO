<?php
session_start();
?>
<html>
<body>
<?php
require_once 'bruno-config.php';

$TargetDir ="Images/Avatars/";
$AvatarFile = basename($_FILES["file"]["name"]);
$TargetFilePath = $TargetDir . $AvatarFile;
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

  if(move_uploaded_file($_FILES["file"]["tmp_name"], $TargetFilePath)){
    $AddAvatarSQL = "UPDATE Profile SET Avatar =? WHERE ProfileID=?";
    if($AddAvatar = $BrunoCONN->prepare($AddAvatarSQL)){
      $AddAvatar->bind_param("ss",$ParamFile,$ParamPrID);
      $ParamPrID =$PrID;
      $ParamFile =$AvatarFile;
      if($AddAvatar->execute()){
        //Execute query
        $_SESSION['ActiveAvatar'] = $TargetFilePath;
        header("Location: http://localhost/BRUNO/profilehome.html");
        $BrunoCONN->close();
      }
      else{
        //Query failed
        $averr = "Error: ".$PostInsertPage."<br>".$BrunoCONN->error;
        $_SESSION['Error'] =$averr;
        header("Location: http://localhost/BRUNO/error.php");
        $BrunoCONN->close();
      }
    }
  }


?>

</html>
</body>
