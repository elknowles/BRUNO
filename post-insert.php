<?php
session_start();
?>
<html>
<body>

<?php
require_once "bruno-config.php";

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

$ImageDir ="Images/Posts/";
$AudioDir ="Audio/Posts";
$VideoDir ="Video/Posts";

$UploadedFile = basename($_FILES["file"]["name"]);

  //Storing data from the form into variables
  $posttype = 'TEXT';             //$_POST['selection'];
  $Content =  'This is a cool post';      //$_POST['TContent'];
  $Caption = 'captionMAN';                 //$_POST['caption'];

  $Username = $_SESSION['Username'];
  $PostID = generatePoID(0);
  $CreationDate= date('Y-m-d H:i:s');

  $ProfileIDSQL = "SELECT ProfileID FROM Profile WHERE Username =?";
  if($GetProfileID = $BrunoCONN->prepare($ProfileIDSQL)){
    $GetProfileID->bind_param("s",$ParamUsr);
    $ParamUsr =$Username;
    if($GetProfileID->execute()){
      $GetProfileID->store_result();
      if($GetProfileID->num_rows == 1){
        $GetProfileID->bind_result($PrID);
        if($GetProfileID->fetch()){
          // ProfileID stored in $PrID variable
        }
      }else{
        $lgerror = 'Username not located in database';
        $_SESSION['Error'] =$lgerror;
        header("Location: http://localhost/BRUNO/error.php");
      }
    }else{
      $lgerror = 'Generic unhelpful error message';
      $_SESSION['Error'] =$lgerror;
      header("Location: http://localhost/BRUNO/error.php");
    }
  }
  $GetProfileID->close();
  ////////////////////////////////////////////
  /*PAGE POSTING LOGIC*/
  ////////////////////////////////////////////
  /*FLAG TO INDICATE PAGE IS POSTING*/

  $PageIDSQL ="SELECT PageID FROM Page WHERE CreatorID= ?";
  if($GetPageID = $BrunoCONN->prepare($PageIDSQL)){
    $GetPageID->bind_param("s",$ParamPrID);
    $ParamPrID = $PrID;
    if($GetPageID->execute()){
      $GetPageID->store_result();
      if($GetPageID->num_rows == 1 ){
        $GetPageID->bind_result($PaID);
        if($GetPageID->fetch()){
          //PageID stored in $PaID variable
        }
      }else{
        $lgerror = 'Page not located in database';
        $_SESSION['Error'] =$lgerror;
        header("Location: http://localhost/BRUNO/error.php");
      }
    }
    else{
      $lgerror = 'Query unable to execute';
      $_SESSION['Error'] =$lgerror;
      header("Location: http://localhost/BRUNO/error.php");
    }
  }
  $GetPageID->close();

  $PostInsertProfile =" INSERT INTO Post(PostID, ProfileID, PageID, CreationDate)
  VALUES('$PostID','$PrID', NULL,'$CreationDate')";
  //
  $TextInsert =" INSERT INTO Text(PostID, TContent)
  VALUES('$PostID','$Content')";
  //
  $AudioInsert =" INSERT INTO Audio(PostID, AContent,ACaption)
  VALUES('$PostID','$Content','$Caption')";
  //
  $PhotoInsert =" INSERT INTO Photo(PostID, PContent,PCaption)
  VALUES('$PostID','$Content','$Caption')";
  //
  $VideoInsert =" INSERT INTO Video(PostID, VContent,VCaption)
  VALUES('$PostID','$Content','$Caption')";

  //$PostInsertPage =" INSERT INTO Post(PostID, ProfileID, PageID, CreationDate)
  //VALUES('$PostID','$PrID', '$PaID','$CreationDate')";

  if($BrunoCONN->query($PostInsertProfile) === TRUE){
    if($posttype === 'TEXT'){
      if($BrunoCONN->query($TextInsert) === TRUE){
        echo "New post generated in database";
        header("Location: http://localhost/BRUNO/profilehome.html");
        $BrunoCONN->close();
      }else{
        $poerror = "Error: ".$TextInsert."<br>". $BrunoCONN->error;
        $_SESSION['Error'] = $poerror;
        header("Location: http://localhost/BRUNO/error.php");
        $BrunoCONN->close();
      }
    }else if($posttype === 'VIDEO'){
      $TargetFilePath = $VideoDir .$UploadedFile;
        if(move_uploaded_file($_FILES["file"]["tmp_name"])){
          $Caption = $_POST['caption'];
          $Content = $UploadedFile;
            if($BrunoCONN->query($VideoInsert)=== TRUE){
              echo "New post generated in database";
              header("Location: http://localhost/BRUNO/profilehome.html");
              $BrunoCONN->close();
            }
            else{
              $poerror = "Error: ".$VideoInsert."<br>". $BrunoCONN->error;
              $_SESSION['Error'] = $poerror;
              header("Location: http://localhost/BRUNO/error.php");
              $BrunoCONN->close();
            }
        }
    }else if($posttype === 'AUDIO'){
      $TargetFilePath = $AudioDir.$UploadedFile;
      if(move_uploaded_file($_FILES["file"]["tmp_name"])){
        $Caption = $_POST['caption'];
        $Content = $UploadedFile;
          if($BrunoCONN->query($AudioInsert) === TRUE){
            echo "New post generated in database";
            header("Location: http://localhost/BRUNO/profilehome.html");
            $BrunoCONN->close();
          }
          else{
            $poerror = "Error: ".$AudioInsert. "<br>". $BrunoCONN->error;
            $_SESSION['Error'] = $poerror;
            header("Location: http://localhost/BRUNO/error.php");
            $BrunoCONN->close();
        }
      }
      }else{//$posttype ==== 'PHOTO'
        $TargetFilePath = $ImageDir .$UploadedFile;
        if(move_uploaded_file($_FILES["file"]["tmp_name"])){
        $Caption =$_POST['caption'];
        $Content =$UploadedFile;
        if($BrunoCONN->query($PhotoInsert) === TRUE){
          echo "New post generated in database";
          header("Location: http://localhost/BRUNO/profilehome.html");
          $BrunoCONN->close();
        }else{
          $poerror = "Error: ".$PhotoInsert. "<br>". $BrunoCONN->error;
          $_SESSION['Error'] = $poerror;
          header("Location: http://localhost/BRUNO/error.php");
          $BrunoCONN->close();
        }
      }
    }
    
    } else{
        $poerror = "Error: ".$PostInsertProfile. "<br>". $BrunoCONN->error;
        $_SESSION['Error'] = $poerror;
        header("Location: http://localhost/BRUNO/error.php");
        generatePoID(-1);
        $BrunoCONN->close();
      }



  /*FLAG TO INDICATE PAGE IS POSTING*/
  ////////////////////////////////////////////
  /*PAGE POSTING LOGIC*/
  ////////////////////////////////////////////

  //   if($BrunoCONN->query($PostInsertPage) === TRUE){
  //       if($posttype === 'TEXT'){
  //         if($BrunoCONN->query($TextInsert) === TRUE){
  //           echo "New post generated in database";
  //           $BrunoCONN->close();
  //         }else{
  //           $poerror = "Error: ".$TextInsert."<br>". $BrunoCONN->error;
  //           $_SESSION['Error'] = $poerror;
  //           header("Location: http://localhost/BRUNO/error.php");
  //           $BrunoCONN->close();
  //         }
  //
  //   }
  // }else{
  //     $poerror = "Error: ".$PostInsertPage. "<br>". $BrunoCONN->error;
  //     $_SESSION['Error'] = $poerror;
  //     header("Location: http://localhost/BRUNO/error.php");
  //     $BrunoCONN->close();
  //   }


?>
