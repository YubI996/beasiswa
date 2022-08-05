<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-verifikator.php");

$aksi = $_POST['aksi'];


if ($aksi == "verifying") {
			// Ambil data yang dikirim dari form
				$id_bp = $_POST['id_bp'];  
				$statusV = $_POST['verifikasi']; 
				$id_mahasiswa = $_POST['id_mahasiswa'];
				$periode = $_POST['periode'];

				if ($statusV != 0) {
					$verifikator = $_SESSION['id'];
					$keterangan = nl2br($_POST['keterangan']); 
					$tgl = date("Y-m-d H:i:s"); 
				}else{
					$verifikator = '0';
					$keterangan = ''; 
					$tgl = ''; 		
				}

				if ($statusV == 1) {

					$q = $con->prepare("SELECT b.id_mahasiswa, m.nama_mahasiswa, m.email FROM mahasiswa m, beasiswa_prestasi b WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_bp='$id_bp'");
					$q->execute();

					$dm = $q->fetch();
					$mhs = $dm['nama_mahasiswa'];
					$email = $dm['email'];

					kirimNotif($mhs, $email, $keterangan);

					$statusP = 1;

				}else{
					$statusP = 0;
				}
 

							// Proses ubah ke Database
                            $sql = $con->prepare("UPDATE beasiswa_prestasi SET status_verifikasi=:statusV, status_perbaikan=:statusP, tgl_verifikasi=:tgl, keterangan=:keterangan, verifikator=:verifikator WHERE id_bp=:id_bp");
							$sql->bindParam(':id_bp', $id_bp);
							$sql->bindParam(':statusV', $statusV);
							$sql->bindParam(':statusP', $statusP);
							$sql->bindParam(':verifikator', $verifikator);
							$sql->bindParam(':tgl', $tgl);
							$sql->bindParam(':keterangan', $keterangan);
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
					
if ($aksi == 'fdata') {
			$id_bp = $_POST['id_bp'];

			$sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.daerah, m.ilmu, m.perguruan_tinggi, m.jenjang FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_bp=:id_bp");
			$sql->bindParam(':id_bp', $id_bp);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$q = $con->prepare("SELECT nama_user FROM user WHERE id_user='$d[verifikator]'");
			$q->execute();
			$du = $q->fetch(); 

			if ($du['nama_user'] == '') 
				$nmu = '-'; else $nmu = $du['nama_user'];

			$response = array(
				'id'=>$d['id_bp'],  
				'idmhs'=>$d['id_mahasiswa'],  
				'nama'=>$d['nama_mahasiswa'],  
				'foto'=>$d['foto_mahasiswa'],  
				'pt'=>$d['perguruan_tinggi'],  
				'daerah'=>$d['daerah'],  
				'ilmu'=>$d['ilmu'],  
				'jenjang'=>$d['jenjang'],  
				'periode'=>$d['periode'],  
				'tglP'=>$d['tgl_permohonan'],  
				'semester'=>$d['semester'],  
				'semester1'=>konversiRomawi($d['semester']),   
				'ipk'=>$d['ipk'],  
				'suratP'=>$d['surat_permohonan'],  
				'suratAK'=>$d['aktif_kuliah'],  
				'khs'=>$d['khs'],  
				'suratB'=>$d['non_beasiswa'],  
				'suratK'=>$d['non_pekerja'],  
				'ktm'=>$d['ktm'],  
				'ktp'=>$d['ktp'],  
				'akta'=>$d['akta_kelahiran'],  
				'kk'=>$d['kk'],  
				'domisili'=>$d['domisili'],  
				'suratN'=>$d['non_narkoba'],  
				'sertifikat1'=>$d['sertifikat1'],  
				'sertifikat2'=>$d['sertifikat2'],  
				'sertifikat3'=>$d['sertifikat3'],  
				'burek'=>$d['buku_rekening'],  
				'ijazah'=>$d['ijazah'],  
				'statusV'=>$d['status_verifikasi'],  
				'tglV'=>$d['tgl_verifikasi'],  
				'keterangan'=>str_replace('<br />', '', $d['keterangan']),  
				'verifikator'=>$nmu,      
			);
			echo json_encode($response); 

	
}


/*
if ($aksi == 'vdata') {
			$id_bp = $_POST['id_bp'];

			$sql = $con->prepare("SELECT * FROM verifikasi_pr WHERE id_bp=:id_bp");
			$sql->bindParam(':id_bp', $id_bp);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'id'=>$d['id_vp'],  
				'idbp'=>$d['id_bp'],  
				'vp_suratP'=>$d['vp_surat_permohonan'],  
				'vp_suratAK'=>$d['vp_aktif_kuliah'],  
				'vp_khs'=>$d['vp_khs'],  
				'vp_suratB'=>$d['vp_non_beasiswa'],  
				'vp_suratK'=>$d['vp_non_pekerja'],  
				'vp_ktm'=>$d['vp_ktm'],  
				'vp_ktp'=>$d['vp_ktp'],  
				'vp_akta'=>$d['vp_akta_kelahiran'],  
				'vp_kk'=>$d['vp_kk'],  
				'vp_domisili'=>$d['vp_domisili'],  
				'vp_suratN'=>$d['vp_non_narkoba'],  
				'vp_sertifikat1'=>$d['vp_sertifikat1'],  
				'vp_sertifikat2'=>$d['vp_sertifikat2'],  
				'vp_sertifikat3'=>$d['vp_sertifikat3'],  
				'vp_burek'=>$d['vp_buku_rekening'],  
				'vp_ijazah'=>$d['vp_ijazah'], 
			);
			echo json_encode($response); 

	
}

if ($aksi == 'fvd') {
			$id_bp = $_POST['id_bp'];
			$dv = $_POST['dv'];

			$sql = $con->prepare("SELECT $dv FROM verifikasi_pr WHERE id_bp='$id_bp'");
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$response = array(
				'data'=>$d[$dv],  
			);
			echo json_encode($response); 

	
}
*/

?>