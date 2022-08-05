<?php
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");

$idUser = $_GET['uC'];
$kodeAktivasi = $_GET['aC'];
$kodebaru = '#'.$kodeAktivasi;

$qr = $con->prepare("SELECT kode_aktivasi, status_aktivasi FROM user WHERE id_user='$idUser' AND kode_aktivasi='$kodeAktivasi' OR  id_user='$idUser' AND kode_aktivasi='$kodebaru' ");
$qr->execute();
$dq = $qr->fetch();
if ($qr->rowCount() < 1) {
		echo "<script type='text/javascript'>window.location='login-register.php?msg=uGD';</script>";
		die();
	die();
}else{
	if (strlen($dq['kode_aktivasi']) > 6 && $dq['status_aktivasi'] == 1) {
		echo "<script type='text/javascript'>window.location='login-register.php?msg=sA';</script>";
		die();

	}else if(strlen($dq['kode_aktivasi']) > 6 && $dq['status_aktivasi'] == 0){
		echo "<script type='text/javascript'>window.location='login-register.php?msg=uB';</script>";
		die();

	}else{

	$sql = $con->prepare("UPDATE user SET status_aktivasi='1', kode_aktivasi='$kodebaru' WHERE id_user='".$idUser."' AND kode_aktivasi='".$kodeAktivasi."'");
	$sql->execute();
	}



	if (!$sql) {
		$teks = "".$con->errorInfo()."";
	 	$psn = str_replace(' ', '_', $teks);
	    echo "<script type='text/javascript'>window.location='login-register.php?msg=gA&psn=".$psn."';</script>";
	}else{
		echo "<script type='text/javascript'>window.location='login-register.php?msg=bA';</script>";
	}
}



?>