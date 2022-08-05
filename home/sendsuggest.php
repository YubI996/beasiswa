<?php
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");

$aksi = $_POST['aksi'];

if ($aksi == 'add') {

	$id_kritik = '';
	$name = ucfirst(antiInjection($_POST['name']));
	$email = strtolower(antiInjection($_POST['email']));
	$message = antiInjection($_POST['message']);
	$tgl = date("Y-m-d H:i:s");
	$suka = 0;
	$tampil = 0;

	$send = $con->prepare("INSERT INTO kritik VALUES (:id_kritik, :name, :email, :message, :tgl, :suka, :tampil)");
	$send->bindParam(':id_kritik', $id_kritik);
	$send->bindParam(':name', $name);
	$send->bindParam(':email', $email);
	$send->bindParam(':message', $message);
	$send->bindParam(':tgl', $tgl);
	$send->bindParam(':suka', $suka);
	$send->bindParam(':tampil', $tampil);
	$send->execute();

	if ($send) {
		$response = array(
			'status'=>'ok',
		);
		echo json_encode($response); 
	}else{
		$response = array(
			'status'=>$send,
		);
		echo json_encode($response); 
	}
}

if ($aksi == 'sukai') {

	$idk = $_POST['idk'];

	if ($_COOKIE['sukai'][$idk] != '1') {
		$send = $con->prepare("UPDATE kritik SET suka = (suka + 1) WHERE id_kritik='$idk'");
		$send->execute();

		setcookie('sukai['.$idk.']', '1', strtotime('+1 year'), '/');
	}

	$qs = $con->prepare("SELECT suka FROM kritik WHERE id_kritik='$idk'");
	$qs->execute();
	$ds = $qs->fetch();
	$suka = $ds['suka'];

	if ($send) {
		$response = array(
			'status'=>'ok',
			'suka'=>$suka,
		);
		echo json_encode($response); 
	}else{
		$response = array(
			'status'=>$send->errorInfo(),
			'suka'=>$suka,
		);
		echo json_encode($response); 
	}
}

if ($aksi == 'sukaib') {

	$idk = $_POST['idk'];

	if ($_COOKIE['sukaib'][$idk] != '1') {
		$send = $con->prepare("UPDATE berita SET suka = (suka + 1) WHERE id_berita='$idk'");
		$send->execute();

		setcookie('sukaib['.$idk.']', '1', strtotime('+1 year'), '/');
	}

	$qs = $con->prepare("SELECT suka FROM berita WHERE id_berita='$idk'");
	$qs->execute();
	$ds = $qs->fetch();
	$suka = $ds['suka'];

	if ($send) {
		$response = array(
			'status'=>'ok',
			'suka'=>$suka,
		);
		echo json_encode($response); 
	}else{
		$response = array(
			'status'=>$send->errorInfo(),
			'suka'=>$suka,
		);
		echo json_encode($response); 
	}
}

?>

