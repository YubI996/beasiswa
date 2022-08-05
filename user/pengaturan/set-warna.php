<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$tema = $_POST['tema'];
$sql = $con->prepare("UPDATE aplikasi SET tema_user='$tema'");
$sql->execute();

?>
