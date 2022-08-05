<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");

$aksi = $_POST['aksi'];
$cek = $_GET['cek'];
$sql1 = $con->prepare("SELECT * FROM set_beasiswa");
$sql1->execute();
$d = $sql1->fetch();


if ($cek == "cek") {
	$tgl = $d['tgl_tutup'];
	$response = array(
		'batas'=>batasKumpul($tgl), // Set status
	);
	echo json_encode($response) ;
}

if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					if ($_POST['periode'] != "") {
						$periode = $_POST['periode']; 
					}else{
						$periode = $d['periode']; 						
					} 
					if ($_POST['pp'] != "") {
						$pp = $_POST['pp']; 
					}else{
						$pp = $d['batas_prestasi']; 						
					} 
					if ($_POST['pta'] != "") {
						$pta = $_POST['pta']; 
					}else{
						$pta = $d['batas_ta']; 						
					} 
					if ($_POST['tglB'] != "") {
						$tglB = $_POST['tglB']; 
					}else{
						$tglB = $d['tgl_buka']; 						
					} 
					if ($_POST['tglT'] != "") {
						$tglT = $_POST['tglT']; 
					}else{
						$tglT = $d['tgl_tutup']; 						
					} 

							$sql = $con->prepare("UPDATE set_beasiswa SET periode=:periode, batas_prestasi=:pp, batas_ta=:pta, tgl_buka=:tglB, tgl_tutup=:tglT");
							$sql->bindParam(':periode', $periode);
							$sql->bindParam(':pp', $pp);
							$sql->bindParam(':pta', $pta);
							$sql->bindParam(':tglB', $tglB);
							$sql->bindParam(':tglT', $tglT);
							$sql->execute(); // Eksekusi query insert 
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
							// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
							$response = array(
								'status'=>'sukses', // Set status
								'pesan'=>'Data berhasil diubah', // Set pesan 
							);
						}else{ // Jika proses upload gagal
							$response = array(
								'status'=>'gagal', // Set status
								'pesan'=>'Gambar gagal untuk diupload', // Set pesan
							);
						}


						echo json_encode($response); // konversi variabel response menjadi JSON
			
}


?>