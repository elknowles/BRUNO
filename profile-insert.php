<?php
session_start();
?>
<html>
<body>
<?php
require_once "bruno-config.php";

function generatePrID($mode) {
  $idfile = new DOMDocument();
  $idfile->load('id.xml');
  if ($idfile === FALSE) {
    echo "database key file missing, error";
    exit();
  }
  $idroot = $idfile->documentElement;
  $ID = $idroot->getElementsByTagName('profileid')->item(0)->textContent;
  if($mode === 0){
    ++$ID;
  }
  else{
    --$ID;
  }
  $idroot->getElementsByTagName('profileid')->item(0)->textContent = $ID;
  $idfile->save('id.xml');
  return $ID;
}


//Storing data from the form into variables
$ProfileID = generatePrID(0);
$Fname = $BrunoCONN->real_escape_string($_POST["firstName"]);
$Mname = $BrunoCONN->real_escape_string($_POST["middleName"]);
$Lname = $BrunoCONN->real_escape_string($_POST["lastName"]);
$UsrName = $BrunoCONN->real_escape_string($_POST["username"]);
$Pass = $BrunoCONN->real_escape_string($_POST["password"]);
$Email = $BrunoCONN->real_escape_string($_POST["email"]);
$MobileNum = $BrunoCONN->real_escape_string($_POST["mobileNum"]);
$CreationDate = date('Y-m-d H:i:s');
$Bdate =  $_POST["birthdate"];
$Privacy = $_POST["privacy"];

//Create query to generate new profile
$ProfileInsert = "INSERT INTO Profile (ProfileID,FName,MName,LName,Username,Password,Email,MobileNum,CreationDate,BirthDate,Privacy,Avatar)
VALUES('$ProfileID','$Fname','$Mname','$Lname','$UsrName','$Pass','$Email','$MobileNum','$CreationDate','$Bdate','$Privacy',profilePlaceHolder.png)";

//Execute generated query
if($BrunoCONN->query($ProfileInsert) === TRUE){
  echo "New profile generated in database";
  $_SESSION['Username'] = $UsrName;
  header("Location: http://localhost/BRUNO/profileHome.php");
  $BrunoCONN->close();
}
else {
  $prerror = "Error: ".$ProfileInsert. "<br>" . $BrunoCONN->error;
  $_SESSION['Error'] = $prerror;
  //Revert primary key value ;
  generatePrID(-1);
  header("Location: http://localhost/BRUNO/error.php");
  $BrunoCONN->close();
}
//Close connection with database
?>

</body>
</html>
