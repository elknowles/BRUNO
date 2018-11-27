<?php
session_start();
?>

<?php

require_once "bruno-config.php";

$SelectionDate = $_POST['selection'];
$NumPosts=0;
$NumComm =0;


$AllPostsSQL = "SELECT COUNT(*) FROM Page as P JOIN Post as O ON P.PageID = O.PageID WHERE CreationDate LIKE '$SelectionDate%'";
$AllCommentsSQL = "SELECT COUNT(*) FROM Comment as C Join Post as P On C.PageID = P.PageID Where CreationDate LIKE '$SelectionDate%'";
$AllPostsInfoSQL = "SELECT * FROM Page as P JOIN Post as O ON P.PageID = O.PageID WHERE CreationDate LIKE '$SelectionDate%'";

if($PostsCount = $BrunoCONN->prepare($AllPostsSQL)){
  $PostsCount->execute();
  $PostsCount->store_result();
  $PostsCount->bind_result($NumPosts);
  if($PostsCount->num_rows >0){
    if($PostsCount->fetch()){
      echo "Number of posts created on ".$SelectionDate. ": ".$NumPosts ."<br>";

    }
  }
  else{
    echo "No posts created on ".$SelectionDate ."<br>";
    $NumPosts =0;
  }
}

if($CommentsCount = $BrunoCONN->prepare($AllCommentsSQL)){
  $CommentsCount->execute();
  $CommentsCount->store_result();
  $CommentsCount->bind_result($NumComm);
  if($NumComm->num_rows >0){
    if($CommentsCount->fetch){
      echo "Number of comments created on ".$SelectionDate.": ".$NumComm ."<br>";
    }
  }
  else{
    echo "No comments created on ".$SelectionDate."<br>";
  }
}
$TotalPC = $NumPosts +$NumComm;
echo "Total number of posts: ". $TotalPC;
?>
