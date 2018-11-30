<?php
session_start();
?>
<html>
<body>
<?php
require_once 'bruno-config.php';

function generatePaID($mode) {
  $idfile = new DOMDocument();
  $idfile->load('id.xml');
  if ($idfile === FALSE) {
    echo "database key file missing, error";
    exit();
  }
  $idroot = $idfile->documentElement;
  $ID = $idroot->getElementsByTagName('pageid')->item(0)->textContent;
  if($mode === 0){
    ++$ID;
  }
  else{
    --$ID;
  }
  $idroot->getElementsByTagName('pageid')->item(0)->textContent = $ID;
  $idfile->save('id.xml');
  return $ID;
}
  //Storing data from the form into variables
  $PageID = generatePaID(0);
  $UsrName = $_SESSION['Username'];
  $Name = $_POST['pageName'];
  $Description = $_POST['description'];
  $Category = $_POST['category'];

  /*if(isset($_POST["submit"])){
    $check =getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== FALSE)
    $Image =$_FILES['image']['tmp_name'];
    $imgContent =addslashes(file_get_contents($Image));
  }*/
  $Image = 'alpineMountain.png';

  $GetUserID = "SELECT ProfileID FROM Profile WHERE Username ='$UsrName'";

  // if($UsrID = $BrunoCONN->query($GetUserID)){
  //   echo "Selected user found";
  // }
  // else{
  //   echo "User not found in database";
  //   header("Location: http://localhost/BRUNO/index.html");
  //   die();
  // }

  //Create query to generate new page
  $PageInsert = "INSERT INTO Page(PageID,Name,Description,Category,Image,CreatorID)
  VALUES('$PageID','$Name','$Description','$Category','$Image',(SELECT ProfileID FROM Profile WHERE Username ='$UsrName'))";

  //Execute generated query
  if($BrunoCONN->query($PageInsert) === TRUE){
    echo "New page generated in database";
    header("Location: http://localhost/BRUNO/pageHome.php");
    $_SESSION['APgID'] =$PageID;
    $BrunoCONN->close();
  }
  else {
    $paerror = "Error: ".$PageInsert. "<br>" . $BrunoCONN->error;
    $_SESSION['Error'] = $paerror;
    generatePaID(-1);
    header("Location: http://localhost/BRUNO/error.php");
    $BrunoCONN->close();
  }
  //Close connection with database

  ?>

  </body>
  </html>
