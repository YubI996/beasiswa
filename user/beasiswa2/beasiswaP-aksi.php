<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-admin.php");


$aksi = $_POST['aksi'];

			if ($aksi == "add") {
			// Ambil data yang dikirim dari form
				$id_bp = '';  
				$id_mahasiswa = $_POST['id_mahasiswa']; 
				$periode = $_POST['periode']; 
				$tgl = $_POST['tgl']. ' '.date("H:i:s");  
				$semester = $_POST['semester'];  
				$ipk = $_POST['ipk'];
				$statusV = '0';
				$statusP = '0';
				$verifikator = '0';
				$tgl_verifikasi = '';
				$keterangan = '';

				$qw = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE id_mahasiswa='$id_mahasiswa' AND periode='$periode'");
				$qw->execute();
				$n = $qw->rowCount();

				$qw1 = $con->prepare("SELECT * FROM beasiswa_ta WHERE id_mahasiswa='$id_mahasiswa' AND periode='$periode'");
				$qw1->execute();
				$n1 = $qw1->rowCount();

				if ($n > 0 || $n1 > 0) { 

					$response = array(
						'status'=>'double', // Set status
						'pesan'=>'Data sudah ada', // Set pesan 
					);
				echo json_encode($response); // konversi variabel response menjadi JSON

				}else{

			
 
				 if (!empty($_FILES["suratP"]["tmp_name"])) {
								$suratP = 'SP'.date("dHis").'-'.$_FILES['suratP']['name'];
				 }else{
								$suratP = '';
				 }
				 if (!empty($_FILES["suratAK"]["tmp_name"])) {
								$suratAK = 'AK'.date("dHis").'-'.$_FILES['suratAK']['name'];
				 }else{
								$suratAK = '';
				 }
				 if (!empty($_FILES["khs"]["tmp_name"])) {
								$khs = 'KHS'.date("dHis").'-'.$_FILES['khs']['name'];
				 }else{
								$khs = '';
				 }
				 if (!empty($_FILES["suratK"]["tmp_name"])) {
								$suratK = 'SK'.date("dHis").'-'.$_FILES['suratK']['name'];
				 }else{
								$suratK = '';
				 }
				 if (!empty($_FILES["suratB"]["tmp_name"])) {
								$suratB = 'SB'.date("dHis").'-'.$_FILES['suratB']['name'];
				 }else{
								$suratB = '';
				 }
				 if (!empty($_FILES["ktm"]["tmp_name"])) {
								$ktm = 'KTM'.date("dHis").'-'.$_FILES['ktm']['name'];
				 }else{
								$ktm = '';
				 }
				 if (!empty($_FILES["ktp"]["tmp_name"])) {
								$ktp = 'KTP'.date("dHis").'-'.$_FILES['ktp']['name'];
				 }else{
								$ktp = '';
				 }
				 if (!empty($_FILES["akta"]["tmp_name"])) {
								$akta = 'AKT'.date("dHis").'-'.$_FILES['akta']['name'];
				 }else{
								$akta = '';
				 }
				 if (!empty($_FILES["kk"]["tmp_name"])) {
								$kk = 'KK'.date("dHis").'-'.$_FILES['kk']['name'];
				 }else{
								$kk = '';
				 }
				 if (!empty($_FILES["domisili"]["tmp_name"])) {
								$domisili = 'DOM'.date("dHis").'-'.$_FILES['domisili']['name'];
				 }else{
								$domisili = '';
				 }
				 if (!empty($_FILES["suratN"]["tmp_name"])) {
								$suratN = 'SN'.date("dHis").'-'.$_FILES['suratN']['name'];
				 }else{
								$suratN = '';
				 }
				 if (!empty($_FILES["burek"]["tmp_name"])) {
								$burek = 'BR'.date("dHis").'-'.$_FILES['burek']['name'];
				 }else{
								$burek = '';
				 }
				 if (!empty($_FILES["ijazah"]["tmp_name"])) {
								$ijazah = 'IJZ'.date("dHis").'-'.$_FILES['ijazah']['name'];
				 }else{
								$ijazah = '';
				 }
				 if (!empty($_FILES["sertifikat1"]["tmp_name"])) {
								$sertifikat1 = 'S1'.date("dHis").'-'.$_FILES['sertifikat1']['name'];
				 }else{
								$sertifikat1 = '';
				 }
				 if (!empty($_FILES["sertifikat2"]["tmp_name"])) {
								$sertifikat2 = 'S2'.date("dHis").'-'.$_FILES['sertifikat2']['name'];
				 }else{
								$sertifikat2 = '';
				 }
				 if (!empty($_FILES["sertifikat3"]["tmp_name"])) {
								$sertifikat3 = 'S3'.date("dHis").'-'.$_FILES['sertifikat3']['name'];
				 }else{
								$sertifikat3 = '';
				 }
 
				$tmpP = $_FILES['suratP']['tmp_name'];
				 
				$tmpAk = $_FILES['suratAK']['tmp_name'];

				$tmpKhs = $_FILES['khs']['tmp_name'];
				
				$tmpSK = $_FILES['suratK']['tmp_name'];
				
				$tmpSB = $_FILES['suratB']['tmp_name'];
				
				$tmpKtm = $_FILES['ktm']['tmp_name'];
				
				$tmpKtp = $_FILES['ktp']['tmp_name'];
				
				$tmpAkta = $_FILES['akta']['tmp_name'];
				
				$tmpKk = $_FILES['kk']['tmp_name'];
				
				$tmpDom = $_FILES['domisili']['tmp_name'];
				
				$tmpSN = $_FILES['suratN']['tmp_name'];
				
				$tmpBR = $_FILES['burek']['tmp_name'];
				
				$tmpIj = $_FILES['ijazah']['tmp_name'];
									
				$tmpS1 = $_FILES['sertifikat1']['tmp_name'];

				$tmpS2 = $_FILES['sertifikat2']['tmp_name'];

				$tmpS3 = $_FILES['sertifikat3']['tmp_name'];



				$suratP1 = "file_berkas_pr/".$suratP;
				$suratAK1 = "file_berkas_pr/".$suratAK;
				$khs1 = "file_berkas_pr/".$khs;
				$suratK1 = "file_berkas_pr/".$suratK;
				$suratB1 = "file_berkas_pr/".$suratB;
				$ktm1 = "file_berkas_pr/".$ktm;
				$ktp1 = "file_berkas_pr/".$ktp;
				$akta1 = "file_berkas_pr/".$akta;
				$kk1 = "file_berkas_pr/".$kk;
				$domisili1 = "file_berkas_pr/".$domisili;
				$suratN1 = "file_berkas_pr/".$suratN;
				$burek1 = "file_berkas_pr/".$burek;
				$ijazah1 = "file_berkas_pr/".$ijazah;
				$sertifikat11 = "file_berkas_pr/".$sertifikat1;
				$sertifikat21 = "file_berkas_pr/".$sertifikat2;
				$sertifikat31 = "file_berkas_pr/".$sertifikat3;

					// Proses simpan ke Database
					$sql = $con->prepare("INSERT INTO beasiswa_prestasi VALUES (:id_bp, :id_mahasiswa, :periode, :tgl, :semester, :ipk, :suratP, :suratAK, :khs, :suratK, :suratB, :ktm, :ktp, :akta, :kk, :domisili, :suratN, :sertifikat1, :sertifikat2, :sertifikat3, :burek, :ijazah, :statusV, :statusP, :tgl_verifikasi, :keterangan, :verifikator)");
					$sql->bindParam(':id_bp', $id_bp);
					$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
					$sql->bindParam(':periode', $periode);
					$sql->bindParam(':tgl', $tgl);
					$sql->bindParam(':semester', $semester);
					$sql->bindParam(':ipk', $ipk);
					$sql->bindParam(':suratP', $suratP);
					$sql->bindParam(':suratAK', $suratAK);
					$sql->bindParam(':khs', $khs);
					$sql->bindParam(':suratK', $suratK);
					$sql->bindParam(':suratB', $suratB);
					$sql->bindParam(':ktm', $ktm);
					$sql->bindParam(':ktp', $ktp);
					$sql->bindParam(':akta', $akta);
					$sql->bindParam(':kk', $kk);
					$sql->bindParam(':domisili', $domisili);
					$sql->bindParam(':suratN', $suratN);
					$sql->bindParam(':sertifikat1', $sertifikat1);
					$sql->bindParam(':sertifikat2', $sertifikat2);
					$sql->bindParam(':sertifikat3', $sertifikat3);
					$sql->bindParam(':burek', $burek);
					$sql->bindParam(':ijazah', $ijazah);
					$sql->bindParam(':statusV', $statusV);
					$sql->bindParam(':statusP', $statusP);
					$sql->bindParam(':verifikator', $verifikator);
					$sql->bindParam(':tgl_verifikasi', $tgl_verifikasi);
					$sql->bindParam(':keterangan', $keterangan);
					$sql->execute(); // Eksekusi query insert
					 
					
				if($sql){ // Jika proses upload sukses
									//proses upload
				move_uploaded_file($tmpP, $suratP1);
				move_uploaded_file($tmpAk, $suratAK1);
				move_uploaded_file($tmpKhs, $khs1);
				move_uploaded_file($tmpSK, $suratK1);
				move_uploaded_file($tmpSB, $suratB1);
				move_uploaded_file($tmpKtm, $ktm1);
				move_uploaded_file($tmpKtp, $ktp1);
				move_uploaded_file($tmpAkta, $akta1);
				move_uploaded_file($tmpKk, $kk1);
				move_uploaded_file($tmpDom, $domisili1);
				move_uploaded_file($tmpSN, $suratN1);
				move_uploaded_file($tmpBR, $burek1);
				move_uploaded_file($tmpIj, $ijazah1);
				move_uploaded_file($tmpS1, $sertifikat11);
				move_uploaded_file($tmpS2, $sertifikat21);
				move_uploaded_file($tmpS3, $sertifikat31);


					// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
					$response = array(
						'status'=>'sukses', // Set status
						'pesan'=>'Data berhasil disimpan', // Set pesan 
					);
				}else{ // Jika proses upload gagal
					$response = array(
						'status'=>'gagal', // Set status
						'pesan'=>'Gambar gagal untuk diupload', // Set pesan 
					);
				}

				echo json_encode($response); // konversi variabel response menjadi JSON
	}
			}

