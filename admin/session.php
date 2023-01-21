<?php
$domain = $_SERVER['HTTP_HOST'];
if (error_reporting(0) && !$_SERVER['HTTPS']) {
    $secure = false;
} else {
    $secure = true;
}
session_set_cookie_params(0, '/', $domain, $secure, true);
session_start();

$ipcek = $_SERVER["REMOTE_ADDR"];
$useragent = $_SERVER["HTTP_USER_AGENT"];

if ($_SESSION["Oturum"] == "uhrtKekonXzOXb9" && $ipcek == $_SESSION["LoginIP"] && $useragent == $_SESSION["UserAgent"]) {
    $kadi = $_SESSION["kadi"];
    
} else {
    header("location:login.php");
}

?>