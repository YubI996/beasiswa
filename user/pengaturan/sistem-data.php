<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$sqlx = $con->prepare("SELECT * FROM set_beasiswa");
$sqlx->execute();
$dx = $sqlx->fetch();
?>


