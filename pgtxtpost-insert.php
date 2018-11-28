<?php
require_once 'bruno-config.php';

function generatePoID($mode) {
  $idfile = new DOMDocument();
  $idfile->load('id.xml');
  if ($idfile === FALSE) {
    echo "database key file missing, error";
    exit();
  }
  $idroot = $idfile->documentElement;
  $ID = $idroot->getElementsByTagName('postid')->item(0)->textContent;
  if($mode === 0){
    ++$ID;
  }
  else{
    --$ID;
  }
  $idroot->getElementsByTagName('postid')->item(0)->textContent = $ID;
  $idfile->save('id.xml');
  return $ID;
}

require_once 'get-pageid.php';

$TContent = $_POST['TContent'];
$PostID = generatePoID(0);
$CreationDate = date('Y-m-d H:i:s');

$PostInsertPage =" INSERT INTO Post(PostID, ProfileID, PageID, CreationDate)
VALUES('$PostID',NULL, $PgID,'$CreationDate')";
//
$TextInsert =" INSERT INTO Text(PostID, TContent)
VALUES('$PostID','$Content')";

if($BrunoCONN->query($PostInsertPage) === TRUE){

  if($BrunoCONN->query($TextInsert) === TRUE){
    echo "New post generated in database";
    header("Location: http://localhost/BRUNO/profilehome.html");
    $BrunoCONN->close();
  }else{
    $poerror = "Error: ".$TextInsert."<br>". $BrunoCONN->error;
    $_SESSION['Error'] = $poerror;
    header("Location: http://localhost/BRUNO/error.php");
    $BrunoCONN->close();
    generatePoID(-1);

  }
}
else{
    $poerror = "Error: ".$PostInsertPage. "<br>". $BrunoCONN->error;
    $_SESSION['Error'] = $poerror;
    header("Location: http://localhost/BRUNO/error.php");
    generatePoID(-1);
    $BrunoCONN->close();
  }

 ?>
