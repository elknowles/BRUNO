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
$Fname = $_POST["firstName"];
$Mname = $_POST["middleName"];
$Lname = $_POST["lastName"];
$UsrName =$_POST["username"];
$Pass = $_POST["password"];
$Email = $_POST["email"];
$MobileNum = $_POST["mobileNum"];
$CreationDate = date('Y-m-d H:i:s');
$Bdate =  $_POST["birthdate"];
$Privacy = $_POST["privacy"];

//Create query to generate new profile
$ProfileInsert = "INSERT INTO Profile (ProfileID,FName,MName,LName,Username,Password,Email,MobileNum,CreationDate,BirthDate,Privacy)
VALUES('$ProfileID','$Fname','$Mname','$Lname','$UsrName','$Pass','$Email','$MobileNum','$CreationDate','$Bdate','$Privacy')";

//Execute generated query
if($BrunoCONN->query($ProfileInsert) === TRUE){
  echo "New profile generated in database";
  $_SESSION['Username'] = $UsrName;
  header("Location: http://localhost/BRUNO/profilehome.html");
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