if ($aksi == "edt") {
			// Ambil data yang dikirim dari form
				$id_bp = $_POST['id_bp'];  
				$id_mahasiswa = $_POST['id_mahasiswa']; 
				$periode = $_POST['periode']; 
				$tgl = $_POST['tgl'];  
				$semester = $_POST['semester'];  
				$ipk = $_POST['ipk'];
				$SP = $_POST['suratP'];
				$SAK = $_POST['suratAK'];
				$KHS = $_POST['khs'];
				$SK = $_POST['suratK'];
				$SB = $_POST['suratB'];
				$KTM = $_POST['ktm'];
				$KTP = $_POST['ktp'];
				$AKT = $_POST['akta'];
				$KK = $_POST['kk'];
				$DOM = $_POST['domisili'];
				$SN = $_POST['suratN'];
				$BR = $_POST['burek'];
				$IJZ = $_POST['ijazah'];
				$S1 = $_POST['sertifikat1'];
				$S2 = $_POST['sertifikat2'];
				$S3 = $_POST['sertifikat3'];
				$statusV = '0';
				$verifikator = '';

				$cek1 = $con->prepare("SELECT id_mahasiswa FROM beasiswa_prestasi WHERE id_bp='$id_bp'");
				$cek1->execute();
				$dm = $cek1->fetch();



				if ($dm['id_mahasiswa'] == $id_mahasiswa) { //jika data yang akan diedit id mahasiswa nya sama

				$q = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE id_bp='$id_bp'");
				$q->execute();
				$d = $q->fetch();



					 if (!empty($_FILES["suratP"]["tmp_name"]) && $SP == "") {
									$suratP = 'SP'.date("dHis").'-'.$_FILES['suratP']['name'];
									if(is_file("file_berkas_pr/".$d['surat_permohonan'])) 
									unlink("file_berkas_pr/".$d['surat_permohonan']); 
					 }else{
									$suratP = $d['surat_permohonan'];
					 }
					 if (!empty($_FILES["suratAK"]["tmp_name"]) && $SAK == "") {
									$suratAK = 'AK'.date("dHis").'-'.$_FILES['suratAK']['name'];
									if(is_file("file_berkas_pr/".$d['aktif_kuliah'])) 
									unlink("file_berkas_pr/".$d['aktif_kuliah']); 
					 }else{
									$suratAK = $d['aktif_kuliah'];
					 }
					 if (!empty($_FILES["khs"]["tmp_name"]) && $KHS == "") {
									$khs = 'KHS'.date("dHis").'-'.$_FILES['khs']['name'];
									if(is_file("file_berkas_pr/".$d['khs'])) 
									unlink("file_berkas_pr/".$d['khs']); 
					 }else{
									$khs = $d['khs'];
					 }
					 if (!empty($_FILES["suratK"]["tmp_name"]) && $SK == "") {
									$suratK = 'SK'.date("dHis").'-'.$_FILES['suratK']['name'];
									if(is_file("file_berkas_pr/".$d['non_pekerja'])) 
									unlink("file_berkas_pr/".$d['non_pekerja']); 
					 }else{
									$suratK = $d['non_pekerja'];
					 }
					 if (!empty($_FILES["suratB"]["tmp_name"]) && $SB == "") {
									$suratB = 'SB'.date("dHis").'-'.$_FILES['suratB']['name'];
									if(is_file("file_berkas_pr/".$d['non_beasiswa'])) 
									unlink("file_berkas_pr/".$d['non_beasiswa']); 
					 }else{
									$suratB = $d['non_beasiswa'];
					 }
					 if (!empty($_FILES["ktm"]["tmp_name"]) && $KTM == "") {
									$ktm = 'KTM'.date("dHis").'-'.$_FILES['ktm']['name'];
									if(is_file("file_berkas_pr/".$d['ktm'])) 
									unlink("file_berkas_pr/".$d['ktm']); 
					 }else{
									$ktm = $d['ktm'];
					 }
					 if (!empty($_FILES["ktp"]["tmp_name"]) && $KTP == "") {
									$ktp = 'KTP'.date("dHis").'-'.$_FILES['ktp']['name'];
									if(is_file("file_berkas_pr/".$d['ktp'])) 
									unlink("file_berkas_pr/".$d['ktp']); 
					 }else{
									$ktp = $d['ktp'];
					 }
					 if (!empty($_FILES["akta"]["tmp_name"]) && $AKT == "") {
									$akta = 'AKT'.date("dHis").'-'.$_FILES['akta']['name'];
									if(is_file("file_berkas_pr/".$d['akta_kelahiran'])) 
									unlink("file_berkas_pr/".$d['akta_kelahiran']); 
					 }else{
									$akta = $d['akta_kelahiran'];
					 }
					 if (!empty($_FILES["kk"]["tmp_name"]) && $KK == "") {
									$kk = 'KK'.date("dHis").'-'.$_FILES['kk']['name'];
									if(is_file("file_berkas_pr/".$d['kk'])) 
									unlink("file_berkas_pr/".$d['kk']); 
					 }else{
									$kk = $d['kk'];
					 }
					 if (!empty($_FILES["domisili"]["tmp_name"]) && $DOM == "") {
									$domisili = 'DOM'.date("dHis").'-'.$_FILES['domisili']['name'];
									if(is_file("file_berkas_pr/".$d['domisili'])) 
									unlink("file_berkas_pr/".$d['domisili']); 
					 }else{
									$domisili = $d['domisili'];
					 }
					 if (!empty($_FILES["suratN"]["tmp_name"]) && $SN == "") {
									$suratN = 'SN'.date("dHis").'-'.$_FILES['suratN']['name'];
									if(is_file("file_berkas_pr/".$d['non_narkoba'])) 
									unlink("file_berkas_pr/".$d['non_narkoba']); 
					 }else{
									$suratN = $d['non_narkoba'];
					 }
					 if (!empty($_FILES["burek"]["tmp_name"]) && $BR == "") {
									$burek = 'BR'.date("dHis").'-'.$_FILES['burek']['name'];
									if(is_file("file_berkas_pr/".$d['buku_rekening'])) 
									unlink("file_berkas_pr/".$d['buku_rekening']); 
					 }else{
									$burek = $d['buku_rekening'];
					 }
					 if (!empty($_FILES["ijazah"]["tmp_name"]) && $IJZ == "") {
									$ijazah = 'IJZ'.date("dHis").'-'.$_FILES['ijazah']['name'];
									if(is_file("file_berkas_pr/".$d['ijazah'])) 
									unlink("file_berkas_pr/".$d['ijazah']); 
					 }else{
									$ijazah = $d['ijazah'];
					 }
					 if (!empty($_FILES["sertifikat1"]["tmp_name"]) && $S1 == "") {
									$sertifikat1 = 'S1'.date("dHis").'-'.$_FILES['sertifikat1']['name'];
									if(is_file("file_berkas_pr/".$d['sertifikat1'])) 
									unlink("file_berkas_pr/".$d['sertifikat1']); 
					 }else{
									$sertifikat1 = $d['sertifikat1'];
					 }
					 if (!empty($_FILES["sertifikat2"]["tmp_name"]) && $S2 == "") {
									$sertifikat2 = 'S2'.date("dHis").'-'.$_FILES['sertifikat2']['name'];
									if(is_file("file_berkas_pr/".$d['sertifikat2'])) 
									unlink("file_berkas_pr/".$d['sertifikat2']); 
					 }else{
									$sertifikat2 = $d['sertifikat2'];
					 }
					 if (!empty($_FILES["sertifikat3"]["tmp_name"]) && $S3 == "") {
									$sertifikat3 = 'S3'.date("dHis").'-'.$_FILES['sertifikat3']['name'];
									if(is_file("file_berkas_pr/".$d['sertifikat3'])) 
									unlink("file_berkas_pr/".$d['sertifikat3']); 
					 }else{
									$sertifikat3 = $d['sertifikat3'];
					 }
	 
					$tmpP = $_FILES['suratP']['tmp_name'];
					 
					$tmpAk = $_FILES['suratAK']['tmp_name'];

					$tmpKhs = $_FILES['khs']['tmp_name'];
					
					$tmpSK = $_FILES['suratK']['tmp_name'];
					
					$tmpSB = $_FILES['suratB']['tmp_name'];
					
					$tmpKtm = $_FILES['ktm']['tmp_name'];
					
					$tmpKtp = $_FILES['ktp']['tmp_name'];
					
					$tmpAkta = $_FILES['akta']['tmp_name'];
					
					$tmpKk = $_FILES['kk']['tmp_name'];
					
					$tmpDom = $_FILES['domisili']['tmp_name'];
					
					$tmpSN = $_FILES['suratN']['tmp_name'];
					
					$tmpBR = $_FILES['burek']['tmp_name'];
					
					$tmpIj = $_FILES['ijazah']['tmp_name'];
										
					$tmpS1 = $_FILES['sertifikat1']['tmp_name'];

					$tmpS2 = $_FILES['sertifikat2']['tmp_name'];

					$tmpS3 = $_FILES['sertifikat3']['tmp_name'];



					$suratP1 = "file_berkas_pr/".$suratP;
					$suratAK1 = "file_berkas_pr/".$suratAK;
					$khs1 = "file_berkas_pr/".$khs;
					$suratK1 = "file_berkas_pr/".$suratK;
					$suratB1 = "file_berkas_pr/".$suratB;
					$ktm1 = "file_berkas_pr/".$ktm;
					$ktp1 = "file_berkas_pr/".$ktp;
					$akta1 = "file_berkas_pr/".$akta;
					$kk1 = "file_berkas_pr/".$kk;
					$domisili1 = "file_berkas_pr/".$domisili;
					$suratN1 = "file_berkas_pr/".$suratN;
					$burek1 = "file_berkas_pr/".$burek;
					$ijazah1 = "file_berkas_pr/".$ijazah;
					$sertifikat11 = "file_berkas_pr/".$sertifikat1;
					$sertifikat21 = "file_berkas_pr/".$sertifikat2;
					$sertifikat31 = "file_berkas_pr/".$sertifikat3;



								// Proses ubah ke Database
	                            $sql = $con->prepare("UPDATE beasiswa_prestasi SET id_mahasiswa=:id_mahasiswa, periode=:periode, tgl_permohonan=:tgl, semester=:semester, ipk=:ipk, surat_permohonan=:suratP, aktif_kuliah=:suratAK, khs=:khs, non_pekerja=:suratK, non_beasiswa=:suratB, ktm=:ktm, ktp=:ktp, akta_kelahiran=:akta, kk=:kk, domisili=:domisili, non_narkoba=:suratN, sertifikat1=:sertifikat1, sertifikat2=:sertifikat2, sertifikat3=:sertifikat3, buku_rekening=:burek, ijazah=:ijazah WHERE id_bp=:id_bp");
								$sql->bindParam(':id_bp', $id_bp);
								$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
								$sql->bindParam(':periode', $periode);
								$sql->bindParam(':tgl', $tgl);
								$sql->bindParam(':semester', $semester);
								$sql->bindParam(':ipk', $ipk);
								$sql->bindParam(':suratP', $suratP);
								$sql->bindParam(':suratAK', $suratAK);
								$sql->bindParam(':khs', $khs);
								$sql->bindParam(':suratK', $suratK);
								$sql->bindParam(':suratB', $suratB);
								$sql->bindParam(':ktm', $ktm);
								$sql->bindParam(':ktp', $ktp);
								$sql->bindParam(':akta', $akta);
								$sql->bindParam(':kk', $kk);
								$sql->bindParam(':domisili', $domisili);
								$sql->bindParam(':suratN', $suratN);
								$sql->bindParam(':sertifikat1', $sertifikat1);
								$sql->bindParam(':sertifikat2', $sertifikat2);
								$sql->bindParam(':sertifikat3', $sertifikat3);
								$sql->bindParam(':burek', $burek);
								$sql->bindParam(':ijazah', $ijazah);
								$sql->execute(); // Eksekusi query insert
								 
								
							if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
									move_uploaded_file($tmpP, $suratP1);
									move_uploaded_file($tmpAk, $suratAK1);
									move_uploaded_file($tmpKhs, $khs1);
									move_uploaded_file($tmpSK, $suratK1);
									move_uploaded_file($tmpSB, $suratB1);
									move_uploaded_file($tmpKtm, $ktm1);
									move_uploaded_file($tmpKtp, $ktp1);
									move_uploaded_file($tmpAkta, $akta1);
									move_uploaded_file($tmpKk, $kk1);
									move_uploaded_file($tmpDom, $domisili1);
									move_uploaded_file($tmpSN, $suratN1);
									move_uploaded_file($tmpBR, $burek1);
									move_uploaded_file($tmpIj, $ijazah1);
									move_uploaded_file($tmpS1, $sertifikat11);
									move_uploaded_file($tmpS2, $sertifikat21);
									move_uploaded_file($tmpS3, $sertifikat31);

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
					
				}else{ //jika data yang akan diedit id mahasiswa nya berbeda



					$qw = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE id_mahasiswa='$id_mahasiswa' AND periode='$periode'");
					$qw->execute();
					$n = $qw->rowCount();

					$qw1 = $con->prepare("SELECT * FROM beasiswa_ta WHERE id_mahasiswa='$id_mahasiswa' AND periode='$periode'");
					$qw1->execute();
					$n1 = $qw1->rowCount();

					if ($n > 0 || $n1 > 0) { 

						$response = array(
							'status'=>'double', // Set status
							'pesan'=>'Data sudah ada', // Set pesan 
						);
					echo json_encode($response); // konversi variabel response menjadi JSON

					}else{

					$q = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE id_bp='$id_bp'");
					$q->execute();
					$d = $q->fetch();



					 if (!empty($_FILES["suratP"]["tmp_name"]) && $SP == "") {
									$suratP = 'SP'.date("dHis").'-'.$_FILES['suratP']['name'];
									if(is_file("file_berkas_pr/".$d['surat_permohonan'])) 
									unlink("file_berkas_pr/".$d['surat_permohonan']); 
					 }else{
									$suratP = $d['surat_permohonan'];
					 }
					 if (!empty($_FILES["suratAK"]["tmp_name"]) && $SAK == "") {
									$suratAK = 'AK'.date("dHis").'-'.$_FILES['suratAK']['name'];
									if(is_file("file_berkas_pr/".$d['aktif_kuliah'])) 
									unlink("file_berkas_pr/".$d['aktif_kuliah']); 
					 }else{
									$suratAK = $d['aktif_kuliah'];
					 }
					 if (!empty($_FILES["khs"]["tmp_name"]) && $KHS == "") {
									$khs = 'KHS'.date("dHis").'-'.$_FILES['khs']['name'];
									if(is_file("file_berkas_pr/".$d['khs'])) 
									unlink("file_berkas_pr/".$d['khs']); 
					 }else{
									$khs = $d['khs'];
					 }
					 if (!empty($_FILES["suratK"]["tmp_name"]) && $SK == "") {
									$suratK = 'SK'.date("dHis").'-'.$_FILES['suratK']['name'];
									if(is_file("file_berkas_pr/".$d['non_pekerja'])) 
									unlink("file_berkas_pr/".$d['non_pekerja']); 
					 }else{
									$suratK = $d['non_pekerja'];
					 }
					 if (!empty($_FILES["suratB"]["tmp_name"]) && $SB == "") {
									$suratB = 'SB'.date("dHis").'-'.$_FILES['suratB']['name'];
									if(is_file("file_berkas_pr/".$d['non_beasiswa'])) 
									unlink("file_berkas_pr/".$d['non_beasiswa']); 
					 }else{
									$suratB = $d['non_beasiswa'];
					 }
					 if (!empty($_FILES["ktm"]["tmp_name"]) && $KTM == "") {
									$ktm = 'KTM'.date("dHis").'-'.$_FILES['ktm']['name'];
									if(is_file("file_berkas_pr/".$d['ktm'])) 
									unlink("file_berkas_pr/".$d['ktm']); 
					 }else{
									$ktm = $d['ktm'];
					 }
					 if (!empty($_FILES["ktp"]["tmp_name"]) && $KTP == "") {
									$ktp = 'KTP'.date("dHis").'-'.$_FILES['ktp']['name'];
									if(is_file("file_berkas_pr/".$d['ktp'])) 
									unlink("file_berkas_pr/".$d['ktp']); 
					 }else{
									$ktp = $d['ktp'];
					 }
					 if (!empty($_FILES["akta"]["tmp_name"]) && $AKT == "") {
									$akta = 'AKT'.date("dHis").'-'.$_FILES['akta']['name'];
									if(is_file("file_berkas_pr/".$d['akta_kelahiran'])) 
									unlink("file_berkas_pr/".$d['akta_kelahiran']); 
					 }else{
									$akta = $d['akta_kelahiran'];
					 }
					 if (!empty($_FILES["kk"]["tmp_name"]) && $KK == "") {
									$kk = 'KK'.date("dHis").'-'.$_FILES['kk']['name'];
									if(is_file("file_berkas_pr/".$d['kk'])) 
									unlink("file_berkas_pr/".$d['kk']); 
					 }else{
									$kk = $d['kk'];
					 }
					 if (!empty($_FILES["domisili"]["tmp_name"]) && $DOM == "") {
									$domisili = 'DOM'.date("dHis").'-'.$_FILES['domisili']['name'];
									if(is_file("file_berkas_pr/".$d['domisili'])) 
									unlink("file_berkas_pr/".$d['domisili']); 
					 }else{
									$domisili = $d['domisili'];
					 }
					 if (!empty($_FILES["suratN"]["tmp_name"]) && $SN == "") {
									$suratN = 'SN'.date("dHis").'-'.$_FILES['suratN']['name'];
									if(is_file("file_berkas_pr/".$d['non_narkoba'])) 
									unlink("file_berkas_pr/".$d['non_narkoba']); 
					 }else{
									$suratN = $d['non_narkoba'];
					 }
					 if (!empty($_FILES["burek"]["tmp_name"]) && $BR == "") {
									$burek = 'BR'.date("dHis").'-'.$_FILES['burek']['name'];
									if(is_file("file_berkas_pr/".$d['buku_rekening'])) 
									unlink("file_berkas_pr/".$d['buku_rekening']); 
					 }else{
									$burek = $d['buku_rekening'];
					 }
					 if (!empty($_FILES["ijazah"]["tmp_name"]) && $IJZ == "") {
									$ijazah = 'IJZ'.date("dHis").'-'.$_FILES['ijazah']['name'];
									if(is_file("file_berkas_pr/".$d['ijazah'])) 
									unlink("file_berkas_pr/".$d['ijazah']); 
					 }else{
									$ijazah = $d['ijazah'];
					 }
					 if (!empty($_FILES["sertifikat1"]["tmp_name"]) && $S1 == "") {
									$sertifikat1 = 'S1'.date("dHis").'-'.$_FILES['sertifikat1']['name'];
									if(is_file("file_berkas_pr/".$d['sertifikat1'])) 
									unlink("file_berkas_pr/".$d['sertifikat1']); 
					 }else{
									$sertifikat1 = $d['sertifikat1'];
					 }
					 if (!empty($_FILES["sertifikat2"]["tmp_name"]) && $S2 == "") {
									$sertifikat2 = 'S2'.date("dHis").'-'.$_FILES['sertifikat2']['name'];
									if(is_file("file_berkas_pr/".$d['sertifikat2'])) 
									unlink("file_berkas_pr/".$d['sertifikat2']); 
					 }else{
									$sertifikat2 = $d['sertifikat2'];
					 }
					 if (!empty($_FILES["sertifikat3"]["tmp_name"]) && $S3 == "") {
									$sertifikat3 = 'S3'.date("dHis").'-'.$_FILES['sertifikat3']['name'];
									if(is_file("file_berkas_pr/".$d['sertifikat3'])) 
									unlink("file_berkas_pr/".$d['sertifikat3']); 
					 }else{
									$sertifikat3 = $d['sertifikat3'];
					 }



	 
					$tmpP = $_FILES['suratP']['tmp_name'];
					 
					$tmpAk = $_FILES['suratAK']['tmp_name'];

					$tmpKhs = $_FILES['khs']['tmp_name'];
					
					$tmpSK = $_FILES['suratK']['tmp_name'];
					
					$tmpSB = $_FILES['suratB']['tmp_name'];
					
					$tmpKtm = $_FILES['ktm']['tmp_name'];
					
					$tmpKtp = $_FILES['ktp']['tmp_name'];
					
					$tmpAkta = $_FILES['akta']['tmp_name'];
					
					$tmpKk = $_FILES['kk']['tmp_name'];
					
					$tmpDom = $_FILES['domisili']['tmp_name'];
					
					$tmpSN = $_FILES['suratN']['tmp_name'];
					
					$tmpBR = $_FILES['burek']['tmp_name'];
					
					$tmpIj = $_FILES['ijazah']['tmp_name'];
										
					$tmpS1 = $_FILES['sertifikat1']['tmp_name'];

					$tmpS2 = $_FILES['sertifikat2']['tmp_name'];

					$tmpS3 = $_FILES['sertifikat3']['tmp_name'];



					$suratP1 = "file_berkas_pr/".$suratP;
					$suratAK1 = "file_berkas_pr/".$suratAK;
					$khs1 = "file_berkas_pr/".$khs;
					$suratK1 = "file_berkas_pr/".$suratK;
					$suratB1 = "file_berkas_pr/".$suratB;
					$ktm1 = "file_berkas_pr/".$ktm;
					$ktp1 = "file_berkas_pr/".$ktp;
					$akta1 = "file_berkas_pr/".$akta;
					$kk1 = "file_berkas_pr/".$kk;
					$domisili1 = "file_berkas_pr/".$domisili;
					$suratN1 = "file_berkas_pr/".$suratN;
					$burek1 = "file_berkas_pr/".$burek;
					$ijazah1 = "file_berkas_pr/".$ijazah;
					$sertifikat11 = "file_berkas_pr/".$sertifikat1;
					$sertifikat21 = "file_berkas_pr/".$sertifikat2;
					$sertifikat31 = "file_berkas_pr/".$sertifikat3;



								// Proses ubah ke Database
	                            $sql = $con->prepare("UPDATE beasiswa_prestasi SET id_mahasiswa=:id_mahasiswa, periode=:periode, tgl_permohonan=:tgl, semester=:semester, ipk=:ipk, surat_permohonan=:suratP, aktif_kuliah=:suratAK, khs=:khs, non_pekerja=:suratK, non_beasiswa=:suratB, ktm=:ktm, ktp=:ktp, akta_kelahiran=:akta, kk=:kk, domisili=:domisili, non_narkoba=:suratN, sertifikat1=:sertifikat1, sertifikat2=:sertifikat2, sertifikat3=:sertifikat3, buku_rekening=:burek, ijazah=:ijazah WHERE id_bp=:id_bp");
								$sql->bindParam(':id_bp', $id_bp);
								$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
								$sql->bindParam(':periode', $periode);
								$sql->bindParam(':tgl', $tgl);
								$sql->bindParam(':semester', $semester);
								$sql->bindParam(':ipk', $ipk);
								$sql->bindParam(':suratP', $suratP);
								$sql->bindParam(':suratAK', $suratAK);
								$sql->bindParam(':khs', $khs);
								$sql->bindParam(':suratK', $suratK);
								$sql->bindParam(':suratB', $suratB);
								$sql->bindParam(':ktm', $ktm);
								$sql->bindParam(':ktp', $ktp);
								$sql->bindParam(':akta', $akta);
								$sql->bindParam(':kk', $kk);
								$sql->bindParam(':domisili', $domisili);
								$sql->bindParam(':suratN', $suratN);
								$sql->bindParam(':sertifikat1', $sertifikat1);
								$sql->bindParam(':sertifikat2', $sertifikat2);
								$sql->bindParam(':sertifikat3', $sertifikat3);
								$sql->bindParam(':burek', $burek);
								$sql->bindParam(':ijazah', $ijazah);
								$sql->execute(); // Eksekusi query insert
								 
								
							if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
									move_uploaded_file($tmpP, $suratP1);
									move_uploaded_file($tmpAk, $suratAK1);
									move_uploaded_file($tmpKhs, $khs1);
									move_uploaded_file($tmpSK, $suratK1);
									move_uploaded_file($tmpSB, $suratB1);
									move_uploaded_file($tmpKtm, $ktm1);
									move_uploaded_file($tmpKtp, $ktp1);
									move_uploaded_file($tmpAkta, $akta1);
									move_uploaded_file($tmpKk, $kk1);
									move_uploaded_file($tmpDom, $domisili1);
									move_uploaded_file($tmpSN, $suratN1);
									move_uploaded_file($tmpBR, $burek1);
									move_uploaded_file($tmpIj, $ijazah1);
									move_uploaded_file($tmpS1, $sertifikat11);
									move_uploaded_file($tmpS2, $sertifikat21);
									move_uploaded_file($tmpS3, $sertifikat31);

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

				}
}
					


if ($aksi == "del") {
			$id_bp = $_POST['id_bp'];

			$q = $con->prepare("SELECT * FROM beasiswa_prestasi WHERE id_bp='$id_bp'");
			$q->execute();
			$d = $q->fetch();

			if(is_file("file_berkas_pr/".$d['surat_permohonan'])) 
			unlink("file_berkas_pr/".$d['surat_permohonan']); 

			if(is_file("file_berkas_pr/".$d['aktif_kuliah'])) 
			unlink("file_berkas_pr/".$d['aktif_kuliah']); 

			if(is_file("file_berkas_pr/".$d['khs'])) 
			unlink("file_berkas_pr/".$d['khs']); 

			if(is_file("file_berkas_pr/".$d['non_pekerja'])) 
			unlink("file_berkas_pr/".$d['non_pekerja']); 

			if(is_file("file_berkas_pr/".$d['non_beasiswa'])) 
			unlink("file_berkas_pr/".$d['non_beasiswa']); 

			if(is_file("file_berkas_pr/".$d['ktm'])) 
			unlink("file_berkas_pr/".$d['ktm']); 

			if(is_file("file_berkas_pr/".$d['ktp'])) 
			unlink("file_berkas_pr/".$d['ktp']); 

			if(is_file("file_berkas_pr/".$d['akta_kelahiran'])) 
			unlink("file_berkas_pr/".$d['akta_kelahiran']); 

			if(is_file("file_berkas_pr/".$d['kk'])) 
			unlink("file_berkas_pr/".$d['kk']); 

			if(is_file("file_berkas_pr/".$d['domisili'])) 
			unlink("file_berkas_pr/".$d['domisili']); 

			if(is_file("file_berkas_pr/".$d['non_narkoba'])) 
			unlink("file_berkas_pr/".$d['non_narkoba']); 

			if(is_file("file_berkas_pr/".$d['sertifikat1'])) 
			unlink("file_berkas_pr/".$d['sertifikat1']); 

			if(is_file("file_berkas_pr/".$d['sertifikat2'])) 
			unlink("file_berkas_pr/".$d['sertifikat2']); 

			if(is_file("file_berkas_pr/".$d['sertifikat3'])) 
			unlink("file_berkas_pr/".$d['sertifikat3']); 

			if(is_file("file_berkas_pr/".$d['buku_rekening'])) 
			unlink("file_berkas_pr/".$d['buku_rekening']); 

			if(is_file("file_berkas_pr/".$d['ijazah'])) 
			unlink("file_berkas_pr/".$d['ijazah']); 

			// Query untuk menghapus data periode berdasarkan periode yang dikirim
			$sql = $con->prepare("DELETE FROM beasiswa_prestasi WHERE id_bp=:id_bp");
			$sql->bindParam(':id_bp', $id_bp);
			$sql->execute(); // Eksekusi/Jalankan query
 

			// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
			$response = array(
				'pesan'=>'Data berhasil dihapus', // Set pesan 
			);
			echo json_encode($response); // konversi variabel response menjadi JSON
}


if ($aksi == 'fdata') {
			$id_bp = $_POST['id_bp'];

			$sql = $con->prepare("SELECT b.*, m.nama_mahasiswa, m.foto_mahasiswa, m.daerah, m.ilmu, m.perguruan_tinggi, m.jenjang FROM beasiswa_prestasi b, mahasiswa m WHERE b.id_mahasiswa=m.id_mahasiswa AND b.id_bp=:id_bp");
			$sql->bindParam(':id_bp', $id_bp);
			$sql->execute(); // Eksekusi/Jalankan query

			$d = $sql->fetch();

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
				'keterangan'=>$d['keterangan'],  
				'verifikator'=>$d['verifikator'],  
			);
			echo json_encode($response); 

	
}

?>