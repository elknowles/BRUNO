<html>
<body>
<?php
function generatePrID() {
  $idfile = new DOMDocument();
  $idfile->load('id.xml');
  if ($idfile === FALSE) {
    echo "database key file missing, error";
    exit();
  }
  $idroot = $idfile->documentElement;
  $ID = $idroot->getElementsByTagName('profileid')->item(0)->textContent;
  ++$ID;
  $idroot->getElementsByTagName('profileid')->item(0)->textContent = $ID;
  $idfile->save('id.xml');
  return $ID;
}

//Create connection with the database
$BrunoCONN = new mysqli("localhost", "root", "root", "Bruno");

if ($BrunoCONN->connect_error) {
    die("Connection failed: " . $BrunoCONN->connect_error);
}

//Storing data from the form into variables
$ProfileID = generatePrID();
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
}
else {
  echo "Error: ".$ProfileInsert. "<br>" . $BrunoCONN->error;
}
//Close connection with database
$BrunoCONN->close();

header("Location: http://localhost/BRUNO/profilehome.html");
?>

</body>
</html>
