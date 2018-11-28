<?php
session_start();
echo "it liked";
?>
<html>
<body>
<?php
require_once "bruno-config.php";
$CreationDate = date('Y-m-d H:i:s');

$_SESSION['RecipUsr'] =$_POST['recipient'];
?>
<h1><?php echo $_POST['recipient']?></h1>
</body>
</html>