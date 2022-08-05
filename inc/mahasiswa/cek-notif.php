<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-mahasiswa.php");

if ($_GET['cek'] == "batasKumpul") {
	$sql = $con->prepare("SELECT * FROM set_beasiswa");
	$sql->execute();
	$d = $sql->fetch();
	$tgl = $d['tgl_tutup'];
	echo batasKumpul($tgl) ;
}


if ($_GET['cek'] == "cekBerkas") {
	$sql1 = $con->prepare("SELECT * FROM set_beasiswa");
	$sql1->execute();
	$d1 = $sql1->fetch();
	$periodee = $d1['periode'];


		$sqlm = $con->prepare("SELECT * FROM mahasiswa WHERE id_user='$_SESSION[id]'");
		$sqlm->execute();
		$dm = $sqlm->fetch();


		$sqlz1 = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='1'");
		$sqlz1->execute();
		$dz1 = $sqlz1->fetch();

		if ($sqlz1->rowCount() > 0) {
		    $bsw = 'Beasiswa Prestasi'; 
		    $tgb = $dz1['tgl_permohonan'];
		    $keter = $dz1['keterangan'];
				$response = array(
						'status'=>'yes',  
						'namam'=>$dm['nama_mahasiswa'],  
						'keter'=>$keter,  
						'beasiswa'=>$bsw,  
						'tgl'=>$tgb  
					);
		}else{


				$sqlz2 = $con->prepare("SELECT * FROM beasiswa_ta WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='1'");
				$sqlz2->execute();
				$dz2 = $sqlz2->fetch();

				if ($sqlz2->rowCount() > 0) {
				    $bsw = 'Beasiswa Tugas Akhir';
				    $tgb = $dz2['tgl_permohonan'];
				    $keter = $dz2['keterangan'];

						$response = array(
								'status'=>'yes',  
								'namam'=>$dm['nama_mahasiswa'],  
								'keter'=>$keter,  
								'beasiswa'=>$bsw,  
								'tgl'=>$tgb  
							);

				}else{

					$sqlz2 = $con->prepare("SELECT * FROM beasiswa_coass WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='1'");
					$sqlz2->execute();
					$dz2 = $sqlz2->fetch();

					if ($sqlz2->rowCount() > 0) {
					    $bsw = 'Beasiswa Tugas Akhir';
					    $tgb = $dz2['tgl_permohonan'];
					    $keter = $dz2['keterangan'];

							$response = array(
									'status'=>'yes',  
									'namam'=>$dm['nama_mahasiswa'],  
									'keter'=>$keter,  
									'beasiswa'=>$bsw,  
									'tgl'=>$tgb  
								);

					}else{
							$response = array(
									'status'=>'no'   
								);

					}

				}

		}




				echo json_encode($response);  

}

if ($_POST['cek'] == "cekLengkap") {
	if ($_SESSION['berkas'] != "1") {

		$sql1 = $con->prepare("SELECT * FROM set_beasiswa");
		$sql1->execute();
		$d1 = $sql1->fetch();
		$periodee = $d1['periode'];
		$status = $d1['status_beasiswa'];

		if ($status == 1) { //kalo masih dalam sesi penerimaan

			$sqlm = $con->prepare("SELECT * FROM mahasiswa WHERE id_user='$_SESSION[id]'");
			$sqlm->execute();
			$dm = $sqlm->fetch();


			$sqlz1 = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='3'");
			$sqlz1->execute();
			$dz1 = $sqlz1->fetch();

			if ($sqlz1->rowCount() > 0) {
					$_SESSION['berkas'] = "1";
					$response = array(
									'status'=>'acc',
									'nama'=>$dm['nama_mahasiswa'],  								
						);
			}else{

					$sqlz2 = $con->prepare("SELECT * FROM beasiswa_ta WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='3'");
					$sqlz2->execute();
					$dz2 = $sqlz2->fetch();

					if ($sqlz2->rowCount() > 0) {
							$_SESSION['berkas'] = "1";
							$response = array(
									'status'=>'acc',
									'nama'=>$dm['nama_mahasiswa'],  								
								);

					}else{

						$sqlz2 = $con->prepare("SELECT * FROM beasiswa_coass WHERE id_mahasiswa='$dm[id_mahasiswa]' AND periode='$periodee' AND status_verifikasi='3'");
						$sqlz2->execute();
						$dz2 = $sqlz2->fetch();

						if ($sqlz2->rowCount() > 0) {
								$_SESSION['berkas'] = "1";
								$response = array(
										'status'=>'acc',
										'nama'=>$dm['nama_mahasiswa'],  								
									);

						}else{
								$response = array(
										'status'=>'no'   
									);

						}

					}

			}


				echo json_encode($response);  


			}else{ //jika sudah ditutup semua
						$response = array(
								'status'=>'no'   
							);

			}

	}else{
							$response = array(
									'status'=>'no'   
								);
	}


}
?>
