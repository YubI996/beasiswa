<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
date_default_timezone_set('Asia/Makassar');
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if($_SESSION['login'] != "Login"){
	echo "<script type='text/javascript'>window.location='https://e-beasiswa.bontangkota.go.id/home/login-register.php?msg=bL';</script>";
	die();
}
?>