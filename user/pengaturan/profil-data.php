<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

        $sql = $con->prepare("SELECT * FROM user WHERE id_user='$_SESSION[id]'");
        $sql->execute();
        $d = $sql->fetch();
?>


