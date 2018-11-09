<html>
<body>

<?php

function generatePoID() {

  $idfile = new DOMDocument();
  $idfile->load('id.xml');
  $idroot = $idfile->documentElement;
  $ID = $idroot->getElementsByTagName('postid')->item(0)->textContent;
  ++$ID;
  $idroot->getElementsByTagName('postid')->item(0)->textContent = ID
  $idfile->save('id.xml');
  return $ID;
}

$BrunoCONN = new mysqli("localhost", "root", "root", "Bruno");

if ($BrunoCONN->connect_error) {
    die("Connection failed: " . $BrunoCONN->connect_error);
}
  //Storing data from the form into variables
  $posttype = $_POST['selection'];
  $TContent = "";
  $VContent = "";
  $VCaption = "";
  $AContent = "";
  $ACaption = "";
  $PContent = "";
  $PCaption = "";

  $PostID = generatePoID();

  if($posttype === 'TEXT'){}
    
  else if($posttype === 'VIDEO'){}

  else if($posttype === 'AUDIO'){}

  else{}                //'VIDEO'

  $ProfName = $_POST['name'];

  $ProfileID = "SELECT ProfileID FROM Profile WHERE Username ='$ProfName'";
  if($BrunoCONN->query($ProfileID) === TRUE ){
    echo "User ".$ProfName. "Located in database";
  }
  else {
    echo "User ".$ProfName. "Not found in database";
  }
  $PageID = "SELECT PageID FROM Page WHERE CreatorID = '$ProfileID'";
  $PageName = "SELECT Name FROM Page WHERE CreatorID = '$ProfileID'";
  if($BrunoCONN->query($ProfileID) === TRUE ){
    echo "Page ". $PageName. "Created by ". $ProfName. "Located in database"
  }
  else {
    echo "Page ". $PageName. "Created by ". $ProfName. "Not found in database"
  }


  $PostInsertProfile =" INSERT INTO Post(PostID, ProfileID, PageID)
  VALUES('$PostID','$ProfileID', NULL)";

  $TextInsertProfile =" INSERT INTO Text(PostID, TContent)
  VALUES('$PostID','$TContent')";
  $AudioInsertProfile =" INSERT INTO Audio(PostID, AContent,ACaption)
  VALUES('$PostID','$AContent','$ACaption')";
  $PhotoInsertProfile =" INSERT INTO Photo(PostID, PContent,PCaption)
  VALUES('$PostID','$PContent','$PCaption')";
  $VideoInsertProfile =" INSERT INTO Video(PostID, VContent,VCaption)
  VALUES('$PostID','$VContent','$VCaption')";

  $PostInsertPage =" INSERT INTO Post(PostID, ProfileID, PageID)
  VALUES('$PostID','$ProfileID', '$PageID')";
