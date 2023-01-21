<?php
//oturumu sonlandırıyoruz
session_start();
session_unset();
session_destroy();
setcookie("cerez", "", time()-3600);
header("location:login.php");
?>