<?php
//GENERATING RANDOM 4 CHARACTER FOR CAPTCHA
  $string='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefhijklmnopqrstuvwxyz1234567890';
  $string_shuff=str_shuffle($string);
  $text=substr($string_shuff,0,7);

//STARTING AND CREATING SESSION
  session_start();
  $_SESSION['secure']=$text;
?>
<div style="width: 158px;height: 60px;">
  <img src="./captcha-generator/img_gen.php">
</div>
