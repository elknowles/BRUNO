<?php
//Store database authentication info in constants
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'Bruno');

//Create connection with the database
$BrunoCONN = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if ($BrunoCONN === FALSE) {
    die("Connection failed: " . $BrunoCONN->connect_error);
}
?>
