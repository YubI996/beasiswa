<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-mahasiswa.php");

$aksi = $_POST['aksi'];

$qm = $con->prepare("SELECT * FROM mahasiswa WHERE id_user='$_SESSION[id]'");
$qm->execute();
$dt = $qm->fetch();
$id_mahasiswa = $dt['id_mahasiswa'];



if ($aksi == "edt") {
			// Ambil data yang dikirim dari form
				$id_bcs = $_POST['id_bcs'];   
				$periode = $_POST['periode']; 
				$tgl = $_POST['tgl'];  
				$semester = $_POST['semester'];  
				$ipk = $_POST['ipk'];
				$SP = $_POST['suratP'];
				$SAK = $_POST['suratAK'];
				$SPN = $_POST['suratPN'];
				$PR1 = $_POST['propPN1'];
				$PR2 = $_POST['propPN2'];
				$STA = $_POST['suratTA'];
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
				$IJZ1 = $_POST['ijazah1'];
				$IJZ2 = $_POST['ijazah2'];
				$S1 = $_POST['sertifikat1'];
				$S2 = $_POST['sertifikat2'];
				$S3 = $_POST['sertifikat3'];
				$statusV = '0';
				$statusP = '2';
				$verifikator = '';

				$cek1 = $con->prepare("SELECT id_mahasiswa FROM beasiswa_coass WHERE id_bcs='$id_bcs'");
				$cek1->execute();
				$dm = $cek1->fetch();



				if ($dm['id_mahasiswa'] == $id_mahasiswa) { //jika data yang akan diedit id mahasiswa nya sama
				$q = $con->prepare("SELECT * FROM beasiswa_coass WHERE id_bcs='$id_bcs'");
				$q->execute();
				$d = $q->fetch();



				 if (!empty($_FILES["suratP"]["tmp_name"]) && $SP == "") {
								$suratP = 'SP'.date("dHis").'-'.$_FILES['suratP']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['surat_permohonan'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['surat_permohonan']); 
				 }else{
								$suratP = $d['surat_permohonan'];
				 }
				 if (!empty($_FILES["suratAK"]["tmp_name"]) && $SAK == "") {
								$suratAK = 'AK'.date("dHis").'-'.$_FILES['suratAK']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['aktif_kuliah'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['aktif_kuliah']); 
				 }else{
								$suratAK = $d['aktif_kuliah'];
				 }
				 if (!empty($_FILES["suratPN"]["tmp_name"]) && $SPN == "") {
								$suratPN = 'SPN'.date("dHis").'-'.$_FILES['suratPN']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['surat_penelitian'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['surat_penelitian']); 
				 }else{
								$suratPN = $d['surat_penelitian'];
				 }
				 if (!empty($_FILES["propPN1"]["tmp_name"]) && $PR1 == "") {
								$propPN1 = 'PR1'.date("dHis").'-'.$_FILES['propPN1']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['proposal_penelitian1'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['proposal_penelitian1']); 
				 }else{
								$propPN1 = $d['proposal_penelitian1'];
				 }
				 if (!empty($_FILES["propPN2"]["tmp_name"]) && $PR2 == "") {
								$propPN2 = 'PR2'.date("dHis").'-'.$_FILES['propPN2']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['proposal_penelitian2'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['proposal_penelitian2']); 
				 }else{
								$propPN2 = $d['proposal_penelitian2'];
				 }
				 if (!empty($_FILES["suratTA"]["tmp_name"]) && $STA == "") {
								$suratTA = 'STA'.date("dHis").'-'.$_FILES['suratTA']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['surat_ta'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['surat_ta']); 
				 }else{
								$suratTA = $d['surat_ta'];
				 }
				 if (!empty($_FILES["khs"]["tmp_name"]) && $KHS == "") {
								$khs = 'KHS'.date("dHis").'-'.$_FILES['khs']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['transkrip'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['transkrip']); 
				 }else{
								$khs = $d['transkrip'];
				 }
				 if (!empty($_FILES["suratK"]["tmp_name"]) && $SK == "") {
								$suratK = 'SK'.date("dHis").'-'.$_FILES['suratK']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['non_pekerja'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['non_pekerja']); 
				 }else{
								$suratK = $d['non_pekerja'];
				 }
				 if (!empty($_FILES["suratB"]["tmp_name"]) && $SB == "") {
								$suratB = 'SB'.date("dHis").'-'.$_FILES['suratB']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['non_beasiswa'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['non_beasiswa']); 
				 }else{
								$suratB = $d['non_beasiswa'];
				 }
				 if (!empty($_FILES["ktm"]["tmp_name"]) && $KTM == "") {
								$ktm = 'KTM'.date("dHis").'-'.$_FILES['ktm']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['ktm'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['ktm']); 
				 }else{
								$ktm = $d['ktm'];
				 }
				 if (!empty($_FILES["ktp"]["tmp_name"]) && $KTP == "") {
								$ktp = 'KTP'.date("dHis").'-'.$_FILES['ktp']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['ktp'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['ktp']); 
				 }else{
								$ktp = $d['ktp'];
				 }
				 if (!empty($_FILES["akta"]["tmp_name"]) && $AKT == "") {
								$akta = 'AKT'.date("dHis").'-'.$_FILES['akta']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['akta_kelahiran'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['akta_kelahiran']); 
				 }else{
								$akta = $d['akta_kelahiran'];
				 }
				 if (!empty($_FILES["kk"]["tmp_name"]) && $KK == "") {
								$kk = 'KK'.date("dHis").'-'.$_FILES['kk']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['kk'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['kk']); 
				 }else{
								$kk = $d['kk'];
				 }
				 if (!empty($_FILES["domisili"]["tmp_name"]) && $DOM == "") {
								$domisili = 'DOM'.date("dHis").'-'.$_FILES['domisili']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['domisili'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['domisili']); 
				 }else{
								$domisili = $d['domisili'];
				 }
				 if (!empty($_FILES["suratN"]["tmp_name"]) && $SN == "") {
								$suratN = 'SN'.date("dHis").'-'.$_FILES['suratN']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['non_narkoba'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['non_narkoba']); 
				 }else{
								$suratN = $d['non_narkoba'];
				 }
				 if (!empty($_FILES["burek"]["tmp_name"]) && $BR == "") {
								$burek = 'BR'.date("dHis").'-'.$_FILES['burek']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['buku_rekening'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['buku_rekening']); 
				 }else{
								$burek = $d['buku_rekening'];
				 }
				 if (!empty($_FILES["ijazah1"]["tmp_name"]) && $IJZ1 == "") {
								$ijazah1 = 'IJZA'.date("dHis").'-'.$_FILES['ijazah1']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['ijazah_sekolah'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['ijazah_sekolah']); 
				 }else{
								$ijazah1 = $d['ijazah_sekolah'];
				 }
				 if (!empty($_FILES["ijazah2"]["tmp_name"]) && $IJZ2 == "") {
								$ijazah2 = 'IJZB'.date("dHis").'-'.$_FILES['ijazah2']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['ijazah_ta'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['ijazah_pt']); 
				 }else{
								$ijazah2 = $d['ijazah_pt'];
				 }
				 if (!empty($_FILES["sertifikat1"]["tmp_name"]) && $S1 == "") {
								$sertifikat1 = 'S1'.date("dHis").'-'.$_FILES['sertifikat1']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat1'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat1']); 
				 }else{
								$sertifikat1 = $d['sertifikat1'];
				 }
				 if (!empty($_FILES["sertifikat2"]["tmp_name"]) && $S2 == "") {
								$sertifikat2 = 'S2'.date("dHis").'-'.$_FILES['sertifikat2']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat2'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat2']); 
				 }else{
								$sertifikat2 = $d['sertifikat2'];
				 }
				 if (!empty($_FILES["sertifikat3"]["tmp_name"]) && $S3 == "") {
								$sertifikat3 = 'S3'.date("dHis").'-'.$_FILES['sertifikat3']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat3'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat3']); 
				 }else{
								$sertifikat3 = $d['sertifikat3'];
				 }


 
				$tmpP = $_FILES['suratP']['tmp_name'];
				 
				$tmpAk = $_FILES['suratAK']['tmp_name'];

				$tmpSPN = $_FILES['suratPN']['tmp_name'];

				$tmpPR1 = $_FILES['propPN1']['tmp_name'];

				$tmpPR2 = $_FILES['propPN2']['tmp_name'];

				$tmpSTA = $_FILES['suratTA']['tmp_name'];

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
				
				$tmpIj1 = $_FILES['ijazah1']['tmp_name'];
									
				$tmpIj2 = $_FILES['ijazah2']['tmp_name'];
									
				$tmpS1 = $_FILES['sertifikat1']['tmp_name'];

				$tmpS2 = $_FILES['sertifikat2']['tmp_name'];

				$tmpS3 = $_FILES['sertifikat3']['tmp_name'];



				$suratP1 = $host1."/user/beasiswa/file_berkas_cs/".$suratP;
				$suratAK1 = $host1."/user/beasiswa/file_berkas_cs/".$suratAK;
				$suratPN1 = $host1."/user/beasiswa/file_berkas_cs/".$suratPN;
				$propPN11 = $host1."/user/beasiswa/file_berkas_cs/".$propPN1;
				$propPN21 = $host1."/user/beasiswa/file_berkas_cs/".$propPN2;
				$suratTA1 = $host1."/user/beasiswa/file_berkas_cs/".$suratTA;
				$khs1 = $host1."/user/beasiswa/file_berkas_cs/".$khs;
				$suratK1 = $host1."/user/beasiswa/file_berkas_cs/".$suratK;
				$suratB1 = $host1."/user/beasiswa/file_berkas_cs/".$suratB;
				$ktm1 = $host1."/user/beasiswa/file_berkas_cs/".$ktm;
				$ktp1 = $host1."/user/beasiswa/file_berkas_cs/".$ktp;
				$akta1 = $host1."/user/beasiswa/file_berkas_cs/".$akta;
				$kk1 = $host1."/user/beasiswa/file_berkas_cs/".$kk;
				$domisili1 = $host1."/user/beasiswa/file_berkas_cs/".$domisili;
				$suratN1 = $host1."/user/beasiswa/file_berkas_cs/".$suratN;
				$burek1 = $host1."/user/beasiswa/file_berkas_cs/".$burek;
				$ijazah11 = $host1."/user/beasiswa/file_berkas_cs/".$ijazah1;
				$ijazah21 = $host1."/user/beasiswa/file_berkas_cs/".$ijazah2;
				$sertifikat11 = $host1."/user/beasiswa/file_berkas_cs/".$sertifikat1;
				$sertifikat21 = $host1."/user/beasiswa/file_berkas_cs/".$sertifikat2;
				$sertifikat31 = $host1."/user/beasiswa/file_berkas_cs/".$sertifikat3;



							// Proses ubah ke Database
                            $sql = $con->prepare("UPDATE beasiswa_coass SET id_mahasiswa=:id_mahasiswa, periode=:periode, tgl_permohonan=:tgl, semester=:semester, ipk=:ipk, surat_permohonan=:suratP, aktif_kuliah=:suratAK, surat_penelitian=:suratPN, proposal_penelitian1=:propPN1, proposal_penelitian2=:propPN2, surat_ta=:suratTA, transkrip=:khs, non_pekerja=:suratK, non_beasiswa=:suratB, ktm=:ktm, ktp=:ktp, akta_kelahiran=:akta, kk=:kk, domisili=:domisili, non_narkoba=:suratN, sertifikat1=:sertifikat1, sertifikat2=:sertifikat2, sertifikat3=:sertifikat3, buku_rekening=:burek, ijazah_sekolah=:ijazah1, ijazah_pt=:ijazah2, status_perbaikan=:statusP WHERE id_bcs=:id_bcs");
							$sql->bindParam(':id_bcs', $id_bcs);
							$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
							$sql->bindParam(':periode', $periode);
							$sql->bindParam(':tgl', $tgl);
							$sql->bindParam(':semester', $semester);
							$sql->bindParam(':ipk', $ipk);
							$sql->bindParam(':suratP', $suratP);
							$sql->bindParam(':suratPN', $suratPN);
							$sql->bindParam(':propPN1', $propPN1);
							$sql->bindParam(':propPN2', $propPN2);
							$sql->bindParam(':suratTA', $suratTA);
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
							$sql->bindParam(':ijazah1', $ijazah1);
							$sql->bindParam(':ijazah2', $ijazah2);
							$sql->bindParam(':statusP', $statusP);
							$sql->execute(); // Eksekusi query insert
							
 
							
							
						if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
								move_uploaded_file($tmpP, $suratP1);
								move_uploaded_file($tmpAk, $suratAK1);
								move_uploaded_file($tmpSPN, $suratPN1);
								move_uploaded_file($tmpPR1, $propPN11);
								move_uploaded_file($tmpPR2, $propPN21);
								move_uploaded_file($tmpSTA, $suratTA1);
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
								move_uploaded_file($tmpIj1, $ijazah11);
								move_uploaded_file($tmpIj2, $ijazah21);
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

					$qw2 = $con->prepare("SELECT * FROM beasiswa_coass WHERE id_mahasiswa='$id_mahasiswa' AND periode='$periode'");
					$qw2->execute();
					$n2 = $qw2->rowCount();

					if ($n > 0 || $n1 > 0 || $n2 > 0) { 

						$response = array(
							'status'=>'double', // Set status
							'pesan'=>'Data sudah ada', // Set pesan 
						);
					echo json_encode($response); // konversi variabel response menjadi JSON

					}else{

					$q = $con->prepare("SELECT * FROM beasiswa_coass WHERE id_bcs='$id_bcs'");
					$q->execute();
					$d = $q->fetch();



				 if (!empty($_FILES["suratP"]["tmp_name"]) && $SP == "") {
								$suratP = 'SP'.date("dHis").'-'.$_FILES['suratP']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['surat_permohonan'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['surat_permohonan']); 
				 }else{
								$suratP = $d['surat_permohonan'];
				 }
				 if (!empty($_FILES["suratAK"]["tmp_name"]) && $SAK == "") {
								$suratAK = 'AK'.date("dHis").'-'.$_FILES['suratAK']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['aktif_kuliah'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['aktif_kuliah']); 
				 }else{
								$suratAK = $d['aktif_kuliah'];
				 }
				 if (!empty($_FILES["suratPN"]["tmp_name"]) && $SPN == "") {
								$suratPN = 'SPN'.date("dHis").'-'.$_FILES['suratPN']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['surat_penelitian'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['surat_penelitian']); 
				 }else{
								$suratPN = $d['surat_penelitian'];
				 }
				 if (!empty($_FILES["propPN1"]["tmp_name"]) && $PR1 == "") {
								$propPN1 = 'PR1'.date("dHis").'-'.$_FILES['propPN1']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['proposal_penelitian1'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['proposal_penelitian1']); 
				 }else{
								$propPN1 = $d['proposal_penelitian1'];
				 }
				 if (!empty($_FILES["propPN2"]["tmp_name"]) && $PR2 == "") {
								$propPN2 = 'PR2'.date("dHis").'-'.$_FILES['propPN2']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['proposal_penelitian2'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['proposal_penelitian2']); 
				 }else{
								$propPN2 = $d['proposal_penelitian2'];
				 }
				 if (!empty($_FILES["suratTA"]["tmp_name"]) && $STA == "") {
								$suratTA = 'STA'.date("dHis").'-'.$_FILES['suratTA']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['surat_ta'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['surat_ta']); 
				 }else{
								$suratTA = $d['surat_ta'];
				 }
				 if (!empty($_FILES["khs"]["tmp_name"]) && $KHS == "") {
								$khs = 'KHS'.date("dHis").'-'.$_FILES['khs']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['transkrip'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['transkrip']); 
				 }else{
								$khs = $d['transkrip'];
				 }
				 if (!empty($_FILES["suratK"]["tmp_name"]) && $SK == "") {
								$suratK = 'SK'.date("dHis").'-'.$_FILES['suratK']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['non_pekerja'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['non_pekerja']); 
				 }else{
								$suratK = $d['non_pekerja'];
				 }
				 if (!empty($_FILES["suratB"]["tmp_name"]) && $SB == "") {
								$suratB = 'SB'.date("dHis").'-'.$_FILES['suratB']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['non_beasiswa'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['non_beasiswa']); 
				 }else{
								$suratB = $d['non_beasiswa'];
				 }
				 if (!empty($_FILES["ktm"]["tmp_name"]) && $KTM == "") {
								$ktm = 'KTM'.date("dHis").'-'.$_FILES['ktm']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['ktm'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['ktm']); 
				 }else{
								$ktm = $d['ktm'];
				 }
				 if (!empty($_FILES["ktp"]["tmp_name"]) && $KTP == "") {
								$ktp = 'KTP'.date("dHis").'-'.$_FILES['ktp']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['ktp'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['ktp']); 
				 }else{
								$ktp = $d['ktp'];
				 }
				 if (!empty($_FILES["akta"]["tmp_name"]) && $AKT == "") {
								$akta = 'AKT'.date("dHis").'-'.$_FILES['akta']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['akta_kelahiran'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['akta_kelahiran']); 
				 }else{
								$akta = $d['akta_kelahiran'];
				 }
				 if (!empty($_FILES["kk"]["tmp_name"]) && $KK == "") {
								$kk = 'KK'.date("dHis").'-'.$_FILES['kk']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['kk'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['kk']); 
				 }else{
								$kk = $d['kk'];
				 }
				 if (!empty($_FILES["domisili"]["tmp_name"]) && $DOM == "") {
								$domisili = 'DOM'.date("dHis").'-'.$_FILES['domisili']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['domisili'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['domisili']); 
				 }else{
								$domisili = $d['domisili'];
				 }
				 if (!empty($_FILES["suratN"]["tmp_name"]) && $SN == "") {
								$suratN = 'SN'.date("dHis").'-'.$_FILES['suratN']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['non_narkoba'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['non_narkoba']); 
				 }else{
								$suratN = $d['non_narkoba'];
				 }
				 if (!empty($_FILES["burek"]["tmp_name"]) && $BR == "") {
								$burek = 'BR'.date("dHis").'-'.$_FILES['burek']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['buku_rekening'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['buku_rekening']); 
				 }else{
								$burek = $d['buku_rekening'];
				 }
				 if (!empty($_FILES["ijazah1"]["tmp_name"]) && $IJZ1 == "") {
								$ijazah1 = 'IJZA'.date("dHis").'-'.$_FILES['ijazah1']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['ijazah_sekolah'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['ijazah_sekolah']); 
				 }else{
								$ijazah1 = $d['ijazah_sekolah'];
				 }
				 if (!empty($_FILES["ijazah2"]["tmp_name"]) && $IJZ2 == "") {
								$ijazah2 = 'IJZB'.date("dHis").'-'.$_FILES['ijazah2']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['ijazah_ta'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['ijazah_pt']); 
				 }else{
								$ijazah2 = $d['ijazah_pt'];
				 }
				 if (!empty($_FILES["sertifikat1"]["tmp_name"]) && $S1 == "") {
								$sertifikat1 = 'S1'.date("dHis").'-'.$_FILES['sertifikat1']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat1'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat1']); 
				 }else{
								$sertifikat1 = $d['sertifikat1'];
				 }
				 if (!empty($_FILES["sertifikat2"]["tmp_name"]) && $S2 == "") {
								$sertifikat2 = 'S2'.date("dHis").'-'.$_FILES['sertifikat2']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat2'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat2']); 
				 }else{
								$sertifikat2 = $d['sertifikat2'];
				 }
				 if (!empty($_FILES["sertifikat3"]["tmp_name"]) && $S3 == "") {
								$sertifikat3 = 'S3'.date("dHis").'-'.$_FILES['sertifikat3']['name'];
								if(is_file($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat3'])) 
								unlink($host1."/user/beasiswa/file_berkas_cs/".$d['sertifikat3']); 
				 }else{
								$sertifikat3 = $d['sertifikat3'];
				 }


	 
					$tmpP = $_FILES['suratP']['tmp_name'];
					 
					$tmpAk = $_FILES['suratAK']['tmp_name'];

					$tmpSPN = $_FILES['suratPN']['tmp_name'];

					$tmpPR1 = $_FILES['propPN1']['tmp_name'];

					$tmpPR2 = $_FILES['propPN2']['tmp_name'];

					$tmpSTA = $_FILES['suratTA']['tmp_name'];

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
					
					$tmpIj1 = $_FILES['ijazah1']['tmp_name'];
										
					$tmpIj2 = $_FILES['ijazah2']['tmp_name'];
										
					$tmpS1 = $_FILES['sertifikat1']['tmp_name'];

					$tmpS2 = $_FILES['sertifikat2']['tmp_name'];

					$tmpS3 = $_FILES['sertifikat3']['tmp_name'];



					$suratP1 = $host1."/user/beasiswa/file_berkas_cs/".$suratP;
					$suratAK1 = $host1."/user/beasiswa/file_berkas_cs/".$suratAK;
					$suratPN1 = $host1."/user/beasiswa/file_berkas_cs/".$suratPN;
					$propPN11 = $host1."/user/beasiswa/file_berkas_cs/".$propPN1;
					$propPN21 = $host1."/user/beasiswa/file_berkas_cs/".$propPN2;
					$suratTA1 = $host1."/user/beasiswa/file_berkas_cs/".$suratTA;
					$khs1 = $host1."/user/beasiswa/file_berkas_cs/".$khs;
					$suratK1 = $host1."/user/beasiswa/file_berkas_cs/".$suratK;
					$suratB1 = $host1."/user/beasiswa/file_berkas_cs/".$suratB;
					$ktm1 = $host1."/user/beasiswa/file_berkas_cs/".$ktm;
					$ktp1 = $host1."/user/beasiswa/file_berkas_cs/".$ktp;
					$akta1 = $host1."/user/beasiswa/file_berkas_cs/".$akta;
					$kk1 = $host1."/user/beasiswa/file_berkas_cs/".$kk;
					$domisili1 = $host1."/user/beasiswa/file_berkas_cs/".$domisili;
					$suratN1 = $host1."/user/beasiswa/file_berkas_cs/".$suratN;
					$burek1 = $host1."/user/beasiswa/file_berkas_cs/".$burek;
					$ijazah11 = $host1."/user/beasiswa/file_berkas_cs/".$ijazah1;
					$ijazah21 = $host1."/user/beasiswa/file_berkas_cs/".$ijazah2;
					$sertifikat11 = $host1."/user/beasiswa/file_berkas_cs/".$sertifikat1;
					$sertifikat21 = $host1."/user/beasiswa/file_berkas_cs/".$sertifikat2;
					$sertifikat31 = $host1."/user/beasiswa/file_berkas_cs/".$sertifikat3;



								// Proses ubah ke Database
	                            $sql = $con->prepare("UPDATE beasiswa_coass SET id_mahasiswa=:id_mahasiswa, periode=:periode, tgl_permohonan=:tgl, semester=:semester, ipk=:ipk, surat_permohonan=:suratP, aktif_kuliah=:suratAK, surat_penelitian=:suratPN, proposal_penelitian1=:propPN1, proposal_penelitian2=:propPN2, surat_ta=:suratTA, transkrip=:khs, non_pekerja=:suratK, non_beasiswa=:suratB, ktm=:ktm, ktp=:ktp, akta_kelahiran=:akta, kk=:kk, domisili=:domisili, non_narkoba=:suratN, sertifikat1=:sertifikat1, sertifikat2=:sertifikat2, sertifikat3=:sertifikat3, buku_rekening=:burek, ijazah_sekolah=:ijazah1, ijazah_pt=:ijazah2, status_perbaikan=:statusP WHERE id_bcs=:id_bcs");
								$sql->bindParam(':id_bcs', $id_bcs);
								$sql->bindParam(':id_mahasiswa', $id_mahasiswa);
								$sql->bindParam(':periode', $periode);
								$sql->bindParam(':tgl', $tgl);
								$sql->bindParam(':semester', $semester);
								$sql->bindParam(':ipk', $ipk);
								$sql->bindParam(':suratP', $suratP);
								$sql->bindParam(':suratPN', $suratPN);
								$sql->bindParam(':propPN1', $propPN1);
								$sql->bindParam(':propPN2', $propPN2);
								$sql->bindParam(':suratTA', $suratTA);
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
								$sql->bindParam(':ijazah1', $ijazah1);
								$sql->bindParam(':ijazah2', $ijazah2);
								$sql->bindParam(':statusP', $statusP);
								$sql->execute(); // Eksekusi query insert
								
								
								
								
							if($sql){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
								move_uploaded_file($tmpP, $suratP1);
								move_uploaded_file($tmpAk, $suratAK1);
								move_uploaded_file($tmpSPN, $suratPN1);
								move_uploaded_file($tmpPR1, $propPN11);
								move_uploaded_file($tmpPR2, $propPN21);
								move_uploaded_file($tmpSTA, $suratTA1);
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
								move_uploaded_file($tmpIj1, $ijazah11);
								move_uploaded_file($tmpIj2, $ijazah21);
								move_uploaded_file($tmpS1, $sertifikat11);
								move_uploaded_file($tmpS2, $sertifikat21);
								move_uploaded_file($tmpS3, $sertifikat31);

								// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
								$response = array(
									'status'=>'sukses', // Set status
									'pesan'=>'Data berhasil diubah', // Set pesan
									'html'=>$html // Set html
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
					


?>