<?php
session_start();
echo "it liked";
?>
<html>
<body>
<?php
require_once "bruno-config.php";
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
$ProfileID = "A00000000011";
$CreationDate = date('Y-m-d H:i:s');

$_SESSION['RecipUsr'] =$_POST['recipient'];

$InsertLike =" INSERT INTO `Like`(LikeID, PostID, ProfileID, CreationDate)
VALUES('$LikeID','$RecipPostID','$ProfileID','$CreationDate')";
if($BrunoCONN->query($InsertLike) === TRUE){
  echo "Liked ",$RecipPostID. "<br>";
  $BrunoCONN->close();
}else{
  $_SESSION['Error'] = "Error: ".$InsertMessage. "<br>". $BrunoCONN->error;
  header("Location: http://localhost/BRUNO/error.php");
  $BrunoCONN->close();
  generateMsgID(-1);
}
?>
<h1><?php echo $_POST['recipient']?></h1>
<h1><?php echo $LikeID?></h1>
<h1><?php echo $ProfileID?></h1>
<h1><?php echo $CreationDate?></h1>
</body>
</html>