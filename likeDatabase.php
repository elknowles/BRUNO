<?php
session_start();
echo "it liked";
?>
<html>
<body>
<?php
require_once "bruno-config.php";
require_once "get-profileid.php";
function generateLikeID($mode) {
  $idfile = new DOMDocument();
  $idfile->load('id.xml');
  if ($idfile === FALSE) {
    echo "database key file missing, error";
    exit();
  }
  $idroot = $idfile->documentElement;
  $ID = $idroot->getElementsByTagName('likeid')->item(0)->textContent;
  if($mode === 0){
    ++$ID;
  }
  else{
    --$ID;
  }
  $idroot->getElementsByTagName('likeid')->item(0)->textContent = $ID;
  $idfile->save('id.xml');
  return $ID;
}

$LikeID = generateLikeID(0);
$RecipPostID = $_SESSION['RecipUsr'];
$CreationDate = date('Y-m-d H:i:s');

$_SESSION['RecipUsr'] =$_POST['recipient'];

$InsertLike =" INSERT INTO `Like`(LikeID, PostID, ProfileID, CreationDate)
VALUES('$LikeID','$RecipPostID','$PrID','$CreationDate')";
if($BrunoCONN->query($InsertLike) === TRUE){
  echo "Liked ",$RecipPostID. "<br>";
  echo '<p> <a href="profileHome.php" style="color:dodgerblue" >Go home</a></p>';
  $BrunoCONN->close();
}else{
  $_SESSION['Error'] = "Error: ".$InsertMessage. "<br>". $BrunoCONN->error;
  header("Location: http://localhost/BRUNO/error.php");
  $BrunoCONN->close();
  generateMsgID(-1);
}
?>
</body>
</html>