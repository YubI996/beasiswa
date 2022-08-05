<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-verifikator.php");

if ($_GET['cek'] == "batasKumpul") {
	$sql = $con->prepare("SELECT * FROM set_beasiswa");
	$sql->execute();
	$d = $sql->fetch();
	$tgl = $d['tgl_tutup'];
	echo batasKumpul($tgl) ;
}
if ($_POST['cek1'] == "cekJn") {
	$verifikator = $_SESSION['id'];

		$sql1 = $con->prepare("SELECT * FROM set_beasiswa");
		$sql1->execute();
		$d1 = $sql1->fetch();
		$periodee = $d1['periode'];


		$sqlz1 = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE periode='$periodee' AND status_verifikasi='1' AND status_perbaikan='2' AND verifikator='$verifikator'");
		$sqlz1->execute();
		$n1 = $sqlz1->rowCount();
 

		$sqlz2 = $con->prepare("SELECT * FROM beasiswa_ta WHERE periode='$periodee' AND status_verifikasi='1' AND status_perbaikan='2'  AND verifikator='$verifikator'");
		$sqlz2->execute();
		$n2 = $sqlz2->rowCount();
 
		$sqlz3 = $con->prepare("SELECT * FROM beasiswa_coass WHERE periode='$periodee' AND status_verifikasi='1' AND status_perbaikan='2'  AND verifikator='$verifikator'");
		$sqlz3->execute();
		$n3 = $sqlz3->rowCount();
 

		$jn = $n1+$n2+$n3;

			$response = array(
			'sts'=>'ok', 
			'jn'=>$jn, 
			'n1'=>$n1, 
			'n2'=>$n2, 
			'n3'=>$n3, 
			);
			
			echo json_encode($response);
}


if ($_POST['cek1'] == "cekList") {
		$sql1 = $con->prepare("SELECT * FROM set_beasiswa");
		$sql1->execute();
		$d1 = $sql1->fetch();
		$periodee = $d1['periode'];


		$sqlz1 = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE periode='$periodee' AND status_verifikasi='1' AND status_perbaikan='2'");
		$sqlz1->execute();
		$dz1 = $sqlz1->fetch();
		$n1 = $sqlz1->rowCount();
 

		$sqlz2 = $con->prepare("SELECT * FROM beasiswa_ta WHERE periode='$periodee' AND status_verifikasi='1' AND status_perbaikan='2'");
		$sqlz2->execute();
		$dz2 = $sqlz2->fetch();
		$n2 = $sqlz2->rowCount();
 
		$sqlz3 = $con->prepare("SELECT * FROM beasiswa_coass WHERE periode='$periodee' AND status_verifikasi='1' AND status_perbaikan='2'");
		$sqlz3->execute();
		$dz3 = $sqlz3->fetch();
		$n3 = $sqlz3->rowCount();
 

		$jn = $n1+$n2+$n3;



			$response = array(
			'sts'=>'ok', 
			'list'=>$list, 
			);
			
			echo json_encode($response);
}
?>
