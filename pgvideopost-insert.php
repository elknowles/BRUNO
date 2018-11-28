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

$VideoDir ="Video/Posts/";
$UploadedFile = basename($_FILES["file"]["name"]);
$TargetFilePath = $VideoDir .$UploadedFile;

$Content = $UploadedFile;
$Caption  = "Vid caption";

$PostID = generatePoID(0);
$CreationDate = date('Y-m-d H:i:s');

$PostInsertPage =" INSERT INTO Post(PostID, ProfileID, PageID, CreationDate)
VALUES('$PostID',NULL, '$PgID','$CreationDate')";
//
$VideoInsert =" INSERT INTO Video(PostID, VContent,VCaption)
VALUES('$PostID','$Content','$Caption')";

if($BrunoCONN->query($PostInsertPage) === TRUE){
  if(move_uploaded_file($_FILES["file"]["tmp_name"], $TargetFilePath)){

    if($BrunoCONN->query($VideoInsert) === TRUE){
      echo "New post generated in database";
      header("Location: http://localhost/BRUNO/profilehome.html");
      $BrunoCONN->close();
    }else{
      $poerror = "Error: ".$VideoInsert."<br>". $BrunoCONN->error;
      $_SESSION['Error'] = $poerror;
      header("Location: http://localhost/BRUNO/error.php");
      $BrunoCONN->close();
    }
  }
  else{
    $_SESSION['Error'] = "Not uploaded because of error #".$_FILES["file"]["error"];
    header("Location: http://localhost/BRUNO/error.php");
    generatePoID(-1);
    $BrunoCONN->close();
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
