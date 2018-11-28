<?php
session_start();

require_once "bruno-config.php";

$Username = $_POST['username'];
$Password = $_POST['password'];
//Get info from login form

$UserInfoSQL = "SELECT Username,Password,Avatar FROM Profile WHERE Username =?";
//Prepare query statement
if($GetUserInfo = $BrunoCONN->prepare($UserInfoSQL)){
  $GetUserInfo->bind_param("s",$ParamUsr);
  //Designate variable for username binding
  $ParamUsr =$Username;
  //Actually pass the username into the bound variable
  if($GetUserInfo->execute()){
    //Execute query
      $GetUserInfo->store_result();
      //Store result of query
      if($GetUserInfo->num_rows == 1){
        //See if username found in database
        $GetUserInfo->bind_result($Username,$PasswordVer,$AvatarFile);
        //Designate variables to bind Username and Password values
        if($GetUserInfo->fetch()){
          //Get value of 'SELECTED' Username and Password
          if($Password === $PasswordVer){
            //Verify that entered password matches retrieved password
            session_start();
            //Start session with this user
            $_SESSION['Username'] =$Username;
            //Store active username in session var
            $AvatarDir ="Images/Avatars/";
            $_SESSION['ActiveAvatar']= $AvatarDir . $AvatarFile;
            //Store users avatar in session variable
            header("Location: http://localhost/BRUNO/profilehome.php");
            //Redirect to profile page
          } else{
            $lgerror = "Incorrect password entered";
            $_SESSION['Error'] =$lgerror;
            header("Location: http://localhost/BRUNO/error.php");
          }
        }
      }else {
        $lgerror = 'Username not located in database';
        $_SESSION['Error'] =$lgerror;
      }
    }else{
      $lgerror = 'Generic unhelpful error message JK, Query failed';
      $_SESSION['Error'] =$lgerror;
    }
  }
  $GetUserInfo->close();

?>
