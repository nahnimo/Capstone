<?php

$email = $_SESSION['email'];
$hash = $_SESSION['password'];


$query = "SELECT * FROM chatbot WHERE username = '$email' AND password = '$hash'";
$result = mysqli_query($con, $query);
$count = mysqli_num_rows($result);

if ($count == 0) {
    echo "<script>alert('Restricted');window.location.href='index.php';</script>";
}


?>