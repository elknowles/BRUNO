<?php
session_start();
?>
<html>
<body>

<?php
require_once "bruno-config.php";
require_once "get-profileid.php";

$PostsByProfileSQL = "SELECT PostID,PageID FROM Post WHERE ProfileID = ?";
if($RetrievePosts = $BrunoCONN->prepare($PostsByProfileSQL)){
  $RetrievePosts->bind_param("s",$ParamPrID);
  $ParamPrID = $PrID;
  if($RetrievePosts->execute()){
    $RetrievePosts->store_result();
    if($RetrievePosts->num_rows ==1){
      $RetrievePosts->bind_result($postID, $pageID);
    }
  }
}


?>
