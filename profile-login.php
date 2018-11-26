<?php
//session_start();


require_once "bruno-config.php";

$Username = $_POST['username'];
$Password = $_POST['password'];

$UserInfoSQL = "SELECT Username,Password FROM Profile WHERE Username =?";
if($GetUserInfo = $BrunoCONN->prepare($UserInfoSQL)){
  $GetUserInfo->bind_param("s",$ParamUsr);
  $ParamUsr =$Username;
  if($GetUserInfo->execute()){
      $GetUserInfo->store_result();
      if($GetUserInfo->num_rows == 1){
        $GetUserInfo->bind_result($Username,$PasswordVer);
        if($GetUserInfo->fetch()){
          if($Password === $PasswordVer){
            session_start();
            $_SESSION['Username'] =$Username;
            header("Location: http://localhost/BRUNO/profilehome.html");
          } else{
            $lgerror = "Incorrect password entered";
            $_SESSION['Error'] =$lgerror;
          }
        }
      }else {
        $lgerror = 'Username not located in database';
        $_SESSION['Error'] =$lgerror;
      }
    }else{
      $lgerror = 'Generic unhelpful error message';
      $_SESSION['Error'] =$lgerror;
    }
  }
  $GetUserInfo->close();

?>
