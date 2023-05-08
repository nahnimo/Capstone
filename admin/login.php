<?php
include('connection.php');
session_start();
if(isset($_SESSION["username"])){
session_destroy();
}

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
require 'vendor/autoload.php';
$logger = new Logger('logger');
$logHandler = new StreamHandler('act.log', Logger::DEBUG);
$jsonFormatter = new JsonFormatter();
$logHandler->setFormatter($jsonFormatter);
$logger->pushHandler($logHandler);

$pointer=@$_GET['p'];// We use the superglobal variable $_GET['p'] to create several different menus within a PHP file.

// We initialize the user data through the $_POST array.
$username = $_POST['username'];
$password = $_POST['password'];

// The addslashes() function places strings in quotes to access them in a database.

$username = stripslashes($username);
$username = addslashes($username);

// Meanwhile, the stripslashes() function removes quotes to display clean data on the website.
// p.s. Both functions are used for inserting and retrieving strings in a database.

$password = stripslashes($password); 
$password = addslashes($password);
$logger->critical("Trying to login for admin using " .  $username . " and password " . $password	);
$password=md5($password);// Decrypts the password.

//Query that compares whether the student's credentials are correct.
$select = mysqli_query($connect,"SELECT username FROM user 
WHERE username = '$username' AND password = '$password'") or die('Error29');

$counter=mysqli_num_rows($select);

if($counter==1){
while($row = mysqli_fetch_array($select)) {
	$username = $row['username'];
}
$_SESSION["username"] = $username;

// Redirect to the profile.
header("location:admin.php?p=1");
}
else{
echo'<script type="text/javascript">alert("Incorrect Username or Password");location.href="index.php";</script>';

}

?>