<?php 
	session_start();
    $text =  $_POST['user_input'];
	if($_SESSION['secure'] == $_POST['user_input']){
        echo "<script>alert($text);
window.location.href='index.php';</script>";
        echo "<script>alert('valid');
        window.location.href='index.php';</script>";
	} 
	else{
        echo "<script>alert($text);
window.location.href='index.php';</script>";
        echo "<script>alert('invalid');
        window.location.href='index.php';</script>";
	}
?>r