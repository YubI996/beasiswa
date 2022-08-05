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
				$id_bcs = $_POST['id_bcs'];  
				$statusV = $_POST['verifikasi'];
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

					$q = $con->prepare("SELECT b.id_mahasiswa, m.nama_mahasiswa, m.email FROM mahasiswa m, beasiswa_coass b WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_bcs='$id_bcs'");
					$q->execute();

					$dm = $q->fetch();
					$mhs = $dm['nama_mahasiswa'];
					$email = $dm['email'];

					kirimNotif($mhs, $email, $keterangan);

					$statusP = 1;

				}else if ($statusV == 3) {

					$q = $con->prepare("SELECT b.id_mahasiswa, m.nama_mahasiswa, m.email FROM mahasiswa m, beasiswa_coass b WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_bcs='$id_bcs'");
					$q->execute();

					$dm = $q->fetch();
					$mhs = $dm['nama_mahasiswa'];
					$email = $dm['email'];
					
					kirimNotif1($mhs, $email, $keterangan);
					$statusP = 0;
				}
				else{
					$statusP = 0;
				}


							// Proses ubah ke Database
                            $sql = $con->prepare("UPDATE beasiswa_coass SET status_verifikasi=:statusV, status_perbaikan=:statusP, tgl_verifikasi=:tgl, keterangan=:keterangan, verifikator=:verifikator WHERE id_bcs=:id_bcs");
							$sql->bindParam(':id_bcs', $id_bcs);
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
			$id_bcs = $_POST['id_bcs'];

			$sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.daerah, m.ilmu, m.perguruan_tinggi, m.jenjang FROM beasiswa_coass b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_bcs=:id_bcs");
			$sql->bindParam(':id_bcs', $id_bcs);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

			$q = $con->prepare("SELECT nama_user FROM user WHERE id_user='$d[verifikator]'");
			$q->execute();
			$du = $q->fetch();

			if ($du['nama_user'] == '') 
				$nmu = '-'; else $nmu = $du['nama_user'];

			$response = array(
				'id'=>$d['id_bcs'],  
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
				'khs'=>$d['transkrip'],  
				'suratPN'=>$d['surat_penelitian'],  
				'propPN1'=>$d['proposal_penelitian1'],  
				'propPN2'=>$d['proposal_penelitian2'],  
				'suratTA'=>$d['surat_ta'],  
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
				'ijazah1'=>$d['ijazah_sekolah'],  
				'ijazah2'=>$d['ijazah_pt'],  
				'statusV'=>$d['status_verifikasi'],  
				'tglV'=>$d['tgl_verifikasi'],  
				'keterangan'=>str_replace('<br />', '', $d['keterangan']),  
				'verifikator'=>$nmu,  
			);
			echo json_encode($response); 

	
}


?>