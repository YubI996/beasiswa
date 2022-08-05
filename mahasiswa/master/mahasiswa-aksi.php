<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-mahasiswa.php");

$aksi = $_POST['aksi'];


if ($aksi == "edt") {
					// Ambil data yang dikirim dari form
					$exp = explode('~', $_POST['kota']);
					$id_user = $_SESSION['id']; 
					$nama = $_POST['nama'];  
					$ktm = $_POST['ktm'];  
					$ktp = $_POST['ktp'];  
					$tpl = $_POST['tpl']; 
					$tgl = $_POST['tgl']; 
					$kota = $exp[0];
					$daerah = $exp[1];
					$alamatKtp = $_POST['alamatKtp']; 
					$alamatS = $_POST['alamatS']; 
					$telp1 = $_POST['telp1']; 
					$ayah = $_POST['ayah'];  
					$ibu = $_POST['ibu']; 
					$alamatO = $_POST['alamatO'];  
					$telp2 = $_POST['telp2']; 
					$pt = $_POST['pt']; 
					$alamatP = $_POST['alamatP']; 
					$telp3 = $_POST['telp3']; 
					$jenjang = $_POST['jenjang']; 
					$angkatan = $_POST['angkatan']; 
					$fakultas = $_POST['fakultas']; 
					$ps = $_POST['ps']; 
					$jurusan = $_POST['jurusan']; 
					$ilmu = $_POST['ilmu']; 
					$nmbank = $_POST['nmbank']; 
					$alamatB = $_POST['alamatB']; 
					$telp4 = $_POST['telp4'];  
					$norek = $_POST['norek'];  
					$pemilik = $_POST['pemilik'];  

						$q = $con->prepare("SELECT email FROM user WHERE id_user='$id_user'");
						$q->execute();
						$e = $q->fetch();
						$email = $e['email'];

							// Proses ubah ke Database
							$sql = $con->prepare("UPDATE mahasiswa SET  id_user=:id_user, nama_mahasiswa=:nama, no_ktm=:ktm, no_ktp=:ktp, tempat_lahir=:tpl, tgl_lahir=:tgl, kota=:kota, daerah=:daerah, alamat_ktp=:alamatKtp, alamat_sekarang=:alamatS, telp_mahasiswa=:telp1, email=:email, nama_ayah=:ayah, nama_ibu=:ibu, alamat_ortu=:alamatO, telp_ortu=:telp2, perguruan_tinggi=:pt, alamat_pt=:alamatP, telp_pt=:telp3, jenjang=:jenjang, angkatan=:angkatan, fakultas=:fakultas, program_studi=:ps, jurusan=:jurusan, ilmu=:ilmu, nama_bank=:nmbank, alamat_bank=:alamatB, telp_bank=:telp4, no_rekening=:norek, pemilik=:pemilik WHERE id_user=:id_user");
							$sql->bindParam(':id_user', $id_user);
							$sql->bindParam(':nama', $nama);
							$sql->bindParam(':ktm', $ktm);
							$sql->bindParam(':ktp', $ktp);
							$sql->bindParam(':tpl', $tpl);
							$sql->bindParam(':tgl', $tgl);
							$sql->bindParam(':kota', $kota);
							$sql->bindParam(':daerah', $daerah);
							$sql->bindParam(':alamatKtp', $alamatKtp);
							$sql->bindParam(':alamatS', $alamatS);
							$sql->bindParam(':telp1', $telp1);
							$sql->bindParam(':email', $email);
							$sql->bindParam(':ayah', $ayah);
							$sql->bindParam(':ibu', $ibu);
							$sql->bindParam(':alamatO', $alamatO);
							$sql->bindParam(':telp2', $telp2);
							$sql->bindParam(':pt', $pt);
							$sql->bindParam(':alamatP', $alamatP);
							$sql->bindParam(':telp3', $telp3);
							$sql->bindParam(':jenjang', $jenjang);
							$sql->bindParam(':angkatan', $angkatan);
							$sql->bindParam(':fakultas', $fakultas);
							$sql->bindParam(':ps', $ps);
							$sql->bindParam(':jurusan', $jurusan);
							$sql->bindParam(':ilmu', $ilmu);
							$sql->bindParam(':nmbank', $nmbank);
							$sql->bindParam(':alamatB', $alamatB);
							$sql->bindParam(':telp4', $telp4);
							$sql->bindParam(':norek', $norek);
							$sql->bindParam(':pemilik', $pemilik);
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