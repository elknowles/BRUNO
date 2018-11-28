<?php
session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/anonymous-pro" type="text/css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
require_once "bruno-config.php";

$AllTextPostInfoSQL ="SELECT R.Username, P.PostID, P.ProfileID, P.PageID, T.TContent, P.CreationDate FROM Post as P JOIN  Text as T ON P.PostID = T.PostID JOIN Profile as R ON P.ProfileID = R.ProfileID";
$AllImagePostSQL = "SELECT R.Username, P.PostID, P.ProfileID, P.PageID, H.PContent, H.PCaption, P.CreationDate FROM POST as P JOIN Photo as H ON P.PostID = H.PostID JOIN Profile as R ON P.ProfileID = R.ProfileID";
$AllVideoPostSQL = "SELECT R.Username, P.PostID, P.ProfileID, P.PageID, V.VContent, V.VCaption, P.CreationDate FROM POST as P JOIN Video as V ON P.PostID = V.PostID JOIN Profile as R ON P.ProfileID = R.ProfileID";
$AllAudioPostSQL ="SELECT R.Username, P.PostID, P.ProfileID, P.PageID, A.AContent, A.ACaption, P.CreationDate FROM POST as P JOIN Audio as A ON P.PostID = A.PostID JOIN Profile as R ON P.ProfileID = R.ProfileID";

echo "-------TEXT----- <br><br>";
if($AdminPgInfo = $BrunoCONN->prepare($AllTextPostInfoSQL)){
/* ------------TEXT----------------------*/
  if($AdminPgInfo->execute()){
      $AdminPgInfo->store_result();
      $AdminPgInfo->bind_result($Username,$PostID,$ProfileID,$PageID,$TContent,$CreationDate);
      $Rowcount = $AdminPgInfo->num_rows;
      if($Rowcount > 0){

        while ($AdminPgInfo->fetch()) {
          echo 'Username: ' .$Username. "<br>";
          echo 'PostID: ' .$PostID. "<br>";
          echo 'TextContent: ' .$TContent. "<br>";
          echo 'CreationDate: ' .$CreationDate. "<br>";
          echo "--TXTPOST-- <br>";
        }
        $AdminPgInfo->free_result();
      }
      else {
        echo'No Text posts in database';
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

echo "<br><br>-------IMAGES------<br><br>";

if($AdminPgInfo =$BrunoCONN->prepare($AllImagePostSQL)){
  /*-------------IMAGE---------------*/
  if($AdminPgInfo->execute()){
    $AdminPgInfo->store_result();
    $AdminPgInfo->bind_result($Username,$PostID,$ProfileID,$PageID,$PContent,$Pcaption,$CreationDate);
    $Rowcount = $AdminPgInfo->num_rows;
    if($Rowcount > 0){

      while ($AdminPgInfo->fetch()) {
      	echo 'Username' .$Username. "<br>";
      	echo 'PostID: ' .$PostID. "<br>";
        echo 'PContent:' .$PContent. "<br>";
        echo 'PCaption:' .$Pcaption. "<br>";
        echo 'CreationDate: ' .$CreationDate. "<br>";
        echo "--IMGPOST-- <br>";
      }
      $AdminPgInfo->free_result();
    }
    else {
      echo 'No Image posts in database';
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

echo "<br><br>-------VIDEOS------<br><br>";
if($AdminPgInfo =$BrunoCONN->prepare($AllVideoPostSQL)){
  /*-------------VIDEO---------------*/
  if($AdminPgInfo->execute()){
    $AdminPgInfo->store_result();
    $AdminPgInfo->bind_result($Username,$PostID,$ProfileID,$PageID,$VContent,$Vcaption,$CreationDate);
    $Rowcount = $AdminPgInfo->num_rows;
    if($Rowcount > 0){

      while ($AdminPgInfo->fetch()) {
      	echo 'Username' .$Username. "<br>";
      	echo 'PostID: ' .$PostID. "<br>";
        echo 'VContent:' .$VContent. "<br>";
        echo 'VCaption:' .$Vcaption. "<br>";
        echo 'CreationDate: ' .$CreationDate. "<br>";
        echo "--VIDPOST-- <br>";
      }
      $AdminPgInfo->free_result();
    }
    else {
      echo 'No Video posts in database';
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

echo "<br><br>-------AUDIO------<br><br>";
if($AdminPgInfo =$BrunoCONN->prepare($AllAudioPostSQL)){
  /*-------------VIDEO---------------*/
  if($AdminPgInfo->execute()){
    $AdminPgInfo->store_result();
    $AdminPgInfo->bind_result($Username,$PostID,$ProfileID,$PageID,$AContent,$Acaption,$CreationDate);
    $Rowcount = $AdminPgInfo->num_rows;
    if($Rowcount > 0){

      while ($AdminPgInfo->fetch()) {
        echo 'Username' .$Username. "<br>";
        echo 'PostID: ' .$PostID. "<br>";
        echo 'AContent:' .$AContent. "<br>";
        echo 'ACaption:' .$Acaption. "<br>";
        echo 'CreationDate: ' .$CreationDate. "<br>";
        echo "--AUDPOST-- <br>";
      }
      $AdminPgInfo->free_result();
    }
    else {
      echo 'No Audio posts in database';
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

	<ul>
		<li><a style="color:white" href="like.php">Make a Like?</a></li>
		<li style="float: right"><a style="color:white" href="messages.php">Leave a Comment?</a></li>
	</ul>

</body>
</html>