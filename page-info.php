<?php
session_start()
?>
<html>
<body>
<?php
require_once 'bruno-config.php';

$pageID = $_SESSION['PageID'];

$PageInfoSQL = "SELECT * FROM PAGE WHERE PageID = ?";
//Prepare query statement
if($GetPageInfo =$BrunoCONN->prepare($PageInfoSQL)){
  $GetPageInfo->bind_param("s",$ParamPgID);
  //Designate variable for pageid binding
  $ParamPgID = $pageID;
  //Actually pass the username into the bound variable
  if($GetPageInfo->execute()){
  //Execute query
  $GetUserInfo->store_result();
  //Store result of query
    if($GetPageInfo->num_rows== 1){
    //See if page found in the database
    $GetPageInfo->bind_result($pageID,$pgName,$pgDesc,$pgCat,$pgImg,$pgCreatorID);
    }
  }
}

$PagePostsSQL = "SELECT * FROM POST WHERE PageID =?"
if($GetPosts =$BrunoCONN->prepare($PagePostsSQL)){
  $GetPosts->bind_param("s",$ParamPgID);
  $ParamPgID = $pageID;
  if($GetPosts->execute()){
      $GetPosts->store_result();
      if($GetPosts->num_rows ==1){
        $GetPageInfo->bind_result($poID,$prID,$paID);
      }
    
  }
}
