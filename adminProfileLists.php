<?php
session_start();
?>
<html>
<body>
<?php
require_once "bruno-config.php";

$AllProfileInfoSQL ="SELECT * FROM Profile";

if($AdminPgInfo = $BrunoCONN->prepare($AllProfileInfoSQL)){

  if($AdminPgInfo->execute()){
      $AdminPgInfo->store_result();
      $AdminPgInfo->bind_result($ProfileID,$FName,$MName,$LName,$Username,$Password,$Email,$Mobile,$CreationDate,$BirthDate,$Privacy,$Avatar);
      $Rowcount = $AdminPgInfo->num_rows;
      if($Rowcount > 0){
      while ($AdminPgInfo->fetch()) {
        echo '$ProfileID: '.$ProfileID. "<br>";
        echo '$First Name: '.$FName. "<br>";
        echo 'Middle Name: '.$Mname. "<br>";
        echo 'Last Name: '.$Lname. "<br>";
        echo 'Username: '.$Username. "<br>";
        echo 'Password: '.$Password. "<br>";
        echo 'Email: '.$Email. "<br>";
        echo 'Mobile Number: '.$Mobile. "<br>";
        echo 'CreationDate: ' .$CreationDate. "<br>";
        echo '$BirthDate: '.$BirthDate. "<br>";
        echo '$Privacy Setting: '.$Privacy. "<br>";
        echo '$Avatar: '.$Avatar. "<br>";
        echo "------PROFILE------- <br><br>";
      }
    }
    else {
      echo "No Profiles in database? :O";
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
