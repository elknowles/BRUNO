<?php
session_start();
?>

<?php

require_once "bruno-config.php";

$SelectionDate = $_POST['date'];

$AllPostsSQL = "SELECT COUNT(*) FROM Page as P JOIN Post as O ON P.PageID = O.PageID WHERE CreationDate LIKE '$SelectionDate%'";

$AllPostsInfoSQL = "SELECT * FROM Page as P JOIN Post as O ON P.PageID = O.PageID WHERE CreationDate LIKE '$SelectionDate%'";



?>
