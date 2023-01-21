<?php
date_default_timezone_set('Europe/Istanbul');

$sqlhost = 'localhost';
$sqlname = 'erayefek_demo';
$sqluser = 'erayefek_demo';
$sqlpass = 'kp9iTzcon;wk';

$baglan = new PDO("mysql:host=$sqlhost;dbname=$sqlname", "$sqluser", "$sqlpass");
$baglan->exec("SET NAMES UTF8");
?>