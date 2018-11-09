<html>
<body>
<?php

function generatePaID() {
  $idfile = new DOMDocument();
  $idfile->load('id.xml');
  $idroot = $idfile->documentElement;
  $ID = $idroot->getElementsByTagName('pageid')->item(0)->textContent;
  ++$ID;
  $idroot->getElementsByTagName('pageid')->item(0)->textContent = ID
  $idfile->save('id.xml');
  return $ID;
}

$BrunoCONN = new mysqli("localhost", "root", "root", "Bruno");

if ($BrunoCONN->connect_error) {
    die("Connection failed: " . $BrunoCONN->connect_error);
}
  //Storing data from the form into variables
  $PageID = generatePaID();
  $Name = '';
  $Description = '';
  $Category = '';
  $Image = '';


  //Create query to generate new page
  $PageInsert = "INSERT INTO Page(PageID,Name,Description,Category,Image)
  VALUES('$PageID','$Name','$Description','$Category','$Image')";

  //Execute generated query
  if($BrunoCONN->query($PageInsert) === TRUE){
    echo "New page generated in database";
  }
  else {
    echo "Error: ".$PageInsert. "<br>" . $BrunoCONN->error;
  }
  //Close connection with database
  $BrunoCONN->close();
  ?>

  </body>
  </html>
