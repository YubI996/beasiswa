<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");


$bg = $_POST['bg'];
$sql = $con->prepare("UPDATE aplikasi SET background='$bg'");
$sql->execute();

?>
