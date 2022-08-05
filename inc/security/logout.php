<?php
if (!isset($_SESSION)) {
    session_start();
}

$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");

$id=$_SESSION['id'];
$last=$_SESSION['last'];

$sql = $con->prepare("SELECT * FROM user WHERE id_user='$id'");
$sql->execute();


if($sql->rowCount() > 0){
	$sql1 = $con->prepare("UPDATE user SET last_login='$last', online='0' WHERE id_user='$id'");
	$sql1->execute();
}

session_destroy();
echo '<script>window.location="../../home/";</script>';
exit();
 
?>