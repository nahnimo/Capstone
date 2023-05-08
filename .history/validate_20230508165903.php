<?php 
	session_start();
	if($_SESSION['secure'] == $_POST['user_input']){
        
        echo "<script>alert('valid');
        window.location.href='index.php';</script>";
	} 
	else{
        echo "<script>alert('invalid');
        window.location.href='index.php';</script>";
	}
?>r